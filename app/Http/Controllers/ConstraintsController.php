<?php

namespace App\Http\Controllers;

use App\Constraint;
use App\Http\Requests\CreateConstraintRequest;    //Used for validating new age group types.
use App\Http\Requests\UpdateConstraintRequest;    //Used for validating existing age group types.

/**
 * Class: ConstraintsController
 *
 * Purpose: Class is responsible for handling HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating,
 *          deleting and displaying data associated with constraints. Please see routes.php to see the routes
 *          associates with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy methods. If validation fails,
 *        the user is automatically re-routed to the previous page. Otherwise, the request object is
 *        passed to the store() method and the entry is stored in the database. Please see CreateConstraintRequest
 *        and UpdateConstraintsRequest for additional information regarding validation.
 *
 *        The class's create(), show(), index(), and edit() methods merely show views for data presentation or
 *        data entry. Create, update and delete operations are handled by the store(), update() and delete() methods.
 *
 *        Laravel supports REST and includes several services by default, such as store(), update(), delete(), index(),
 *        etc., which can be referenced in the routes file by using the notation
 *        Route::resource('[RESOURCE NAME]', '[CONTROLLER NAME']); in the routes file.
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
 *
 * @package App\Http\Controllers
 */

class ConstraintsController extends DefaultController
{
    /**
     * Method: __construct()
     *
     * Purpose: Creates a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Method: index()
     *
     * Purpose: Creates a view containing the list of constraints that the database currently stores. The
     *          blank entry is not returned to the user.
     *
     * @todo Log errors, route errors to error page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try 
        {
            return view('pages/admin/configurations/constraints.index')->with('data', Constraint::where('id', '>', 1)
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
     * Purpose: Creates a view of a specific constraint that is stored in the database.
     *
     * @todo Add a check for preventing users from attempting to access the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the age group type the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the age group type's
     * information.
     */
    public function show($id)
    {
        try 
        {
            return view('pages/admin/configurations/constraint.show')->with('data', Constraint::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }     
    }
    
    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given constraints information for editing purposes. On submit, the view
     *          calls the class's update() method to validate and store the user's input. Please see the class's
     *          store() method for additional information.
     *
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
                return view('pages/admin/configurations/constraints.edit')->with('data', Constraint::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }    
    }
    
    /**
     * Method: create()
     *
     * Purpose: Creates a view that allows a user to enter a new age group type entry into the database. On submit,
     *          the view calls the store() method of this class to validate and store the new entry in the database.
     *          Please see the store() method for additional information.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages/admin/configurations/constraints.create');
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new constraint in the database. Data is validated through the
     *          CreateConstraintRequest object. If the object validates successfully, the request object's data
     *          is used to create a new constraint entry in the database and the user is redirected
     *          to the constraints's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo Log errors, route errors to error page
     *
     * @param CreateConstraintRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current Constraints, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateConstraintRequest $request)
    {
        try
        {
            Constraint::create($request->all());
            return redirect('constraints');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    /**
     * Method: update()
     *
     * @param $id ID (e.g. primary key) of the entry in the database that is to be updated. Validation on the incoming
     *            data is performed through the UpdateConstraintRequest object. If the object validates successfully,
     *            the request object's data is used to update the entry's information in the database and
     *            the user is redirected to the constraint's index page.
     *
     * @todo Log errors, route errors to error page
     *
     * @param UpdateConstraintRequest $request Type hinted request object that validates the incoming data.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the age
     * group types index page.
     */
    public function update($id, UpdateConstraintRequest $request)
    {
        try 
        {
            Constraint::find($id)->update($request->all());
            return redirect('constraints');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }    
    }
    
    /**
     * Method: destroy()
     *
     * Purpose: Deletes an constraint from the database.
     *
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * constraint index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        try 
        {
            Constraint::where('id', '=', $id)->delete();
            return redirect('constraints');
        }
        catch(Exception $exception)
        {
            //Log error and route to the errors page
        }    
    }
}
