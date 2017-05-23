<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function get_sidebar_data()
    {
            $data['TotalAppCount'] = User::where([
                ['role_id', '=', config('constants.role.APPLICATION')],
                ['user_status_id', '!=', config('constants.user_status.REJECTED')]
            ])->count();
            $data['NewAppCount'] = User::where([
                ['role_id', '=', config('constants.role.APPLICATION')],
                ['user_status_id', '=', config('constants.user_status.NEW')]
            ])->count();
            $data['PendingAppCount'] = User::where([
                ['role_id', '=', config('constants.role.APPLICATION')],
                ['user_status_id', '=', config('constants.user_status.PENDING')]
            ])->count();
            $data['InterviewAppCount'] = User::where([
                ['role_id', '=', config('constants.role.APPLICATION')],
                ['user_status_id', '=', config('constants.user_status.INTERVIEW')]
            ])->count();
            $data['DeferAppCount'] = User::where([
                ['role_id', '=', config('constants.role.APPLICATION')],
                ['user_status_id', '=', config('constants.user_status.SHELVED')]
            ])->count();
            return $data;
    }
}