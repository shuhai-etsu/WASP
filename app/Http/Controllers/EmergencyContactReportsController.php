<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class EmergencyContactReportsController
 *
 * @package App\Http\Controllers
 */
class EmergencyContactReportsController extends DefaultController
{
    /**
     * Method: missing()
     *
     * Purpose: Method determines which users are missing emergency contact information and returns the list of users
     *          to the missingReport view for display purposes.
     *
     * @todo Route errors to error page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View - View that displays user who are missing
     * emergency contact information.
     */
    public function missing()
    {
        try
        {
            $query = DB::table('users as u')
                        ->leftJoin('roles as r', 'u.role_id', '=', 'r.id')
                        ->whereNotIn('u.id', function ($query)
                        {
                            $query->select('uec.user_id')->from('user_emergency_contacts as uec');
                        })
                        ->orderBy('u.last_name', 'ASC')
                        ->orderBy('u.first_name', 'ASC')
                        ->orderBy('u.middle_name', 'ASC')
                        ->select('u.first_name as first_name',
                                 'u.middle_name as middle_name',
                                 'u.last_name as last_name',
                                 'r.description as role');

            //==========================================================================================================
            //Check the APP_DEBUG environment variable to determine if DEBUG is enabled (e.g. true). If so then log
            //pertinent debug information to the Laravel log file located at path storage->logs->laravel.log.
            //==========================================================================================================
            if (env('APP_DEBUG'))
            {
                Log::info('==========================================================================================');
                Log::info('Inside EmergencyContactReportsController->missing()');
                Log::info('Query string: ' . $query->toSql());
                Log::info('Exiting EmergencyContactReportsController->missing()');
                Log::info('==========================================================================================');
            }

            $users = $query->get();

            //==========================================================================================================
            //Get the requested data from the database and pass it off to the view for presentation purposes.
            //==========================================================================================================
            return view('pages/admin/reports/emergency_contacts/missingReport')
                ->with('users',$users)->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {
            Log::info("ERROR: EmergencyContactReportsController:missing(): " . $exception->getMessage());
            
            //route to errors page view.
        }
    }
}
