<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Semester;
use App\Classroom;

/**
 * Class AvailabilityReportsController
 * @package App\Http\Controllers
 */
class AvailabilityReportsController extends DefaultController
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
     * Method: availabilities()
     *
     * Purpose: Method gets the active users, classrooms and semesters from the database and supplies them to the
     *          availabilities view. The information is displayed in drop down boxes or list boxes for selection
     *          purposes. The selections will be used as criteria for generating the availabilities report (see
     *         availabilitiesReport() method in this class for additional information).
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - View that allows the user to select a set
     *         of criteria (classroom, semester, user(s)) that will be used to generate the availabilities report (see
     *         availabilitiesReport() method in this class for additional information).
     */
    public function availabilities()
    {
        return view('pages/admin/reports/availabilities/availabilities')
               ->with('users', User::select(DB::raw("CONCAT(first_name,' ',last_name) AS full_name"))->where('id','>',1)->orderBy('first_name','ASC')->pluck('full_name')->all())
               ->with('classrooms', Classroom::orderBy('description')->pluck('description','id'))
               ->with('semesters', Semester::orderBy('description')->pluck('description','id'))
                ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: gaps()
     *
     * Purpose: Method gets the lists of classrooms and semesters from the database and supplies them to the
     *          gaps view. The information is displayed in drop down boxes for selection purposes. The selections will
     *          be used as criteria for generating the gaps report (see gapsReport() method in this class for additional
     *          information).
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - View that allows the user to select a set
     *         of criteria (classroom, semester) that will be used to generate the availabilities gaps report (see
     *         gapsReport() method in this class for additional information).
     */
    public function gaps()
    {
        return view('pages/admin/reports/availabilities/gaps')
               ->with('classrooms', Classroom::orderBy('description')->pluck('description','id'))
               ->with('semesters', Semester::orderBy('id','DESC')->pluck('description','id'))
        ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @todo add header comment
     */
    public function gapsReport()
    {
        //==============================================================================================================
        //Get the user-supplied parameters (report criteria).
        //==============================================================================================================
        $classroom = Input::get('classroom_id', null);
        $semester = Input::get('semester_id', null);

        if(env('APP_DEBUG'))
        {
            Log::info('\n');
            Log::info('==============================================================================================');
            Log::info('Inside AvailabilityReportsController->gapsReport()');
            Log::info('Classroom = ' . $classroom);
            Log::info('Semester =' . $semester);
            Log::info('\n');
        }

        $query = null;

        if(env('APP_DEBUG'))
        {
            Log::info('Query string: ' . $query->toSql());
            Log::info('Exiting AvailabilityReportsController->usersReport()');
            Log::info('==============================================================================================');
        }

        //==============================================================================================================
        //Get the requested data from the database and pass it to the view for presentation purposes.
        //==============================================================================================================
        return view('pages/admin/reports/availabilities/gapsReport')
            ->with('data', $query->get())
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * Method: availabilitiesReport()
     *
     * Purpose: Method queries the database based upon the user-supplied criteria and returns the result set to the
     *          availabilitiesReport view for display purposes.
     *
     * @todo The availabilitiesReport view needs to be refactored to display multiple entries for a given semester,
     *       classroom and/or user in a readable format. The view will display the information correctly. However, the
     *       formatting does not separate a user's availabilities by semester or classroom, such as
     *
     *              First Name      Last Name   Semester    Classroom   Weekday     Start Time      End Time
     *              Test            Tester      Fall 2016   Cheetahs    Monday      10:00am         12:00pm
     *
     *              First Name      Last Name   Semester    Classroom   Weekday     Start Time      End Time
     *              Test            Tester      Winter 2016 Toads       Monday      8:00am          10:00am
     *
     *      The information is currently displayed as:
     *
     *              First Name      Last Name   Semester        Classroom   Weekday     Start Time      End Time
     *              Test            Tester      Fall 2016       Cheetahs    Monday      10:00am         12:00pm
     *              Test            Tester      Winter 2016     Toads       Monday      8:00am          10:00am
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - View showing availabilities of selected
     *         semester, classroom and/or user(s). A data object (collection) is supplied to the view, which contains
     *         the following fields for display purposes:
     *
     *                  first_name - Employee's first name.
     *                  last_name  - Employee's last name.
     *                  semester   - Name/Description of the semester which the employee is assigned.
     *                  classroom  - Name/Description of the classroom which the employee is assigned.
     *                  weekday    - Day of the week (e.g. Monday, Tuesday, etc.) the employee is scheduled to work.
     *                  start_time - Time the employee is to start work.
     *                  end_time   - Time the employee is to end work.
     */
    public function availabilitiesReport()
    {
        //==============================================================================================================
        //Get the parameters (report criteria) supplied by the user.
        //==============================================================================================================
        $classroom = Input::get('classroom_id', null);
        $semester = Input::get('semester_id', null);
        $users = Input::get('users', null);

        //==============================================================================================================
        //Check the APP_DEBUG environment variable to determine if DEBUG is enabled (e.g. true). If so then log
        //pertinent debug information to the Laravel log file located at path storage->logs->laravel.log.
        //==============================================================================================================
        if(env('APP_DEBUG'))
        {
            Log::info('\n');
            Log::info('==============================================================================================');
            Log::info('Inside AvailabilityReportsController->usersReport()');
            Log::info('Classroom = ' . $classroom);
            Log::info('Semester =' . $semester);
            Log::info('Selected users:');
            Log::info($users);
            Log::info('\n');
        }

        //==============================================================================================================
        //The query builder call emulates the following SQL statement, which is included here for readability and
        //testing purposes:
        //
        //  select  u.first_name as first_name,
        //          u.last_name as last_name,
        //          s.description as semester,
        //          c.description as classroom,
        //          w.description as weekday,
        //          ua.start_time as start_time,
        //          ua.end_time as end_time
        //    from  users as u,
        //          classroom_assignments ca,
        //          user_availabilities ua,
        //          classrooms as c,
        //          semesters as s,
        //          weekdays as w
        // where    u.id = ca.user_id
        // and      ca.user_id = ua.user_id
        // and      ca.semester_id = ua.semester_id
        // and      s.id = ca.semester_id
        // and      c.id = ca.classroom_id
        // and      w.id = ua.weekday_id
        // and      ca.user_id = ua.user.id
        // and      ca.semester_id = ua.semester.id
        //==============================================================================================================

        $query = DB::table('users as u')
                    ->join('classroom_assignments as ca', 'u.id', '=', 'ca.user_id')
                    //==================================================================================================
                    //Be sure to join the classroom_assignments and user_availabilities tables on the user_id and
                    //semester_id fields to delimit the query correctly. Otherwise the query will produce the incorrect
                    //results.
                    //==================================================================================================
                    ->join('user_availabilities as ua', function($join)
                      {
                        $join->on('ua.user_id', '=', 'u.id')
                             ->on('ua.semester_id', '=', 'ca.semester_id');
                      })
                    ->join('classrooms as c', 'ca.classroom_id', '=', 'c.id')
                    ->join('semesters as s', 'ca.semester_id', '=', 's.id')
                    ->join('weekdays as w', 'ua.weekday_id', '=', 'w.id')
                    ->orderBy('u.last_name')
                    ->orderBy('u.first_name')
                    ->orderBy('ca.semester_id')
                    ->orderBy('ca.classroom_id')
                    ->orderBy('ua.weekday_id')
                    ->orderBy('ua.start_time')
                    ->orderBy('ua.end_time')
                    ->select('u.first_name as first_name',
                             'u.last_name as last_name',
                             'c.description as classroom',
                             's.description as semester',
                             'w.description as weekday',
                             'ua.start_time as start_time',
                             'ua.end_time as end_time');

        //==============================================================================================================
        //Now that we have built the query, we must supply the user-selected conditions, such as the classroom,
        //semester and/or user(s) if selected.
        //==============================================================================================================
        if(!is_null($classroom) && $classroom > 1)
        {
            $query->where('ca.classroom_id','=',$classroom);
        }

        if(!is_null($semester) && $semester > 1)
        {
            $query->where('ca.semester_id','=',$semester);
        }

        //==============================================================================================================
        //Keep in mind the $users parameter is an array, which may contain 0 or more values (e.g. id's (primary keys)
        //of users stored in the database.
        //==============================================================================================================
        if(!is_null($users))
        {
            $query->whereIn('u.id', $users);
        }

        if(env('APP_DEBUG'))
        {
            Log::info('Query string: ' . $query->toSql());
            Log::info('Exiting AvailabilityReportsController->usersReport()');
            Log::info('==============================================================================================');
        }

        //==============================================================================================================
        //Get the requested data from the database and pass it to the view for presentation purposes.
        //==============================================================================================================
        return view('pages/admin/reports/availabilities/availabilitiesReport')
            ->with('data', $query->get())
            ->with('sidebar_data', parent::get_sidebar_data());
    }
}
