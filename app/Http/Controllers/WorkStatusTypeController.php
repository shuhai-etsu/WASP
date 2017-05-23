<?php

namespace App\Http\Controllers;

use App\WorkStatusType;
use App\Http\Requests\CreateWorkStatusTypeRequest;
use App\Http\Requests\UpdateWorkStatusTypeRequest;


/**
 * Class: WorkStatusTypeController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with work status types. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateWorkStatusTypeRequest for
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
class WorkStatusTypeController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Used to display the entire list of work status types that the database currently stores. The
     *          first entry in the database (e.g. the blank entry) is ignored. Only entries that contain data are
     *          displayed to the user. The entries are sorted in ASCENDING order.
     *
     * @todo Add a try/catch
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the work
     * status types stored in the database
     */
    public function index()
    {
        return view('pages/admin/system/work_status.index')->with('data', WorkStatusType::where('id','>',1)
                                                   ->orderBy('abbreviation', 'ASC')
                                                   ->get())
                                ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific work status type that is stored in the database.
     *
     * @todo Add a try/catch
     * @todo Add a check for preventing users from attempting to access the blank entry.
     *
     * @param $id ID (e.g. primary key) of the work status type the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the work status type's
     * information.
     */
    public function show($id)
    {
        return view('pages/admin/system/work_status_types.show')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data', WorkStatusType::find($id));
    }

    /**
     * Method: create()
     *
     * Purpose: Displays a view that allows a user to enter a new work status type into the system. The view routes the
     *          user supplied information to the store() method when the user submits the data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View allowing a user to add a new work status
     * type
     */
    public function create()
    {
        return view('pages/admin/system/work_status.create')->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given work status type's information for editing purposes. On submit, the
     *          view calls the class's update() method to validate and store the user's input. Please see the
     *          store() method in the class for additional information.
     *
     * @param $id ID (e.g. primary key) of the entry the user wishes to edit
     *
     * @todo Add a try/catch
     * @todo Add a check to prevent users from editing initial, blank entry
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing the entry's information for
     * editing purposes.
     */
    public function edit($id)
    {
        return view('pages/admin/system/work_status.edit')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('data',WorkStatusType::find($id));
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new work status type in the database. Data is validated through the
     *          CreateWorkStatusTypeRequest object. If the object validates successfully, the request object's data
     *          is used to create a new work status type entry in the database and the user is redirected
     *          to the work status type's index page.
     *
     * @todo Log errors, route errors to error page
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @param CreateWorkStatusTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current Work Status Types, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateWorkStatusTypeRequest $request)
    {
        try
        {
            WorkStatusType::create($request->all());
            return redirect('work_status_types');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page.
        }
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing work status type in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo Add a try/catch
     * @todo Add a check to prevent users from updating initial, blank entry
     *
     * @id Unique id (e.g. primary key) of the entry to update
     *
     * @param UpdateWorkStatusTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current work status types if validation is successful, which
     *                  should display the new entry entered by the user.
     */
    public function update($id, UpdateWorkStatusTypeRequest $request)
    {
        WorkStatusType::find($id)->update($request->all());
        return redirect('work_status_types');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a work status type from the database.
     *
     * @todo Add a try/catch
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Add a check to prevent users from destroying initial, blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * work status types index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        try {
            WorkStatusType::where('id', '=', $id)->delete();
            return redirect('work_status_types');
        }
        catch(Exception $exception)
        {
            //Log error and route to the errors page
        }
    }
}
