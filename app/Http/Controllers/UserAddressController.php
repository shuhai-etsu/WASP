<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\State;
use App\User;
use App\UserAddress;
use App\Http\Requests\CreateUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;

class UserAddressController extends DefaultController
{
    /**
     * @todo Add header comments - note why indexing isn't supported
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * @todo Add header comments
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('test/user_addresses.show')->with('data', UserAddress::find($id))
                                               ->with('states', State::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('test/user_addresses.edit')->with('data', UserAddress::find($id))
                                               ->with('states', State::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     *
     */
    public function create()
    {
        return view('user_addresses.create');
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param CreateUserAddressRequest $request
     * @return mixed
     */
    public function store(CreateUserAddressRequest $request)
    {
        try
        {
            UserAddress::create($request->all());
            return Redirect::route('users.edit', ['id' => Input::get('user_id')]);
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
     * @param UpdateUserAddressRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserAddressRequest $request)
    {
        try
        {
            UserAddress::find($id)->update($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $obj = UserAddress::find($id);

        UserAddress::where('id', '=', $id)->delete();

        return Redirect::route('users.edit', ['id' => $obj->user_id]);
    }

    /**
     * Method: addresses()
     *
     * Purpose: Searches for a user(s) information in the database.
     *
     * @todo Add header comments
     * @todo Add validation to ensure authorization to perform search.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying the search results.
     */
    public function addresses($id)
    {
        return view('test/user_addresses.index')->with('data', User::find($id))
                                                ->with('states', State::pluck('description', 'id'));
    }
}
