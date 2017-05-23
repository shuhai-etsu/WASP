<?php

namespace App\Http\Controllers;

use App\State;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;

/**
 * Class: StateController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with states. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in type
 *        hinted request object BEFORE executing the store(), update() and destroy methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateStateRequest for
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
class StateController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of states that the database currently stores. The first entry in
     *          the database (e.g. the blank entry) is ignored. Only entries that contain data are displayed to the
     *          user. The entries are sorted in ASCENDING order.
     *
     * @todo Log errors, route errors to error page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the
     * states stored in the database
     */
    public function index()
    {
        try
        {
            return view('pages/admin/system/states.index')
                    ->with('data',
                           State::where('id', '>', 1)
                                ->orderBy('description', 'ASC')
                                ->get())
                    ->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific state that is stored in the database.
     *
     * @todo Restore logic for supporting initial blank entry.
     * @todo Add a check for preventing users from attempting to access the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the state the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the state's
     * information.
     */
    public function show($id)
    {
        try
        {
            return view('pages/admin/system/states.show')
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('data', State::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new state into the system. The view routes the user
     *          supplied information to the store() method when the user submits the data.
     *
     * @todo Remove try/catch for consistency with other create() routines, if not needed
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new state.
     */
    public function create()
    {
        try
        {
            return view('pages/admin/system/states.create')
                    ->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given state's information for editing purposes. On submit, the view calls
     *          the class's update() method to validate and store the user's input. Please see the class's store()
     *          method for additional information.
     *
     * @todo Restore logic for supporting initial blank entry.
     * @todo Add a check for preventing users from attempting to edit the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        try
        {
            return view('pages/admin/system/states.edit')
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('data', State::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new state in the database. Data is validated through the CreateStateRequest
     *          object. If the object validates successfully, the request object's data contained is used to create
     *          a new state entry in the database and the user is redirected to the state's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo Log errors, route errors to error page
     *
     * @param CreateStateRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current states, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateStateRequest $request)
    {
        try
        {
            State::create($request->all());
            return redirect('states');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing state in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo Restore logic for supporting initial blank entry.
     * @todo Add a check for preventing users from attempting to update the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @id Unique id (e.g. primary key) of the entry that is to be updated
     *
     * @param   id
     *          UpdateStateRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current states if validation is successful, which
     * should display the new entry entered by the user.
     */
    public function update($id, UpdateStateRequest $request)
    {
        try
        {
            State::find($id)->update($request->all());
            return redirect('states');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a state from the database.
     *
     * @todo Restore logic for supporting initial blank entry.
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Add a check for preventing users from attempting to update the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * states index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        try
        {
            State::where('id', '=', $id)->delete();
            return redirect('states');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }
}
