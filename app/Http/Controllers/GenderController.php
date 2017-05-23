<?php

namespace App\Http\Controllers;

use App\Gender;
use App\Http\Requests\CreateGenderRequest;
use App\Http\Requests\UpdateGenderRequest;

/**
 * Class: GenderController
 *
 * Purpose: Class is responsible for handling HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating,
 *          deleting and displaying data associated with genders. Please see routes.php to see the routes
 *          associates with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the type hinted request object BEFORE the store(), update() and
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateGenderRequest for
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
 * @todo delete this controller
 *
 * @package App\Http\Controllers
 */
class GenderController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of genders that the database currently stores. The first entry in
     *          the database (e.g. the blank entry) is ignored. Only entries that contain data are displayed to the
     *          user. The entries are sorted in ASCENDING order.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the
     * genders stored in the database
     */
    public function index()
    {
        return view('test/genders.index')->with('data', Gender::where('id','>',1)
                                         ->orderBy('description', 'ASC')
                                         ->get());
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific gender that is stored in the database.
     *
     * @todo Add a check for preventing users from attempting to access the blank entry.
     *
     * @param $id ID (e.g. primary key) of the gender the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the gender's
     * information.
     */
    public function show($id)
    {
        return view('test/genders.show')->with('data', Gender::find($id));
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new gender into the system. The view routes the user
     *          supplied information to the store() method when the user submits the data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new gender.
     */
    public function create()
    {
        return view('test/genders.create');
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given gender's information for editing purposes. On submit, the
     *          view calls the class's update() method to validate and store the user's input. Please see the
     *          store() method in the class for additional information.
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        return view('test/genders.edit')->with('data', Gender::find($id));
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new gender in the database. Data is validated through the CreateGenderRequest
     *          object. If the object validates successfully, the request object's data is used to create
     *          a new gender entry in the database and the user is redirected to the gender's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @param CreateGenderRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current genders, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateGenderRequest $request)
    {
        Gender::create($request->all());
        return redirect('genders');
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing gender in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @id Unique id (e.g. primary key) of the entry to update
     *
     * @param UpdateGenderRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current genders if validation is successful, which should
     * display the new entry entered by the user.
     */
    public function update($id, UpdateGenderRequest $request)
    {
        Gender::find($id)->update($request->all());
        return redirect('genders');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a gender from the database.
     *
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * genders index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        Gender::where('id', '=', $id)->delete();
        return redirect('genders');
    }
}
