<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

use App\Semester;
use App\Classroom;
use App\Weekday;
use App\Schedule;
use App\ScheduleEntry;
use App\Util;

use Carbon\Carbon;

use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;

/**
 * Class ScheduleController
 * @package App\Http\Controllers
 */
class ScheduleController extends Controller
{
    /**
     * @todo add header comments
     * @todo add try/catch, with error logging
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages/admin/schedule.index')
            ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
            ->with('classrooms', Classroom::orderBy('id')->pluck('description'))
            ->with('semesters',  Semester::orderBy('id')->pluck('description'))
            ->with('data', Schedule::orderBy('description', 'ASC')->get());
    }

    /**
     * @todo add header comments - note why this is empty
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function show($id)
    {

    }

    /**
     * @todo add header comments
     * @todo add try/catch, with error logging
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('pages/admin/schedule.edit')
                    ->with('data', Schedule::find($id))
                    ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
                    ->with('semesters',
                            Semester::orderBy('id','ASC')
                            ->pluck('description','id'))
                    ->with('classrooms',
                            Classroom::orderBy('id','ASC')
                            ->pluck('description', 'id'));
    }

    /**
     * @todo add header comments
     * @todo is a try/catch needed here, due to use of jqxWidget for schedule management?
     *
     */
    public function create()
    {
        return view('pages/admin/schedule.create')
                                            ->with('semesters',
                                                    Semester::orderBy('id','ASC')
                                                    ->pluck('description','id'))
                                            ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
                                            ->with('classrooms',
                                                    Classroom::orderBy('id','ASC')
                                                    ->pluck('description', 'id'));
    }

    /**
     * Method: store()
     *
     * Purpose: Stores a schedule in the database. The method DOES NOT store schedule entries (e.g. appointments). The
     *          method is merely used to store 
     *
     * @todo add try/catch, with error logging
     *
     * @param id - id (e.g. primary key) of an existing schedule.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - Redirects the user to the Schedule's index
     *          page/view.
     */
    public function store(CreateScheduleRequest $request)
    {
        Schedule::create($request->all());
        return redirect('schedules');
    }

    /**
     * @todo add header comments
     * @todo add try/catch, with error logging
     *
     * @param $id
     *
     * @param UpdateScheduleRequest $request
     *
     * @return Redirect
     */
    public function update($id, UpdateScheduleRequest $request)
    {
        Schedule::find($id)->update($request->all());
        return redirect('schedules/'.$id.'/scheduler');
    }

    /**
     * Method: destroy()
     *
     * Purpose: Deletes a schedule and its subsequent schedule entries (appointments) from the database.
     *
     * @todo add try/catch, with error logging
     *
     * @param id - id (e.g. primary key) of an existing schedule.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - Redirects the user to the Schedule's index
     *          page/view.
     */
    public function destroy($id)
    {
        Schedule::where('id', '=', $id)->delete();
        return redirect('schedules');
    }

    /**
     * Method: scheduler()
     *
     * Purpose: Locates an existing schedule in the database and returns the schedule to the user so the user can view,
     *          add, delete or update appointments.
     *
     * @todo Log errors, route errors to error page
     *
     * @param id - id (e.g. primary key) of an existing schedule.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - Redirects the user to the Scheduler view,
     *          which allows a user to add, update, delete, or view schedule appointments.
     */
    public function scheduler($id)
    {
        try 
        {
            $schedule = Schedule::find($id);

            if (!is_null($schedule)) 
            {
                $entries = Util::encodeJSON($this->getScheduleEntries($schedule->id));

                return view('pages/admin/schedule.scheduler')
                        ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
                        ->with('schedule', $schedule)
                        ->with('entries', $entries);
            } else 
            {
                throw new Exception("Schedule could not be located in the database");
            }
        }
        catch(Exception $exception)
        {
            //Log error and route to error page
        }    
    }
    
