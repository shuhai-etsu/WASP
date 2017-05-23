<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;

use App\User;
use App\Gender;
use App\Suffix;
use App\Relationship;
use App\UserEmergencyContact;
use App\Http\Requests\CreateEmergencyContactRequest;
use App\Http\Requests\UpdateEmergencyContactRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserEmergencyContactController extends DefaultController
{
    /**
     * @todo Add header comments - note lack of indexing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.application.checklist.emergency_contacts.index')
            ->with('contacts', UserEmergencyContact::where('user_id','=',Auth::id())->get());
    }

    /**
     * @todo Add header comments
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('pages.application.checklist.emergency_contacts.edit')
            ->with('data', UserEmergencyContact::find($id))
            ->with('relationships', Relationship::pluck('description','id'));
    }

    /**
     *
     */
    public function create()
    {
        return view('pages.application.checklist.emergency_contacts.create')
                ->with('relationships', Relationship::orderBy('id')
                ->pluck('description','id'));
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param CreateEmergencyContactRequest $request
     * @return mixed
     */
    public function store(CreateEmergencyContactRequest $request)
    {
        try
        {
            UserEmergencyContact::create($request->all());
            return redirect('emergency');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @param UpdateEmergencyContactRequest $request
     * @return mixed
     */
    public function update($id, UpdateEmergencyContactRequest $request)
    {
        try
        {
            UserEmergencyContact::find($id)->update($request->all());
            return redirect('emergency');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch
     * @todo Prevent user from removing last emergency contact
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        UserEmergencyContact::where('id', '=', $id)->delete();
        return redirect('emergency');
    }


    /**
     * Method: emergency_contacts()
     *
     * Purpose: Allows the user to enter emergency contact information.
     *
     * @todo Add validation to ensure authorization to perform search.
     * @todo fix incorrect return type
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying a form to allow the
     * user to enter emergency contact information.
     */
    public function emergency_contacts($id)
    {
        return view('test/user_emergency_contacts.index')
                    ->with('data', User::find($id))
                    ->with('relationships', Relationship::orderBy('id')->pluck('description'));
    }


}
