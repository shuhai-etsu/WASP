<?php

namespace App\Http\Controllers;

use App\CertificationType;
use App\Http\Requests\CreateCertificationTypeRequest;    //Used for validating new certification types.
use App\Http\Requests\UpdateCertificationTypeRequest;    //Used for validating existing certification types.

/**
 * Class: CertificationTypeController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with certification types. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy methods. If validation fails,
 *        the user is automatically re-routed to the previous page. Otherwise, the request object is passed to the
 *        store() method and the entry is stored in the database. Please see CreateCertificationTypeRequest
 *        and UpdateCertificationTypeRequest for additional information regarding validation.
 *
 *        The class's create(), show(), index(), and edit() methods merely show views for data presentation or
 *        data entry. Create, update and delete operations are handled by the store(), update() and delete() methods.
 *
 *        Laravel supports REST and includes several services by default, such as store(), update(), delete(), index(),
 *        etc., which can be referenced in the routes file using the notation
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

class CertificationTypeController extends DefaultController
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
     * Purpose: Creates a view that lists the certification types that the database currently stores. The
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
            return view('pages/admin/configurations/certifications.index')->with('data', CertificationType::where('id', '>', 1)
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
     * Purpose: Creates a view of a specific certification type that is stored in the database.
     *
     * @todo Add a check for preventing users from attempting to access the blank entry.
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the certification type the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing the certification type's
     * information.
     */
    public function show($id)
    {
        try 
        {
            return view('test/certification_types.show')
                ->with('data', CertificationType::find($id))
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
     * Purpose: Creates a view displaying a given certification type's information for editing purposes. On submit,
     *          the view calls the class's update() method to validate and store the user's input.
     *          Please see the class's store() method for additional information.
     *
     * @todo Throw exception on attempt to edit blank entry
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
            if ($id > 1) 
            {
                return view('pages/admin/configurations/certifications.edit')
                    ->with('data', CertificationType::find($id))
                    ->with('sidebar_data', parent::get_sidebar_data());
            }
            else
            {
                //throw Exception()
            }    
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }    
    }
    
    /**
     * Method: create()
     *
     * Purpose: Creates a view that allows a user to enter a new certification type entry into the database. On submit,
     *          the view calls the store() method of this class to validate and store the new entry in the database.
     *          Please see the store() method for additional information.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages/admin/configurations/certifications.create')->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new certification type in the database. Data is validated through the
     *          CreateCertificationTypeRequest object. If the object validates successfully, the request object's data
     *          is used to create a new certification type entry in the database and the user is redirected
     *          to the certification type's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo Log errors, route errors to error page
     *
     * @param CreateCertificationTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current certification Types, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateCertificationTypeRequest $request)
    {
        try
        {
            CertificationType::create($request->all());
            return redirect('certification_types');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    /**
     * Method: update()
     *
     * @param $id ID (e.g. primary key) of the database entry to update. Incoming data is validated through the
     *            UpdateCertificationTypeRequest object. If the object validates successfully, the request object's
     *            data is used to update the entry's information in the database and the user is redirected to
     *            the certification type's index page.
     *
     * @todo Throw exception on attempt to update blank entry
     * @todo Log errors, route errors to error page
     *
     * @param UpdateCertificationTypeRequest $request Type hinted request object that validates the incoming data.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the age
     * group types index page.
     */
    public function update($id, UpdateCertificationTypeRequest $request)
    {
        try 
        {
            if ($id > 1) 
            {
                CertificationType::find($id)->update($request->all());
                return redirect('certification_types');
            }
            else 
            {
                //throw Exception()
            }
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }    
    }
    
    /**
     * Method: destroy()
     *
     * Purpose: Deletes an certification type from the database.
     *
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Throw exception on attempt to delete blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * certification types index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        try 
        {
            if ($id > 1) 
            {
                CertificationType::where('id', '=', $id)->delete();
                return redirect('certification_types');
            }
            else
            {
                //throw Exception() - do not allow a user to delete the blank entry.
            }    
        }
        catch(Exception $exception)
        {
            //Log error and route to the errors page
        }    
    }
}
