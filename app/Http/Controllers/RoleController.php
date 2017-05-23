<?php

namespace App\Http\Controllers;

use App\Role;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

/**
 * Class: RoleController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with user roles. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in type4
 *        hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateRoleRequest for
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
class RoleController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of user roles that the database currently stores. The database's first,
     *          blank entry is ignored. Only entries that contain data are displayed to the user.
     *          The entries are sorted in ASCENDING order.
     *
     * @todo add try/catch, with support for error logging
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the
     * roles stored in the database
     */
    public function index()
    {
        return view('pages/admin/configurations/roles.index')->with('data', Role::where('id','>',1)
                                       ->orderBy('description', 'ASC')
                                       ->get())
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific user role that is stored in the database.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add a check for preventing users from attempting to access the blank entry.
     *
     * @param $id ID (e.g. primary key) of the role the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the role's
     * information.
     */
    public function show($id)
    {
        return view('pages/admin/configurations/roles.show')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', Role::find($id));
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new role into the system. The view routes the user
     *          supplied information to the store() method when the user submits the data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new role.
     */
    public function create()
    {
        return view('pages/admin/configurations/roles.create')->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given role's information for editing purposes. On submit, the
     *          view calls the class's update() method to validate and store the user's input. Please see the
     *          class's store() method for additional information.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add a check for preventing users from attempting to edit the blank entry.
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        return view('pages/admin/configurations/roles.edit')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', Role::find($id));
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new role in the database. Data is validated through the CreateRoleRequest
     *          object. If the object validates successfully, the equest object's data is used to create
     *          a new role entry in the database and the user is redirected to the role's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo add try/catch, with support for error logging
     *
     * @param CreateRoleRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current roles, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create($request->all());
        return redirect('roles');
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing role in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add a check for preventing users from attempting to update the blank entry.
     *
     * @id Unique id (e.g. primary key) of the entry to update
     *
     * @param UpdateRoleRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current roles if validation is successful, which
     * should display the new entry entered by the user.
     */
    public function update($id, UpdateRoleRequest $request)
    {
        Role::find($id)->update($request->all());
        return redirect('roles');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a role from the database.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Add a check for preventing users from attempting to destroy the blank entry.
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * roles index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        Role::where('id', '=', $id)->delete();
        return redirect('roles');
    }
}
