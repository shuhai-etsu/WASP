<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Semester;
use App\Http\Requests\CreateSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use Carbon\Carbon;

class SemesterController extends DefaultController
{

    public function index()
    {
        try
        {
            return view('pages/admin/system/semesters.index')
                    ->with('data',Semester::where('id', '>', 1)
                                ->orderBy('description', 'ASC')
                                ->get())
                    ->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function show($id)
    {
        try
        {
            return view('pages/admin/system/semesters.show')
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('data', Semester::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function edit($id)
    {
        try
        {
            return view('pages/admin/system/semesters.edit')
                ->with('sidebar_data', parent::get_sidebar_data())
                ->with('data', Semester::find($id));
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function create()
    {
        try
        {
            return view('pages/admin/system/semesters.create')
                    ->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function store(CreateSemesterRequest $request)
    {
        try
        {
            $semester=new Semester();
            $semester->abbreviation = $request->abbreviation;
            $semester->description = $request->description;
            $semester->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
            $semester->end_date =  Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
            $semester->comment=$request->comment;
            $semester->save();
            return redirect('semesters');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function update($id,UpdateSemesterRequest $request)
    {
        try
        {
            $semester = Semester::find($id);
            $semester->abbreviation = $request->abbreviation;
            $semester->description = $request->description;
            $semester->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
            $semester->end_date =  Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
            $semester->comment=$request->comment;
            $semester->update();
            return redirect('semesters');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }


    public function destroy($id)
    {
        try
        {
            Semester::where('id', '=', $id)->delete();
            return redirect('semesters');
        }
        catch(Exception $exception)
        {
            //Log error and route to errors page
        }
    }

 
    public function assignments()
    {

    }
}