    /**
     * Method: getAvailabilities()
     * 
     * Purpose: Gets a list of users and their certifications (if applicable) who are available to work based upon the 
     *          incoming user supplied parameters. For instance a user may request everyone who is available to work
     *          between 8:00 am and 9:00 am.  
     *
     * Limitations: Method EXPECTS the caller to pass a start time, end time and corresponding schedule id associated 
     *              with the availabilities request. The schedule id is used to get a handle to an existing schedule,
     *              which contains a handle to the given classroom and semester associated with the schedule. 
     * 
     * @return string - Null or JSON value representing the data returned from the query.
     */
    public function getAvailabilities()
    {
        try 
        {
            $day = null;
            $data = null;

            //==========================================================================================================
            //Get the values supplied by the user .
            //==========================================================================================================
            $start_time = Input::get('start', null);
            $end_time = Input::get('end', null);
            $schedule = Input::get('schedule_id', null);

            //==========================================================================================================
            //Ensure the caller supplied the necessary information to limit the query before continuing.
            //==========================================================================================================
            if (!is_null($start_time) && !is_null($end_time) && !is_null($schedule)) 
            {
                $schedule = Schedule::find($schedule);

                if (!empty($schedule)) 
                {
                    //==================================================================================================
                    //Determine the day of the week (e.g. Monday, Tuesday, etc.) associated with the incoming date
                    //value.
                    //==================================================================================================
                    $day = date('l', strtotime($start_time));

                    //==================================================================================================
                    //Parse the incoming data
                    //==================================================================================================
                    $start_time = explode(' ', Input::get('start'))[1];
                    $end_time = explode(' ', Input::get('end'))[1];
                    $weekday = Weekday::where('description', $day)->first();

                    //==================================================================================================
                    //Query the database for user with availabilities who match the incoming criteria.
                    //==================================================================================================
                    $query = DB::table('users as u')
                                ->join('classroom_assignments as ca', 'u.id', '=', 'ca.user_id')
                                ->join('user_availabilities as ua', 'u.id', '=', 'ua.user_id')
                                ->leftJoin('user_certifications as uc', 'u.id', '=', 'uc.user_id')
                                ->leftJoin('certification_types as ct', 'uc.certification_id', '=', 'ct.id')
                                ->where('ua.semester_id', '=', $schedule->semester->id)
                                ->where('ca.classroom_id', '=', $schedule->classroom->id)
                                ->where('ua.weekday_id', '=', $weekday->id)
                                ->where('ua.start_time', '<=', $start_time)
                                ->where('ua.end_time', '>=', $end_time)
                                ->orderBy('u.last_name')
                                ->orderBy('u.first_name')
                                ->select('u.id as user_id',
                                    'u.first_name as first_name',
                                    'u.last_name as last_name',
                                    DB::raw("CONCAT(ct.abbreviation,',') as certifications"));
                    
                    if(env('APP_DEBUG'))
                    {
                        Log::info("\nWeekday = " . $weekday->description . " ID = " . $weekday->id);
                        Log::info("Start Time = " . $start_time);
                        Log::info("End Time = " . $end_time);
                        Log::info("Schedule: " . " Semester ID = " . $schedule->semester_id .
                                  ", Classroom ID = " . $schedule->classroom_id);
                        Log::info("SQL: " . $query->toSql());
                    }
                    
                    //======================================================================================================
                    //Encode the result set as a JSON string so the front end will be able to process it.
                    //======================================================================================================
                    $data = Util::encodeJSON($query->distinct()->get());
                }
            }

            return $data;
        }
        catch(Exception $exception)
        {
            
        }

    }

    /**
     * Method: deleteAppointments()
     *
     * Purpose: Deletes a list of user selected schedule appointments that were previously stored in the
     * database.
     *
     * @param $appointments - JSON object containing a list of schedule entries that the user selected to delete.
     * 
     * @return None
     */
    public function deleteAppointments($appointments)
    {
        //==============================================================================================================
        //Make sure we have data that needs to be stored before proceeding...
        //==============================================================================================================
        if (!is_null($appointments)) 
        {
            //==========================================================================================================
            //If so, decode the incoming JSON object and convert it into an associative array.
            //==========================================================================================================
            $appointments = json_decode($appointments, true);

            //==========================================================================================================
            //Now step through the array and delete the appointments
            //==========================================================================================================
            if (is_array($appointments)) 
            {
                foreach ($appointments as $item) 
                {
                    Log::info("DELETING " . $item['entry_id']);
                    $id = $item['entry_id'];
                    
                    //==================================================================================================
                    //If the appointment's id is less than 0 then it's a new entry, so disregard. Only delete entries
                    //that have been previously stored in the database.
                    //==================================================================================================
                    if ($id > 0) 
                    {
                        ScheduleEntry::where('id', '=', $id)->delete();
                    }
                }
            }
        }
    }

