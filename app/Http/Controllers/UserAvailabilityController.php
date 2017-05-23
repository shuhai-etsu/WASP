<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\User;
use App\Weekday;
use App\Semester;
use App\UserAvailability;
use App\Util;
use App\Http\Requests\UserAvailabilityRequest;


class UserAvailabilityController extends DefaultController
{
    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //@todo get $id from session
        $id=1;

        $data=$this->get_availabilities($id);

        return view('pages/application/availabilities.index')
            ->with('user_id', $id)
            ->with('availabilities', $data)
            ->with('semesters', Semester::orderBy('id')->pluck('description','id'))
            ->with('weekdays', Weekday::orderBy('id')->pluck('description','id'));
    }

    /**
     * Method: availabilities()
     *
     * Purpose: Displays users' availabilities.
     *
     * @todo Complete the routine - logic missing
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying a form to allow the
     * user to enter availability information.
     */
    public function show($id)
    {

    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('pages/application/availabilities.edit')->with('availability', UserAvailability::find($id))
                                                    ->with('semesters', Semester::pluck('description', 'id'))
                                                    ->with('weekdays', Weekday::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     */
    public function create()
    {
        //@todo get user_id from either the session or the database
        $id=1;
        $availabilities = $this->get_availabilities($id);
        return view('pages/application/availabilities.create')->with('availabilities', $availabilities)
            ->with('user_id', $id)
            ->with('semesters', Semester::pluck('description', 'id'))
            ->with('weekdays', Weekday::pluck('description', 'id'));
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @param UserAvailabilityRequest $request
     * @return mixed
     */
    public function store(UserAvailabilityRequest $request)
    {
        $obj = new UserAvailability;
        $start = explode(':', Input::get('start_time'));
        $end =  explode(':', Input::get('end_time'));

        $obj = new UserAvailability;

        $obj->user_id = Input::get('user_id');
        $obj->semester_id = Input::get('semester_id');
        $obj->weekday_id = Input::get('weekday_id');
        $obj->start_time = Carbon::createFromTime(intval($start[0]), intval($start[1]), 0);
        $obj->end_time = Carbon::createFromTime(intval($end[0]), intval($end[1]), 0);
        $obj->comment = Input::get('comment');

        $obj->save();

        return Redirect::route('user_availabilities.index');
    }

    /**
     * @todo Add header comments
     * @todo Add try/catch, error handling
     *
     * @param UserAvailabilityRequest $request
     * @return mixed
     */
    public function update($id, UserAvailabilityRequest $request)
    {
        $obj = UserAvailability::find($id);

        if(!is_null($obj))
        {
            $start = explode(':', Input::get('start_time'));
            $end = explode(':', Input::get('end_time'));

            $obj->semester_id = Input::get('semester_id');
            $obj->weekday_id = Input::get('weekday_id');
            $obj->start_time = Carbon::createFromTime(intval($start[0]), intval($start[1]), 0);
            $obj->end_time = Carbon::createFromTime(intval($end[0]), intval($end[1]), 0);
            $obj->comment = Input::get('comment');

            $obj->save();

            return Redirect::route('user_availabilities.index');
        }
        else
        {
            //Redirect to the errors page
        }
    }

    /**
     * @todo Add header comments
     * @todo Log errors, route errors to error page
     */
    public function destroy($id)
    {
        $obj = UserAvailability::find($id);

        UserAvailability::where('id', '=', $id)->delete();
        return redirect('profile/'.$obj->user_id.'/availabilities');
    }

    /**
     * Method: availabilities()
     *
     * Purpose: Allows the user to enter availability information.
     *
     * @todo Add validation to ensure authorization to perform search.
     * @todo Fix type mismatch for return value - and this reference to oldviews looks out of date
     * @todo Add try/catch, error handling if needed
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying a form to allow the
     * user to enter availability information.
     */
    public function availabilities($id)
    {
        $data = $this->get_availabilities($id);
        return view('oldviews/test/user_availabilities.index')
                ->with('user', User::find($id))
                ->with('availabilities', Util::encodeJSON($data))
                ->with('semesters', Semester::orderBy('id')->pluck('description','id'))
                ->with('weekdays', Weekday::orderBy('id')->pluck('description','id'));
    }

    /**
     * @todo Add header comments
     */
    private function get_availabilities($id)
    {
        $query = DB::table('user_availabilities as ua')
            ->join('semesters as s', 'ua.semester_id', '=', 's.id')
            ->join('weekdays as w', 'ua.weekday_id', '=', 'w.id')
            ->where('ua.user_id','=',$id)
            ->orderBy('s.id')
            ->orderBy('w.id')
            ->orderBy('ua.start_time')
            ->orderBy('ua.end_time')
            ->select('ua.id as id',
                'ua.user_id as user_id',
                's.id as semester_id',
                'w.id as weekday_id',
                's.description as semester',
                'w.description as weekday',
                'ua.start_time as start_time',
                'ua.end_time as end_time',
                'ua.comment as comment');
        $data = $query->get();

        //==============================================================================================================
        //Format the start/end times to display as 12 hour clock time, not 24 hour (military) time.
        //==============================================================================================================
        foreach($data as $item)
        {
            $item->start_time = date("g:i a", strtotime($item->start_time));
            $item->end_time = date("g:i a", strtotime($item->end_time));
        }
        return $data;
    }
}
