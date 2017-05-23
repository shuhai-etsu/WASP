<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Building;
use App\Http\Requests\CreateClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;

/**
 * Class ClassroomController
 * @package App\Http\Controllers
 */
class ClassroomController extends DefaultController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages/admin/configurations/classrooms/index')
                  ->with('title','All Classrooms')
                  ->with('sidebar_data', parent::get_sidebar_data())
                  ->with('data',
                          Classroom::where('id','>',1)
                                  ->orderby('description','ASC')->get());
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('pages/admin/configurations/classrooms/show')
            ->with('data', Classroom::find($id))
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('pages/admin/configurations/classrooms/edit')
                ->with('data', Classroom::find($id))
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('buildings', Building::pluck('description', 'id'));
    }

    /**
     *
     */
    public function create()
    {
        return view('pages/admin/configurations/classrooms/create')
            ->with('sidebar_data', parent::get_sidebar_data())
            ->with('buildings', Building::pluck('description', 'id'));
    }

    /**
     * @param CreateClassroomRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateClassroomRequest $request)
    {
        Classroom::create($request->all());
        return redirect('classrooms');
    }

    /**
     * @param $id
     * @param UpdateClassroomRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateClassroomRequest $request)
    {
        Classroom::find($id)->update($request->all());
        return redirect('classrooms');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Classroom::where('id', '=', $id)->delete();
        return redirect('classrooms');
    }

    /**
     *
     */
    public function assignments()
    {

    }

    /**
     *
     */
    public function attendance()
    {

    }
}
