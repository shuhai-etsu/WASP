<?php

namespace App\Http\Controllers;
use App\ScheduleEntry;


/**
 * Class: StudentScheduleController
 *
 * Purpose: Class is responsible for handling HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating,
 *          deleting and displaying data associated with schedule. Please see routes.php to see the routes
 *          associates with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data using the validation rules defined in the
 *        type hinted request object BEFORE executing the store(), update() and destroy() methods. If validation
 *        fails, the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database. Please see CreateStudentScheduleRequest for
 *        additional information regarding validation.
 *
 *        The class's index() method lists the schedule for the student for the day with start and end time.
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
class StudentScheduleController extends DefaultController
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
     * Purpose: Used to display the entire list of student schedule day and date that the database currently stores. The database's
     *          first, blank entry is ignored. Only entries that contain data are displayed to
     *          the user. The entries are sorted in ASCENDING order.
     *
     * @todo add try/catch, with support for error logging
     * @todo restore logic for supporting initial blank entry
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return the view to the user showing the
     * student schedule day and date stored in the database
     */
    public function index()
    {
        try {
            return view('pages/student.studentSchedule')->with('data', ScheduleEntry::where('id', '>', 1)
                ->orderby('day', 'ASC')
                ->get());
        }
        catch(Exception $exception)
        {

        }
    }
}