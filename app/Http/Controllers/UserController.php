<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Util;
use App\User;
use App\Suffix;
use App\Gender;
use App\UserDocument;
use App\State;
use App\Weekday;
use App\Semester;
use App\Relationship;
use App\TelephoneType;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

/**
 * Class: UserController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with users of the system. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateUserRequest for
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
class UserController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Creates a view containing the list of users that the database currently stores.
     *
     * @todo Add try/catch
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View containing a list of users stored in the
     * database
     */
    public function index()
    {
        return view('test/users.index')
                    ->with('sidebar_data', parent::get_sidebar_data())
                    ->with('data',
                           Util::encodeJSON(User::orderby('last_name','ASC', 'first_name','ASC')->get()));
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view displaying a given user's information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the age group type the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function show($id)
    {
        if($id)
        {
            return view('test/users.show')
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('data', User::find($id));
        }
        else
        {
            //route to errors page.
        }
    }

    /**
     * Method: edit()
     *
     * Purpose: Creates a view displaying a given user's information for editing purposes. On submit, the view
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
            if ($id) 
            {
                return view('test/users.edit')->with('user', User::find($id))
                        ->with('sidebar_data', parent::get_sidebar_data())
                        ->with('suffixes', Suffix::pluck('description', 'id'))
                        ->with('genders', Gender::pluck('description', 'id'));
            } 
            else 
            {
                //throw new Exception();
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
     * Purpose: Creates a view that allows a user to enter a new user into the database. On submit,
     *          the view calls the class's store() method to validate and store the new entry in the database.
     *          Please see the store() method for additional information.
     *
     * @todo Add try/catch, with support for error logging
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View that allows a user to entry a new user
     * into the system.
     */
    public function create()
    {
        return view('test/users.create')->with('suffixes', Suffix::pluck('description', 'id'))
                                        ->with('genders', Gender::pluck('description', 'id'));
    }

    /**
     * Method: store()
     *
     * Purpose: Attempts to store a new user in the database. Data is validated through the
     *          CreateUserRequest object. If the object validates successfully, the request object's data
     *          is used to create a new user entry in the database and the user is redirected
     *          to the user's index page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * CRITICAL: Method contains code that has been deprecated. The code was left inside the method for demo purposes.
     *           The information should be removed after the demo.
     *
     * @param CreateUserRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the list of current users, which should display the new entry
     *                  entered by the user.
     */
    public function store(CreateUserRequest $request)
    {
        User::create($request->all());

        return redirect('users');
    }

    /**
     * Method: update()
     *
     * Purpose: Attempts to update an existing users in the database.
     *
     * Notes: Use a type hinted request object to validate the incoming data before it is passed to database for
     *        storage.
     *
     * @todo Add try/catch, with support for error logging
     *
     * @id Unique id (e.g. primary key) of the entry to update
     *
     * @param UpdateUserRequest $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirects the user to the list of current users if validation is successful, which
     * should display the new entry entered by the user.
     */
    public function update($id, UpdateUserRequest $request)
    {
        User::find($id)->update($request->all());

        return redirect('users');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a user from the database.
     *
     * @todo Add validation to ensure authorization and entry exists. Maybe create Request class to handle deletion?
     * @todo Add try/catch, with support for error logging
     *
     * @param $id ID (e.g. primary key) of the entry to delete from the database.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector Redirects the user to the
     * users index page after the entry has been deleted.
     */
    public function destroy($id)
    {
        User::where('id', '=', $id)->delete();
        return redirect('users');
    }

    /**
     * Method: search()
     *
     * Purpose: Displays a view allowing a given user to enter search criteria to locate user information in the 
     * database.
     *
     * @todo Add validation to ensure authorization to perform search.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying the search criteria.
     */
    public function showSearch()
    {
        return view('test/users.search')->with('data',null);
    }

    /**
     * Method: email_addresses()
     *
     * Purpose: Displays a view allowing a user to enter user email addresses.
     *
     * @todo Add validation to ensure authorization to perform search.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying a form that allows a 
     * user to enter email addresses for a user.
     */
    public function email_addresses($id)
    {
        return "TODO";
    }

    /**
     * Method: get_telephone_types()
     *
     * Purpose: To retrieve a user's telephone(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_telephones($id)
    {
        return DB::table('user_telephones as ut')->where('user_id', $id)
            ->join('telephone_types as tt', 'ut.type_id', '=', 'tt.id')->get();
    }


    /**
     * Method: get_user_addresses
     *
     * Purpose: To retrieve a user's address(es) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_addresses($id)
    {
        return DB::table('user_addresses as ua')->where('user_id', $id)
            ->join('states as s', 'ua.state_id', '=', 's.id')->get();
    }


    /**
     * Method: get_user_fin_aid
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_fin_aid($id)
    {
        return  DB::table('user_financial_aid as uf')->where('user_id', $id)
            ->join('financial_aid_types as fat', 'uf.type_id', '=', 'fat.id')->get();
    }


    /**
     * Method: get_user_documents
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_documents($id)
    {
        return  DB::table('user_documents as ud')->where('user_id', $id)
            ->join('document_types as udt', 'ud.type_id', '=', 'udt.id')
            ->selectRaw('ud.*, ud.id as id, udt.description as description')
            ->get();
    }



    /**
     * Method: get_user_emergency_contact
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_emergency_contact($id)
    {
        return  DB::table('user_emergency_contacts as uec')->where('user_id', $id)
            ->join('relationships as r', 'uec.relationship_id', '=', 'r.id')
//            ->join('suffixes as s', 'uec.suffix_id', '=', 's.id')
            ->selectRaw('uec.*, uec.id as id, r.abbreviation as abbreviation, r.description as description')//,s.description as suffix')
            ->get();
    }



    /**
     * Method: get_user_certification
     *
     * Purpose: To retrieve a certification types(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_certifications($id)
    {
        return  DB::table('user_certifications as uc')->where('user_id', $id)
            ->join('certification_types as ct', 'uc.certification_id', '=', 'ct.id')
            ->selectRaw('uc.*, uc.id as id, ct.abbreviation as abbreviation, ct. description as description')
            ->get();
    }


    /**
     * Method: get_user_availabilities
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_availabilities($id)
    {
        return  DB::table('user_availabilities as ua')->where('user_id', $id)
            ->join('weekdays as w', 'ua.weekday_id', '=', 'w.id')
            ->join('semesters as s','ua.semester_id', '=', 's.id')
            ->selectRaw('ua.*, s.description as semester_desc, w.description as week_desc')
            ->orderby('s.id', 'DESC')->orderby('w.id')->orderby('ua.start_time')->get();
    }




    /**
     * Method: get_user_education
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_education($id)
    {
        return  DB::table('user_education_history as ueh')->where('user_id', $id)
            ->join('degree_types as dt', 'ueh.type_id', '=', 'dt.id')
            ->selectRaw('ueh.*, ueh.id as id, dt.abbreviation as abbreviation, dt.description as description')
            ->get();
    }


    /**
     * Method: get_user_work_experience
     *
     * Purpose: To retrieve a user's financial aid type(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */
    public function get_user_work_experience($id)
    {
        return  DB::table('user_work_experiences as uwe')->where('user_id', $id)->get();
    }

    public function get_user_schedule($id)
    {

        return $query = DB::table('schedule_entries as se')
            ->join('users as u', 'se.user_id', '=', 'u.id')
            ->join('schedules as s', 'se.schedule_id', '=', 's.id')
            ->join('semesters as sem', 's.semester_id', '=', 'sem.id')
            ->join('classrooms as c', 's.classroom_id', '=', 'c.id')
            ->where('u.id', '=', $id)
            ->orderBy('se.day')
            ->orderBy('se.start_time')
            ->orderBy('se.end_time')
            ->select(DB::raw('se.id as id,
                sem.description as semester,
                c.description as classroom,
                DAYNAME(se.day) as day,
                se.start_time as start_time,
                se.end_time as end_time,
                se.comment as comment'))->get();
    }





    /**
     * Method: get_student_relation_description()
     *
     * Purpose: To retrieve a user's relation(s) and return them.
     *
     * @param $id user ID to look for
     *
     * @return \Illuminate\Support\Collection
     */

}


/**
 * @todo integrate this comment into the balance of the logic or delete it
 *
 * SESSION OBJECTS for storing new applications
/*
public function createAddress()
{
    Session::set('first_name', Input::get('first_name'));
    Session::set('middle_name', Input::get('middle_name'));
    Session::set('last_name', Input::get('last_name'));
    Session::set('suffix_id', Input::get('suffix_id'));
    Session::set('gender_id', Input::get('gender_id'));

    return view('test/user_addresses.create')->with('states', State::lists('description', 'id'));
}
*/