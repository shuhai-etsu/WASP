<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use App\User;
use App\UserPhilosophy;
use App\PhilosophyType;
use App\Http\Requests\CreateUserPhilosophyRequest;
use App\Http\Requests\UpdateUserPhilosophyRequest;

/**
 * Class UserReferenceController
 * @package App\Http\Controllers
 */
class UserPhilosophyController extends Controller
{
    /**
     * @todo Add header comments
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
            return view('user_philosophies.show')->with('data', UserPhilosophy::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            return view('test/user_philosophies.edit')->with('philosophy_types',
                                                             PhilosophyType::orderBy('description', 'ASC')
                                                                            ->pluck('description','id'))
                                                      ->with('data', UserPhilosophy::find($id));
        }
        catch(Exception $exception)
        {

        }
    }

    /**
     * @todo Add header comments
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('test/user_philosophies.create');
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     *
     * @param CreateUserReferenceRequest $request
     * @return mixed
     */
    public function store(CreateUserPhilosophyRequest $request)
    {
        try
        {
            UserPhilosophy::create($request->all());
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
    public function update($id, UpdateUserPhilosophyRequest $request)
    {
        try
        {
            UserPhilosophy::find($id)->update($request->all());
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
     * @return mixed
     */
    public function destroy($id)
    {
        try
        {
            $obj = UserPhilosophy::find($id);
            UserPhilosophy::where('id', '=', $id)->delete();

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
    public function philosophies($id)
    {
        try
        {
            return view('test/user_philosophies.index')->with('philosophy_types',
                                                              PhilosophyType::orderBy('description', 'ASC')
                                                                             ->pluck('description','id'))
                                                       ->with('user', User::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }
}
