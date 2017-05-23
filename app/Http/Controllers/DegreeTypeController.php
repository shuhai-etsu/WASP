<?php

namespace App\Http\Controllers;

use App\DegreeType;
use App\Http\Requests\CreateDegreeTypeRequest;
use App\Http\Requests\UpdateDegreeTypeRequest;


/**
 * Class: DegreeTypeController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with degree types. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically rerouted to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateDegreeTypeRequest for
 *        additional information regarding validation.
 *
 *        The create(), show(), index(), and edit() methods of this class merely show views for data presentation or
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
 *
 *
 * @package App\Http\Controllers
 */
class DegreeTypeController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of degree types that are currently stored in the database. The first
     *          entry in the database (e.g. the blank entry) is ignored. Only entries that contain data are displayed to
     *          the user. The entries are sorted in ASCENDING order.
     *
     * @todo add try/catch, with support for error logging
     * @todo add support for initial blank entry
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the degree
     * types stored in the database
     */
    public function index()
    {
        return view('pages/admin/configurations/degree_types.index')->with('data', DegreeType::where('id','>',1)
                ->orderBy('description', 'ASC')->get())
            ->with('sidebar_data', parent::get_sidebar_data());

    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific degree type that is stored in the database.
     *
     * Add a check for preventing users from attempting to access the blank entry.
     *
     * @todo add try/catch, with support for error logging
     * @todo add support for initial blank entry
     *
     * @param $id ID (e.g. primary key) of the degree type the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the degree types's
     * information.
     */
    public function show($id)
    {
        return view('pages/admin/configurations/degree_types.show')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', DegreeType::find($id));
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new degree type into the system. The view routes the user
     *          supplied information to the store() method when the user submits the data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new degree type
     */
    public function create()
    {
        return view('pages/admin/configurations/degree_types.create')->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given degree type's information for editing purposes. On submit, the
     *          view calls the class's update() method to validate and store the user's input. Please see the
     *          class's store() method for additional information.
     *
     * @todo add try/catch, with support for error logging
     * @todo add support for initial blank entry
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        return view('pages/admin/configurations/degree_types.edit')->with('data', DegreeType::find($id))
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new degree type in the database. Data is validated through the
     *          CreateDegreeTypeRequest object. If the object validates successfully, the request object's data
     *          is used to create a new degree type entry in the database and the user is redirected
     *          to the degree type's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @param CreateDegreeTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current degree types, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateDegreeTypeRequest $request)
    {
        DegreeType::create($request ->all());
        return redirect('degree_types');
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing degree type in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo add try/catch, with support for error logging
     * @todo add support for initial blank entry
     *
     * @id Unique id (e.g. primary key) of the entry that is to updated
     *
     * @param UpdateDegreeTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current degree types if validation is successful, which
     *                  should display the new entry entered by the user.
     */
    public function update($id, UpdateDegreeTypeRequest $request)
    {
        DegreeType::find($id)->update($request ->all());
        return redirect('degree_types');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a degree type from the database.
     *
     * Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     *
     * @todo add try/catch, with support for error logging
     * @todo add support for initial blank entry
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * degree types index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        DegreeType::where('id', '=', $id)->delete();
        return redirect('degree_types');
    }
}

