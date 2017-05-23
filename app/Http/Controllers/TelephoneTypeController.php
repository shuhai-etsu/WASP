<?php

namespace App\Http\Controllers;

use App\TelephoneType;
use App\Http\Requests\CreateTelephoneTypeRequest;
use App\Http\Requests\UpdateTelephoneTypeRequest;

/**
 * Class: TelephoneTypeController
 *
 * Purpose: Class is responsible for handling HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating,
 *          deleting and displaying data associated with telephone types. Please see routes.php to see the routes
 *          associates with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateTelephoneTypeRequest for
 *        additional information regarding validation.
 *
 *        The class's create(), show(), index(), and edit() methods merely show views for data presentation or
 *        data entry. Create, update and delete operations are handled by the store(), update() and delete() methods.
 *
 *        Laravel supports REST and includes several services by default, such as store(), update(), delete(), index(),
 *        etc., which can be referenced in the routes file by calling to
 *        Route::resource('[RESOURCE NAME]', '[CONTROLLER NAME']);
 *
 * CRITICAL: ALL views referenced in this class that display data are for TESTING PURPOSES ONLY. The views and routes
 *           were created to test the controller logic and SHOULD NOT be used in production. The routes and views
 *           should be adjusted to support the production application.
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 * @package App\Http\Controllers
 */
class TelephoneTypeController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of telephone types that the database currently stores. The database's
     *          first, blank entry is ignored. Only entries that contain data are displayed to
     *          the user. The entries are sorted in ASCENDING order.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the
     * telephone types stored in the database
     */
    public function index()
    {
        return view('pages/admin/configurations/telephones.index')->with('data', TelephoneType::where('id','>',1)
                                                 ->orderby('description','ASC')
                                                 ->get())
                          ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific telephone type that is stored in the database.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add a check for preventing users from attempting to access the blank entry.
     *
     * @param $id ID (e.g. primary key) of the telephone type the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the telephone type's
     * information.
     */
    public function show($id)
    {
        return view('pages/admin/configurations/telephone_types.show')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', TelephoneType::find($id));
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new telephone type into the system. The view routes the
     *          user supplied information to the store() method when the user submits the data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new telephone
     * type.
     */
    public function create()
    {
        return view('pages/admin/configurations/telephones.create')->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given telephone type's information for editing purposes. On submit, the view
     *          calls the class's update() method to validate and store the user's input. Please see the class's store()
     *          method for additional information.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        return view('pages/admin/configurations/telephones.edit')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', TelephoneType::find($id));
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new telephone type in the database. Data is validated through the
     *          CreateTelephoneTypeRequest object. If the object validates successfully, the request object's data
     *          is used to create a new telephone type entry in the database and the user is redirected
     *          to the telephone types index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo add try/catch, with support for error logging
     *
     * @param CreateTelephoneTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current telephone types, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateTelephoneTypeRequest $request)
    {
        TelephoneType::create($request->all());
        return redirect('telephone_types');
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing telephone type in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     *
     * @id Unique id (e.g. primary key) of the entry to update
     *
     * @param UpdateTelephoneTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current telephone types if validation is successful, which
     * should display the new entry entered by the user.
     */
    public function update($id, UpdateTelephoneTypeRequest $request)
    {
        TelephoneType::find($id)->update($request->all());
        return redirect('telephone_types');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a telephone type from the database.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * telephone types index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        TelephoneType::where('id', '=', $id)->delete();
        return redirect('telephone_types');
    }
}
