<?php

namespace App\Http\Controllers;

use App\Country;
use App\State;
use App\User;
use App\Suffix;
use App\TelephoneType;
use App\DegreeType;
use App\FinancialAidType;
use App\Weekday;
use App\Semester;
use App\UserAddress;
use App\UserAvailability;
use App\UserEducationHistory;
use App\UserFinancialAid;
use App\UserPhilosophy;
use App\UserReference;
use App\UserTelephone;
use App\UserStatusType;
use App\UserWorkExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateApplicationRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentApplication;

/**
 * Class: ApplicationController
 *
 * Purpose: Class handles HTTP requests (e.g. GET, PUT, DELETE, etc.) for storing, updating, deleting and displaying
 *          data associated with student applications. Please see routes.php to see the routes associated with this class.
 *
 * Notes: Creates, updates and deletes use type hinted request objects to validate incoming data. By type hinting the
 *        request object, Laravel will validate the incoming request data BEFORE executing the store(), update() and
 *        destroy methods using the validation rules defined in the type hinted request object. If validation fails,
 *        the user is automatically re-routed to the previous page. Otherwise, the request object is passed to
 *        the store() method and the entry is stored in the database.
 *
 *        The class's create(), show(), index(), and edit() methods merely show views for data presentation or
 *        data entry. Create, update and delete operations are handled by the store(), update() and delete() methods.
 *
 *        Laravel supports REST and includes several services by default, such as store(), update(), delete(), index(),
 *        etc., which can be referenced in the routes file by using the notation
 *        Route::resource('[RESOURCE NAME]', '[CONTROLLER NAME']); in the routes file.
 *
 *
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * @package App\Http\Controllers
 */

