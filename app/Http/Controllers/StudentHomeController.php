<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmergContacts;
use App\UserTelephone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Relationship;
use App\TelephoneType;
use App\UserAddress;
use App\FinancialAidType;
use App\UserFinancialAid;
use App\State;
use App\Suffix;
use App\UserEmergencyContact;
use App\UserCertification;
use App\Semester;
use App\Weekday;
use App\UserAvailability;
use App\CertificationType;
use App\Http\Requests\UserAvailabilityRequest;
use App\Http\Requests\UpdateUserCertificationRequest;
use App\Http\Requests\CreateEmergencyContactRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserTelephoneRequest;

class StudentHomeController extends DefaultController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('web');
    }

    public function personal_information()
    {
    $id=Auth::id();
    $user = new UserController();
    $telephones = $user->get_user_telephones($id);
    $addresses = $user->get_user_addresses($id);
    $fin_aid = $user->get_user_fin_aid($id);


    return view('pages/student/personal_information/personal_information')->with('data', User::find($id))
        ->with('telephones', $telephones)
        ->with('addresses', $addresses)
        ->with('fin_aid', $fin_aid);
    }

    public function edit_personal_information()
    {
            $id=Auth::id();
            $user = new UserController();
            $telephones = $user->get_user_telephones($id);
            $addresses=$user->get_user_addresses($id);
            $fin_aid=$user->get_user_fin_aid($id);

            return view('pages/student/personal_information/edit')->with('data', User::find($id))
                ->with('telephones', $telephones)
                ->with('addresses', $addresses)
                ->with('states', State::orderby('id')->pluck('description'))
                ->with('telephone_types', TelephoneType::orderby('id')->pluck('description'))
                ->with('fin_aid_types',FinancialAidType::orderby('id')->pluck('description'))
                ->with('fin_aid', $fin_aid);
    }

    /**
     * Method: update_personal_info()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Redirect to user profile view
     */
    public function update_personal_info(Request $request)
    {
        try{
            $id=Auth::id();

            $user_addr = UserAddress::where('user_id', $id)->get()->all();
            $i=0;
            foreach ($user_addr as $addr){
                $addr->address1 = $request->get('address1');
                $addr->address2 = $request->get('address2');
                $addr->city = $request->get('city');
                $addr->state_id = $request->get('state')+1;
                $addr->zipcode = $request->get('zip');
                $addr->save();
                $i++;
            }

            $user_tele = UserTelephone::where('user_id', $id)->get()->all();
            $i=0;
            foreach ($user_tele as $tele){
                $tele->telephone_number = $request->get('telephone_number')[$i];
                $tele->type_id = $request->get('telephone_type')[$i]+1;
                $tele->save();
                $i++;
            }

            $user_aid = UserFinancialAid::where('user_id', $id)->get()->all();
            $i=0;
            foreach ($user_aid as $aid) {
                $aid->type_id = $request->get('worker_type')[$i] + 1;
                $aid->save();
                $i++;
            }

            $user=User::find($id);
            $user->alternate_email=$request->get('email');
            $user->save();
        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('studentPersonalInformation');
    }

    public function emergency_contact()
    {
        $id=Auth::id();
        $user= new UserController();
        $emergency_contact=$user->get_user_emergency_contact($id);

        return view("pages/student/emergency_contact/emergencyContact")->with('data', User::find($id))
            ->with('relationships', Relationship::orderBy('id')->pluck('description'))
            ->with('emergency_contact',$emergency_contact);
    }

    public function edit_emergency_contact($contact_id)
    {
        try
        {
            $id=Auth::id();
            if ($id)
            {
                $user = new UserController();
                $emergency = $user->get_user_emergency_contact($id)->where('id',$contact_id)->first();

                return view('pages/student/emergency_contact.edit')->with('data', User::find($id))
                    ->with('relationship', Relationship::orderby('id')->pluck('description','id'))
                    ->with('contacts', $emergency);
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

    public function update_emergency_contact($contact_id, UpdateEmergContacts $request)
    {

        try{
            $user_emerg = UserEmergencyContact::findOrFail($contact_id);
            $user_emerg->first_name = $request->get('first_name');
            $user_emerg->middle_name = $request->get('middle_name');
            $user_emerg->last_name = $request->get('last_name');
            $user_emerg->relationship_id = $request->get('relationship');
            $user_emerg->telephone_number = $request->get('telephone');
            $user_emerg->email = $request->get('email');
            $user_emerg->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('studentEmergencyContact');

    }

    public function create_emergency_contact()
    {
        $id=Auth::id();
        $user=new UserController();
        $emergency_contact = $user->get_user_emergency_contact($id);
        return view('pages/student/emergency_contact.create')->with('emergency_contact', $emergency_contact)
            ->with('relationships', Relationship::orderby('id')->pluck('description','id'));
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param CreateEmergencyContactRequest $request
     * @return mixed
     */
    public function store_emergency_contact(CreateEmergencyContactRequest $request)
    {

        $id=Auth::id();

        try{
            $user_emergency_contact = new UserEmergencyContact($request->all());
            $user_emergency_contact->user_id = $id;
            $user_emergency_contact->first_name=$request->get('first_name');
            $user_emergency_contact->middle_name=$request->get('middle_name');
            $user_emergency_contact->last_name=$request->get('last_name');
            $user_emergency_contact->relationship_id = $request->get('relationship_id')-1;
            $user_emergency_contact->telephone_number = $request->get('telephone_number');
            $user_emergency_contact->email= $request->get('email');
            $user_emergency_contact->comment=$request->get('comment');
            $user_emergency_contact->save();

        }
        catch(Exception $exception) {
            //Log error and route to errors page
            Log::info('Error encountered while creating a new availability', ['exception' => $exception]);
            return view('errors.500');
        }
        return redirect('studentEmergencyContact');

    }


    public function education_history()
    {
        $id=Auth::id();
        $user= new UserController();
        $education_history=$user->get_user_education($id);

        return view("pages/student/education_history/education_history")->with('data', User::find($id))
            ->with('education_history', $education_history);
    }

    public function work_experience()
    {
        $id=Auth::id();
        $user= new UserController();
        $work_experience=$user->get_user_work_experience($id);

        return view("pages/student/work_experience/work_experience")->with('data', User::find($id))
            ->with('work_experience',$work_experience);
    }

    public function availabilities()
    {
        $id=Auth::id();
        $user=new UserController();
        $availabilities= $user->get_user_availabilities($id);

        return view("pages/student/availabilities/view")->with('data', User::find($id))
            ->with('availabilities',$availabilities);
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     */
    public function create_availabilities()
    {

        $id=Auth::id();
        $user=new UserController();
        $availabilities = $user->get_user_availabilities($id);
        return view('pages/student/availabilities.create')->with('availabilities', $availabilities)
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('semesters', Semester::orderBy('id')->pluck('description', 'id'))
            ->with('weekdays', Weekday::orderBy('id')->pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @param UserAvailabilityRequest $request
     * @return mixed
     */
    public function store_availabilities(UserAvailabilityRequest $request)
    {

        $start = explode(':', Input::get('start_time'));
        $end =  explode(':', Input::get('end_time'));

        $obj = new UserAvailability;
        $id=Auth::id();

        $obj->user_id = $id;
        $obj->semester_id = Input::get('semester');
        $obj->weekday_id = Input::get('weekday');
        $obj->start_time = Carbon::createFromTime(intval($start[0]), intval($start[1]), 0);
        $obj->end_time = Carbon::createFromTime(intval($end[0]), intval($end[1]), 0);
        $obj->comment = Input::get('comment');

        $obj->save();

        return redirect('studentAvailabilities');
    }


    public function certifications()
    {
        $id=Auth::id();
        $user=new UserController();
        $certification=$user->get_user_certifications($id);

        return view("pages/student/certification/view")->with('data',User::find($id))
            ->with('certification',$certification);
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     */
    public function create_certifications()
    {
        $id=Auth::id();
        $user=new UserController();
        $certifications = $user->get_user_certifications($id);
        return view('pages/student/certification.create')->with('certifications', $certifications)
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('cert', CertificationType::orderBy('id')->pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @param UserAvailabilityRequest $request
     * @return mixed
     */
    public function store_certifications(UpdateUserCertificationRequest $request)
    {
        $id=Auth::id();

        try{
            $user_cert = new UserCertification($request->all());
            $user_cert->user_id = $id;
            $user_cert->certification_id = $request->get('cert');
            $user_cert->date_certified = Carbon::createFromFormat('m/d/Y', $request->get('certified'))->format('Y-m-d');
            $user_cert->expiration_date = Carbon::createFromFormat('m/d/Y', $request->get('expiration'))->format('Y-m-d');
            $user_cert->comment=$request->get('comment');
            $user_cert->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while creating a new availability', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('studentCertification');
    }

    public function schedule()
    {
        $id=Auth::id();
        $user=new UserController();
        $schedule=$user->get_user_schedule($id);
        return view("pages.student.studentSchedule")->with('data',User::find($id))
            ->with('schedule',$schedule);
    }
    /**
     * Display the student home page if the current user is a student or redirect to other pages if not
     *
     * @todo find a better way to redirect unauthorized requests.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $user = User::find($id);
        return view('pages.student.notification');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
