<?php

namespace App\Http\Controllers;

use App\CertificationType;
use App\DegreeType;
use App\Http\Requests\UpdateEmergContacts;
use App\Suffix;
use App\UserAddress;
use App\UserAvailability;
use App\UserCertification;
use App\UserDocument;
use App\UserEducationHistory;
use App\UserEmergencyContact;
use App\UserFinancialAid;
use App\UserWorkExperience;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserEducationRequest;
use App\Http\Requests\UpdateUserWorkRequest;
use App\Util;
use App\User;
use App\State;
use App\Weekday;
use App\Semester;
use App\Relationship;
use App\UserTelephone;
use App\UserReference;
use Illuminate\Http\Request;
use App\TelephoneType;
use App\FinancialAidType;
use App\Http\Requests\UpdateUserCertificationRequest;
use App\Http\Requests\UserAvailabilityRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Http\Controllers\UserController;

/**
 * Class: UserProfileController
 *
 * Purpose:
 *
 * @package App\Http\Controllers
 */
class UserProfileController extends DefaultController
{


    /**
     * Method: personal_info()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function personal_info($id)
    {
        if($id)
        {
            $user = new UserController();
            $telephones = $user->get_user_telephones($id);
            $addresses = $user->get_user_addresses($id);
            $fin_aid = $user->get_user_fin_aid($id);


            return view('pages/admin/user/profile/info')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('telephones', $telephones)
                ->with('addresses', $addresses)
                ->with('fin_aid', $fin_aid);
        }
        else
        {
            //route to errors page.
        }
    }


    /**
     * Method: edit_personal_info()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_personal_info($id)
    {
        try
        {
            if ($id)
            {
                $user = new UserController();
                $telephones = $user->get_user_telephones($id);
                $addresses = $user->get_user_addresses($id);
                $fin_aid = $user->get_user_fin_aid($id);


                return view('pages/admin/user/profile/edit/info')->with('data', User::find($id))
                    ->with('telephones', $telephones)
                    ->with('addresses', $addresses)
                    ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
                    ->with('states', State::orderby('id')->pluck('description'))
                    ->with('telephone_types', TelephoneType::orderby('id')->pluck('description'))
                    ->with('fin_aid_types',FinancialAidType::orderby('id')->pluck('description'))
                    ->with('fin_aid', $fin_aid);
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
     * Method: update_personal_info()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function update_personal_info($id, UpdatePersonalInfoRequest $request)
    {
        try{
            $user = User::findOrFail($id);
            $user->email = $request->get('email');
            $user->save();

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
            foreach ($user_aid as $aid){
                $aid->type_id = $request->get('worker_type')[$i]+1;
                $aid->save();
                $i++;
            }


        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/info');
    }



    /**
     * Method: emergency_contact()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function emergency_contact($id)
    {
        if($id)
        {
            $user = new UserController();
            $emergency = $user->get_user_emergency_contact($id);


            return view('pages/admin/user/profile/emergency')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('contacts', $emergency);
        }
        else
        {
            //route to errors page.
        }
    }

    /**
     * Method: edit_emergency_contact()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_emergency_contact($id, $contact_id)
    {
        try
        {
            if ($id)
            {
                $user = new UserController();
                $emergency = $user->get_user_emergency_contact($id)->where('id', $contact_id)->first();

                return view('pages/admin/user/profile/edit/emergency')->with('data', User::find($id))
                    ->with('sidebar_data', parent::get_sidebar_data())
                    ->with('relationship', Relationship::orderby('id')->pluck('description'))
//                    ->with('suffix', Suffix::orderby('id')->pluck('description'))
                    ->with('contact', $emergency);
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
     * Method: update_emergency_contact()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function update_emergency_contact($id, $contact_id, UpdateEmergContacts $request)
    {
        try{
            $user_emerg = UserEmergencyContact::findOrFail($contact_id);
            $user_emerg->first_name = $request->get('first_name');
            $user_emerg->middle_name = $request->get('middle_name');
            $user_emerg->last_name = $request->get('last_name');
//            $user_emerg->suffix_id = $request->get('suffix')+1;
            $user_emerg->relationship_id = $request->get('relationship')+1;
            $user_emerg->telephone_number = $request->get('telephone');
            $user_emerg->email = $request->get('email');
            $user_emerg->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/emergency_contacts');
    }



    /**
     * Method: certification()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function certification($id)
    {
        if($id)
        {
            $user = new UserController();
            $certs = $user->get_user_certifications($id);


            return view('pages/admin/user/profile/certifications')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('certifications', $certs);
        }
        else
        {
            //route to errors page.
        }
    }

    /**
     * Method: edit_certifications()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_certifications($id, $cert_id)
    {
        try
        {
            if ($id)
            {
                $user = new UserController();
                $cert = $user->get_user_certifications($id)->where('id', $cert_id)->first();

                return view('pages/admin/user/profile/edit/certifications')->with('data', User::find($id))
                    ->with('certification', $cert)
                    ->with('cert_list', CertificationType::orderby('id')->pluck('description'))
                    ->with('sidebar_data', (new DefaultController())->get_sidebar_data());
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
     * Method: update_certifications()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param $cert_id ID (e.g. primary key) of the certification the user wishes to view.
     * @param UpdateUserCertificationRequest $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function update_certifications($id, $cert_id, UpdateUserCertificationRequest $request)
    {
        try{
            $user_cert = UserCertification::findOrFail($cert_id);

            $user_cert->date_certified = $request->get('certified');
            $user_cert->certification_id = $request->get('cert')+1;
            if(!empty($request->get('expiration')))
            {
                $user_cert->expiration_date = $request->get('expiration');
            }
            $user_cert->save();



        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/certifications');
    }



    /**
     * Method: availabilities()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function availabilities($id)
    {
        if($id)
        {
            $user = new UserController();
            $avail = $user->get_user_availabilities($id);

            foreach($avail as $item)
            {
                $item->start_time = date("g:i a", strtotime($item->start_time));
                $item->end_time = date("g:i a", strtotime($item->end_time));
            }

            return view('pages/admin/user/profile/availabilities')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('availabilities', $avail);
        }
        else
        {
            //route to errors page.
        }
    }

    /**
     * Method: edit_availabilities()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param $avail_id the ID of the availability to be edited
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_availabilities($id, $avail_id)
    {
        try
        {
            if ($id)
            {
                return view('pages/admin/user/profile/edit/availabilities')->with('data', User::find($id))
                    ->with('weekdays', Weekday::orderby('id')->pluck('description'))
                    ->with('semester', Semester::orderby('id')->pluck('description'))
                    ->with('availability', UserAvailability::findOrFail($avail_id))
                    ->with('sidebar_data', (new DefaultController())->get_sidebar_data());
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
     * Method: update_availabilities()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function update_availabilities($id, $avail_id, UserAvailabilityRequest $request)
    {
        try{
            $user_avail = UserAvailability::findOrFail($avail_id);
            $user_avail->start_time = $request->get('start_time');
            $user_avail->end_time = $request->get('end_time');
            $user_avail->weekday_id = $request->get('weekday')+1;
            $user_avail->semester_id = $request->get('semester')+1;
            $user_avail->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/availabilities');
    }



    /**
     * Method: new_availabilities()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view allow the user to
     * create a new availability
     */
    public function new_availabilities($id)
    {
        return view('pages/admin/user/profile/new/availabilities')->with('data', User::find($id))
            ->with('weekdays', Weekday::orderby('id')->pluck('description'))
            ->with('semester', Semester::orderby('id')->pluck('description'))
            ->with('sidebar_data', (new DefaultController())->get_sidebar_data());

    }