class ApplicationController extends DefaultController
{
    /**
     * Method: index()
     *
     * Purpose: Creates a view that displays a list of applications submitted.
     * @todo Authorize user before displaying the page
     * @todo use a flag in the database to differentiate between new, pending and interviewed applications. Pass a query parameter into this function to display the types of application
     *
     * @param: int $application_type The type of applications to display
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($application_type)
    {
        $this->middleware('auth');

        return view('pages/admin/application.list')
                ->with('application', User::select(['users.id',
                                                  'users.first_name',
                                                  'users.middle_name',
                                                  'users.last_name',
                                                  'users.email',
                                                  'f.type_id',
                                                  'users.created_at'])
                                        ->leftJoin('user_financial_aid as f', 'users.id', '=', 'f.user_id')
                                        ->where([
                                            ['role_id','=',config('constants.role.APPLICATION')],
                                            ['user_status_id','=', $application_type]
                                            ])
                                        ->get())
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('fin_aid_types', FinancialAidType::pluck('description'));
    }

    /**
     * Method: create()
     *
     * Purpose: Creates a view that allows a user to fill out an application. On submit,
     *          the view calls the class's store() method to validate and store the new user in the database.
     *          Please see the store() method for additional information.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages/application.application')
            ->with('suffixes', Suffix::orderBy('id')->pluck('description'))
            ->with('states', State::orderBy('id')->pluck('description'))
            ->with('telephone_types', TelephoneType::orderBy('id')->pluck('description'))
            ->with('countries', Country::orderBy('id')->pluck('description'))
            ->with('degree_types', DegreeType::orderBy('id')->pluck('description'))
            ->with('fin_aid_types',FinancialAidType::orderBy('id')->pluck('description'))
            ->with('semesters', Semester::orderBy('id')->pluck('description', 'id'))
            ->with('weekdays', Weekday::orderBy('id')->pluck('description', 'id'));
    }


    /**
     * Method: store()
     *
     * Purpose: Attempts to store a student worker application in the database.
     *          If the object validates successfully, the request object's data
     *          is used to create a new user in the database and the user is redirected
     *          to the success page.
     *
     * Notes: See notes above regarding type hinted request object.
     *
     * @todo Log errors, route errors to error page
     * @todo finalize when relevant fields have been created in the back end
     * @todo create a success page for the application to redirect to after successful submission
     * @todo validate incoming request by creating request classes
     * @todo create a default password for applications
     *
     * @param Request $request Type hinted request object that validates the incoming data.
     *
     * @return Redirect Redirect the user to the success page
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = User::create([
                'enumber'=>$request->get('enumber'),
                'first_name' => $request->get('first_name'),
                'middle_name' => $request->get('middle_name'),
                'last_name' => $request->get('last_name'),
                'suffix_id' => $request->get('suffix') + 1,
                'over_18' => $request->get('age'),
                'role_id' => config('constants.role.APPLICATION'),
                'email' => $request->get('student_email'),
                'alternate_email' => $request->get('student_email2'),
                'password' => bcrypt('test'),
                'user_status_id'=>config('constants.user_status.NEW')
            ])->id;

            UserAddress::create([
                'user_id' => $id,
                'address1' => $request->get('address'),
                'address2' => $request->get('address2'),
                'city' => $request->get('city'),
                'state_id' => $request->get('state') + 1,
                'country_id'=>$request->get('country') + 1,
                'zipcode' => $request->get('zip_code'),
                'is_primary' => config('constants.boolean.TRUE')
            ]);
            
            

            if ($request->has('telephone_type')) {
                $i = 0;
                foreach ($request->input('telephone_type') as $type) {
                    UserTelephone::create([
                        'user_id' => $id,
                        'telephone_number' => $request->get('student_phone')[$i],
                        'type_id' => $request->get('telephone_type')[$i] + 1,
                        'is_primary' => ($i==0)? config('constants.boolean.TRUE'): config('constants.boolean.FALSE')
                    ]);
                    $i++;
                }
            }

            //need logic for including multiple financial aid types as well as validation
            //for instance student cannot be a GA and have another financial aid
            if ($request->get('worker_type')) {
                    UserFinancialAid::create([
                        'user_id' => $id,
                        'type_id' => $request->get('worker_type') + 1
                    ]);
            }

            foreach ([2 => 'philosophy_0_2', 3 => 'philosophy_3_5', 4 => 'abilities'] as $key => $value) {
                UserPhilosophy::create([
                    'user_id' => $id,
                    'type_id' => $key,
                    'philosophy' => $request->get($value)
                ]);
            }

            for ($i = 1; $i < 4; $i++) {
                UserReference::create([
                    'user_id' => $id,
                    'first_name' => $request->get('reference_fname_' . $i),
                    'middle_name' => $request->get('reference_mname_' . $i),
                    'last_name' => $request->get('reference_lname_' . $i),
                    'telephone_number' => $request->get('reference_phone_' . $i),
                    'type_id' => config('constants.telephone_type.UNSPECIFIED'),
                    //uncomment after creating email field in references table
                    //'email'=>$request->get('reference_email_'.$i)
                ]);
            }

            if ($request->has('company')) {
                $i=0;
                foreach ($request->input('company') as $company){
                    UserWorkExperience::create([
                        'user_id' => $id,
                        'company_name' => $request->get('company')[$i],
                        'date_left' => date('Y-m-d', strtotime($request->get('date_left')[$i])),
                        'reason_for_leaving' => $request->get('reason')[$i]
                    ]);
                    $i++;
                }
            }
            if ($request->has('institution')) {
                $i = 0;
                foreach ($request->input('institution') as $institution) {
                    UserEducationHistory::create([
                        'user_id' => $id,
                        'institution' => $request->get('institution')[$i],
                        'graduation_date' => date('Y-m-d',strtotime($request->get('graduation_date')[$i])),
                        'type_id' => $request->get('degree')[$i]+1
                    ]);
                    $i++;
                }
            }

            if ($request->has('weekday_id')) {
                $i=0;
                foreach ($request->input('weekday_id') as $weekday){
                    UserAvailability::create([
                        'user_id' => $id,
                        'semester_id' => $request->get('semester_id'),
                        'weekday_id' => $request->get('weekday_id')[$i],
                        'start_time' => date('H:i:s',strtotime($request->get('start_time')[$i])),
                        'end_time'=> date('H:i:s',strtotime($request->get('end_time')[$i]))
                    ]);
                    $i++;
                }
            }


            DB::commit();
            //redirect to success page and send out an email
            //this has been commented for now because we don't want emails flying
            $application= User::find($id);
            Mail::to($application->email)->send(new StudentApplication($application));
            return view('pages.application.submit_success');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
            Log::info('Error encountered while submitting an application', ['exception'=>$exception]);
            return view('errors.500');
        }
    }

    /**
     * Method: show()
     *
     * Purpose: Creates a view of a specific application that is stored in the database.
     *
     * @todo Log errors, route errors to error page
     * @todo Finalize when relevant fields have been created in the back end
     *
     * @param $id ID (e.g. primary key) of the user or application the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing application
     * information.
     */
    public function show($id)
    {
        try
        {
            $this->middleware('auth');
            $user=User::find($id);

            $temp = new UserController();
            $avail = $temp->get_user_availabilities($id);

            foreach($avail as $item)
            {
                $item->start_time = date("g:i a", strtotime($item->start_time));
                $item->end_time = date("g:i a", strtotime($item->end_time));
            }

            return view('pages/admin/application.summary')
                    ->with('sidebar_data', parent::get_sidebar_data())
                    ->with('suffixes', Suffix::pluck('description'))
                    ->with('states', State::pluck('description'))
                    ->with('weekday', Weekday::pluck('description'))
                    ->with('telephone_types', TelephoneType::pluck('description'))
                    ->with('countries', Country::pluck('description'))
                    ->with('degree_types', DegreeType::pluck('description'))
                    ->with('fin_aid_types',FinancialAidType::pluck('description'))
                    ->with('user', $user)
                    ->with('address', UserAddress::where('user_id', $id)->where('is_primary',config('constants.boolean.TRUE') )->first())
                    ->with('aids', UserFinancialAid::where('user_id', $id)->get())
                    ->with('education_history', UserEducationHistory::where('user_id', $id)->join('degree_types as dt', 'type_id', '=', 'dt.id')->get())
                    ->with('philosophies', UserPhilosophy::orderBy('type_id', 'ASC')->where('user_id', $id)->get())
                    ->with('references', UserReference::where('user_id', $id)->get())
                    ->with('telephones', UserTelephone::where('user_id', $id)->where('is_primary',config('constants.boolean.TRUE'))->first())
                    ->with('work_experiences', UserWorkExperience::where('user_id', $id)->get())
                    ->with('user_availability', $avail)
                    ->with('application_status', (UserStatusType::where('id', $user->user_status_id)->pluck('description')->first()));

        }
        catch(Exception $exception)
        {
            Log::info('Error encountered while viewing application',['exception'=>$exception, 'id'=>$id]);
            return view('errors.500');
        }
    }

    /**
     * Method: action()
     *
     * Purpose: Changes the status of an application (i.e. user_status_id) depending on the action taken
     *
     * @todo Log errors, route errors to error page
     *
     * @param $request Request object with an id to perform action on and the new status
     * @return boolean value representing the status of action change
     */
    public function action(Request $request)
    {
        $application = User::find($request->input('id'));
        $application->role_id = config('constants.role.STUDENT_WORKER');
        $application->user_status_id = $request->input('status');
        if($saved=$application->save()) {
            //send out email
            //commented because we dont want emails flying around when developing
            //if you want to test this feature then create an application with your email and change the status of this application
            Mail::to($application->email)->send(new StudentApplication($application));
            echo $saved;
        }
    }

}
