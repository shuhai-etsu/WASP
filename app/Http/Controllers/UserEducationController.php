<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use App\User;
use App\DegreeType;
use App\UserEducationHistory;

use App\Http\Requests\CreateUserEducationRequest;
use App\Http\Requests\UpdateUserEducationRequest;

/**
 * Class UserReferenceController
 * @package App\Http\Controllers
 */
class UserEducationController extends Controller
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
     * @todo Add support for initial blank entry
     * @todo Log errors, route errors to error page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try
        {
            return view('user_education.show')->with('data', UserEducationHistory::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Add support for initial blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try
        {
            return view('test/user_education.edit')->with('degree_types',
                                                         DegreeType::orderBy('description', 'ASC')
                                                                    ->pluck('description','id'))
                                                   ->with('data', UserEducationHistory::find($id));
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
    public function store(CreateUserEducationRequest $request)
    {
        try
        {
            UserEducationHistory::create($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Add support for initial blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @param UpdateUserReferenceRequest $request
     * @return mixed
     */
    public function update($id, UpdateUserEducationRequest $request)
    {
        try
        {
            UserEducationHistory::find($id)->update($request->all());
            return Redirect::route('users.edit', ['id' => $request->get('user_id')]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Add support for initial blank entry
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        try
        {
            $obj = UserEducationHistory::find($id);
            UserEducationHistory::where('id', '=', $id)->delete();

            return Redirect::route('users.edit', ['id' => $obj->user_id]);
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Add support for initial blank entry
     * @todo fix incorrect return type
     * @todo Log errors, route errors to error page
     *
     * @param $id
     * @return $this
     */
    public function education($id)
    {
        try
        {
            return view('test/user_education.index')->with('degree_types',
                                                            DegreeType::orderBy('description', 'ASC')
                                                                       ->pluck('description','id'))
                                                    ->with('user', User::find($id));
        }
        catch(Exceptione $exception)
        {
            //Log error and route to errors page
        }
    }
}