    /**
     * Method: saveAppointment()
     *
     * Purpose: Stores and deletes user entered/selected appointments associated with a given schedule.
     *
     * Note: Method is called via AJAX. See the blade template schedules.scheduler, saveData() method for more
     *       information.
     * 
     * @todo Add validation.
     * @todo Log errors, route errors to error page
     *
     * @return string - Null or JSON string value containing a list of appointments associated with a given schedule.
     */
    public function saveAppointments()
    {
        try 
        {
            $schedule_id = Input::get('schedule_id', null);
            $appointments = Input::get('appointments', null);
            $deletedAppointments = Input::get('deletedAppointments', null);

            //==============================================================================================================
            //Make sure we have data that needs to be stored before proceeding...
            //==============================================================================================================
            if (!is_null($schedule_id) && !is_null($appointments)) 
            {
                //==========================================================================================================
                //Get a handle to the schedule that will be associated with the incoming schedule entries.
                //==========================================================================================================
                $schedule = Schedule::find($schedule_id);

                //==========================================================================================================
                //If the schedule exists, then add the schedule entries to the schedule.
                //==========================================================================================================
                if ($schedule) 
                {
                    //======================================================================================================
                    //Decode the JSON as an associative array.
                    //NOTE: Include the true parameter to make the return type an associative array
                    //======================================================================================================
                    $appointments = json_decode($appointments, true);

                    foreach ($appointments as $item) 
                    {
                        $entry = null;                  //Object will be used to store a new entry or update an existing
                                                        //entry
                        $entry_id = $item['entry_id'];  //Value will be checked to determine if new or existing entry.

                        //==============================================================================================
                        //Use Carbon to manipulate date/time values
                        //==============================================================================================
                        $start = Carbon::parse($item['start_date']);
                        $end = Carbon::parse($item['end_date']);
                        $start_time = Carbon::createFromTime($start->hour, $start->minute, $start->second);
                        $end_time = Carbon::createFromTime($end->hour, $end->minute, $end->second);

                        //==============================================================================================
                        //If it's a new entry, then it's entry_id will be set to -1 or below, so process as a new entry
                        //==============================================================================================
                        if ($entry_id <= -1) 
                        {
                            $entry = new ScheduleEntry;
                        }
                        //==============================================================================================
                        //If the entry_id > -1, then it's an existing entry so we will need to update it.
                        //==============================================================================================
                        else 
                        {
                            $entry = ScheduleEntry::find($entry_id);
                        }

                        //==============================================================================================
                        //Now set the parameters and store the data in the database.
                        //==============================================================================================
                        $entry->schedule_id = $schedule->id;
                        $entry->user_id = $item['user_id'];
                        $entry->day = $start;
                        $entry->start_time = $start_time;
                        $entry->end_time = $end_time;
                        //$entry->background_color = $item['background'];

                        $entry->save();
                    }
                }
            }

            //==========================================================================================================
            //Now, delete appointments that have been flagged by the user for deletion.
            //==========================================================================================================
            $this->deleteAppointments($deletedAppointments);

            //==========================================================================================================
            //Get the updated list of entries from the database so we can allow the user to save as they go. The UI
            //(e.g. the jqxScheduler controller) to be returned as a JSON string, so format the data as a JSON array and
            //send it to the user interface for display.
            //==========================================================================================================
            return Util::encodeJSON($this->getScheduleEntries($schedule_id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page.    
        }
    }

    /**
     * @param $schedule_id
     * @return mixed
     */
    private function getScheduleEntries($schedule_id)
    {
        $schedule = Schedule::find($schedule_id);

        if(!is_null($schedule))
        {
            $query = DB::table('schedule_entries as se')
                       ->join('users as u', 'se.user_id', '=', 'u.id')
                       ->where('se.schedule_id', '=', $schedule->id)
                       ->orderBy('se.day')
                       ->orderBy('se.start_time')
                       ->orderBy('se.end_time')
                       ->select('se.id as id',
                                'u.id as user_id',
                                'u.first_name as first_name',
                                'u.last_name as last_name',
                                'se.schedule_id as schedule_id',
                                'se.day as day',
                                'se.start_time as start_time',
                                'se.end_time as end_time',
                                'se.comment as comment');
            return $query->get(); 
        }
    }    
}