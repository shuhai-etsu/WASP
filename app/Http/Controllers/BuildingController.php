<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Http\Response;
//use App\Http\Requests;
use App\Http\Requests\CreateBuildingRequest;
use App\Http\Requests\UpdateBuildingRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use App\State;
use App\Building;
use App\Classroom;

class BuildingController extends DefaultController
{
    /**
     * @todo remove from code base, since buildings won't be tracked?  or, at least, move to a folder for deprecated code.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('test/buildings.index')->with('data', Building::where('id','>','1')
                                           ->orderby('description','ASC')
                                           ->get());
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view('test/buildings.show')->with('data', Building::find($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('test/buildings.edit')->with('data', Building::find($id))
                                          ->with('states', State::pluck('description', 'id'));
    }

    /**
     *
     */
    public function create()
    {
        return view('test/buildings.create')->with('states', State::pluck('description', 'id'));
    }

    /**
     *
     */
    public function store(CreateBuildingRequest $request)
    {
        Building::create($request->all());
        return redirect('buildings');
    }

    /**
     *
     */
    public function update($id, UpdateBuildingRequest $request)
    {
        Building::find($id)->update($request->all());
        return redirect('buildings');
    }

    public function classrooms($id)
    {
        return view('classrooms/index')->with('title', Building::find($id)->description . ' Classrooms')
                                       ->with('data', Classroom::where('building_id', '=', $id)
                                       ->orderby('description','ASC')
                                       ->get());
    }

    /**
     *
     */
    public function destroy($id)
    {
        Building::where('id', '=', $id)->delete();
        return redirect('buildings');
    }
}
