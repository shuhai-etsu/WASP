<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use App\User;
use App\TelephoneType;
use App\UserTelephone;
use App\Http\Requests\CreateUserTelephoneRequest;
use App\Http\Requests\UpdateUserTelephoneRequest;


/**
 * Class UserTelephoneController
 * @package App\Http\Controllers
 */
class UserTelephoneController extends DefaultController
{
    /**
     * @todo Add header comments - note lack of indexing
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * @todo Add header comments - note lack of indexing
     * @todo Restore support for initial, blank entry
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('user_telephones.show')->with('data', UserTelephone::find($id))
                                           ->with('telephone_types', TelephoneType::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     * @todo Restore support for initial, blank entry
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('test/user_telephones.edit')->with('data', UserTelephone::find($id))
                                                ->with('telephone_types', TelephoneType::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     *
     */
    public function create()
    {
        return view('test/user_telephones.create');
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     */
    public function store(CreateUserTelephoneRequest $request)
    {
        try
        {
            UserTelephone::create($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Manage exception for attempts to update initial, blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @param UpdateUserTelephoneRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserTelephoneRequest $request)
    {
        try
        {
            if ($id > 1)
            {
                UserTelephone::find($id)->update($request->all());
                return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
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
     * @todo Add header comments
     * @todo Restore support for initial, blank entry
     * @todo Log errors, route errors to error page
     *
     */
    public function destroy($id)
    {
        try
        {
            $obj = UserTelephone::find($id);
            UserTelephone::where('id', '=', $id)->delete();

            return Redirect::route('users.edit', ['id' => $obj->user_id]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    /**
     * Method: telephones()
     *
     * Purpose: Displays a view allowing a user to enter user telephone information for a user.
     *
     * @todo Add validation to ensure authorization to perform search.
     * @todo Fix incorrect return type
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying a form that allows a
     * user to enter email addresses for a user.
     */
    public function telephones($id)
    {
        return view('test/user_telephones.index')->with('data', User::find($id))
                                                 ->with('telephone_types', TelephoneType::pluck('description', 'id'));
    }
}
