<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use App\User;
use App\UserReference;
use App\TelephoneType;
use App\Http\Requests\CreateUserReferenceRequest;
use App\Http\Requests\UpdateUserReferenceRequest;

/**
 * Class UserReferenceController
 * @package App\Http\Controllers
 */
class UserReferenceController extends Controller
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
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try
        {
            return view('user_references.show')->with('data', UserReference::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            return view('test/user_references.edit')->with('telephone_types',
                                                           TelephoneType::orderBy('description', 'ASC')
                                                           ->pluck('description','id'))
                                                    ->with('data', UserReference::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('test/user_references.create');
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param CreateUserReferenceRequest $request
     * @return mixed
     */
    public function store(CreateUserReferenceRequest $request)
    {
        try
        {
            UserReference::create($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
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
     * @param UpdateUserReferenceRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserReferenceRequest $request)
    {
        try
        {
            UserReference::find($id)->update($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
        }
        catch(Exception $exception)
        {
            var_dump($exception);
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try
        {
            $obj = UserReference::find($id);
            UserReference::where('id', '=', $id)->delete();

            return Redirect::route('users.edit', ['id' => $obj->user_id]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    /**
     * @todo Add header comments
     * @todo fix incorrect return type
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return $this
     */
    public function references($id)
    {
        try
        {
            return view('test/user_references.index')->with('telephone_types',
                                                            TelephoneType::orderBy('description', 'ASC')
                                                            ->pluck('description','id'))
                                                     ->with('user', User::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }
}