    /**
     * Method: store_availabilities()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function store_availabilities($id, UserAvailabilityRequest $request)
    {
        try{
            $user_avail = new UserAvailability;
            $user_avail->user_id = $id;
            $user_avail->start_time = $request->get('start_time');
            $user_avail->end_time = $request->get('end_time');
            $user_avail->weekday_id = $request->get('weekday')+1;
            $user_avail->semester_id = $request->get('semester')+1;
            $user_avail->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while creating a new availability', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/availabilities');
    }

    /**
     * Method: education()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function education($id)
    {
        if($id)
        {
            $user = new UserController();
            $education = $user->get_user_education($id);

            return view('pages/admin/user/profile/education')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('education', $education);
        }
        else
        {
            //route to errors page.
        }
    }


    /**
     * Method: edit_education()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_education($id, $edu_id)
    {
        try
        {
            if ($id)
            {
                $user = new UserController();
                $education = $user->get_user_education($id)->first();

                return view('pages/admin/user/profile/edit/education')->with('data', User::find($id))
                    ->with('sidebar_data', parent::get_sidebar_data())
                    ->with('degrees', DegreeType::orderby('id')->pluck('description'))
                    ->with('education', $education);
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
     * Method: update_education()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function update_education($id, $edu_id, UpdateUserEducationRequest $request)
    {
        try{
            $user_edu = UserEducationHistory::findOrFail($edu_id);

            $user_edu->institution = $request->get('institution');
            $user_edu->graduation_date = $request->get('graduation');
            $user_edu->type_id = $request->get('degree')+1;
            $user_edu->save();

        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/education');
    }

    /**
     * Method: work_experience()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function work_experience($id)
    {
        if($id)
        {
            $user = new UserController();
            $work_experiences = $user->get_user_work_experience($id);

            return view('pages/admin/user/profile/work')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('work', $work_experiences);
        }
        else
        {
            //route to errors page.
        }
    }

    /**
     * Method: edit_work_experience()
     *
     * Purpose: Creates a view allowing a user to edit a specified user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information in an editable format.
     */
    public function edit_work_experience($id, $work_id)
    {
        try
        {
            if ($id)
            {
                $user = new UserController();
                $work_experience = $user->get_user_work_experience($id)->first();

                return view('pages/admin/user/profile/edit/work')->with('data', User::find($id))
                    ->with('sidebar_data', parent::get_sidebar_data())
                    ->with('work', $work_experience);
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
     * Method: update_work_experience()
     *
     * Purpose: Action of updating specified user's profile information.
     *
     * Note: +1's are for dropdown/selects where the form id begins at 0 our database begins at id 1
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @param Request $request the form's patch request to update a user's information
     *
     * @return \Illuminate\Support\Facades\Redirect Redirect to user profile view
     */
    public function update_work_experience($id, $work_id, UpdateUserWorkRequest $request)
    {
        try{
            $user_work = UserWorkExperience::findOrFail($work_id);

            $user_work->company_name = $request->get('company');
            $user_work->date_left = $request->get('left');
            $user_work->reason_for_leaving = $request->get('reason');
            $user_work->save();


        }
        catch(Exception $exception){
            //Log error and route to errors page
            Log::info('Error encountered while updating the user', ['exception'=>$exception]);
            return view('errors.500');
        }
        return redirect('profile/'.$id.'/work_experience');
    }


    /**
     * Method: documents()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function documents($id)
    {
        if($id)
        {
            $user = new UserController();
            $documents = $user->get_user_documents($id);

            return view('pages/admin/user/profile/documents')->with('data', User::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('documents', $documents);
        }
        else
        {
            //route to errors page.
        }
    }


    /**
     * Method: documentsFile()
     *
     * Purpose: Creates a view displaying a given user's profile information.
     *
     * @todo Log errors, route errors to error page
     *
     * @param $id ID (e.g. primary key) of the user the user wishes to view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View Return a view containing a user's
     * information.
     */
    public function documentsFile($id, $doc_id)
    {
        if($id)
        {
            $docName = UserDocument::find($doc_id)->first()->filename;
            $docPath = storage_path(). '/app/image/' . $docName;

            return view('pages/admin/user/profile/documentsView')->with('data', User::find($id))
                ->with('file', url($docPath))
                ->with('sidebar_data', parent::get_sidebar_data());
        }
        else
        {
            //route to errors page.
        }
    }


}