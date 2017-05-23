<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Classroom;
use App\User;
use App\UserStatusType;

class ClassroomAssignmentsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('test/classroomassignments/index')
               ->with('title', 'Classroom Assignments')
               ->with('classrooms', 
                      Classroom::where('id','>',1)
                               ->orderby('description','ASC')->get())
               ->with('users', 
                      User::where("id",'>',1)
                          ->where("user_status_id",'=',UserStatusType::where('description','=','Active'))->get());
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //return view('test/classroomassignments/show')->with('data', Classroom::find($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        //return view('test/classrooms.edit')->with('data', Classroom::find($id))
        //    ->with('buildings', Building::pluck('description', 'id'));
    }

    /**
     *
     */
    public function create()
    {
        //return view('test/classrooms.create')->with('buildings', Building::pluck('description', 'id'));
    }

    /**
     *
     */
    public function store(CreateClassroomRequest $request)
    {
        //Classroom::create($request->all());
        //return redirect('classrooms');
    }

    /**
     *
     */
    public function update($id,UpdateClassroomRequest $request)
    {
        //Classroom::find($id)->update($request->all());
        //return redirect('classrooms');
    }

    /**
     *
     */
    public function destroy($id)
    {
        //Building::where('id', '=', $id)->delete();
        //return redirect('classrooms');
    }
}
