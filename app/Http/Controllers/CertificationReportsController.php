<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;

use App\UserCertification;
use App\User;
use App\CertificationType;


class CertificationReportsController extends DefaultController
{
    /**
     * @return $this
     */
    public function userCertifications()
    {
        return view('pages/admin/reports/certifications/certifications')
                ->with('users', User::where('id','>',1)->orderBy('last_name','ASC')->pluck('last_name','id'))
                ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @return $this
     */
    public function expiredCertifications()
    {
        return view('pages/admin/reports/certifications/expired')
               ->with('data',
                      CertificationType::where('id','>',1)
                                        ->orderBy('description','ASC')
                                        ->pluck('description', 'id'))
            ->with('sidebar_data', parent::get_sidebar_data());

    }

    /**
     * @return $this
     */
    public function comingDueCertifications()
    {
        return view('pages/admin/reports/certifications/comingDue')
               ->with('data',
                      CertificationType::where('id','>',1)
                                        ->orderBy('description','ASC')
                                        ->pluck('description', 'id'))
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @return $this
     */
    public function expiredReport()
    {
        $selections =  Input::get('certification_types', null);
        $date = Carbon::now();
        $placeHolder = Carbon::create(1900,1,1);

        $query = DB::table('users as u')
                    ->join('user_certifications as uc', 'u.id', '=', 'uc.user_id')
                    ->join('certification_types as ct', 'uc.certification_id', '=', 'ct.id')
                    ->where('uc.expiration_date', '>', $placeHolder)
                    ->where('uc.expiration_date', '<', $date)
                    ->orderBy('u.last_name')
                    ->orderBy('u.first_name')
                    ->select('u.id as user_id',
                             'u.first_name as first_name',
                             'u.last_name as last_name',
                             'ct.abbreviation as abbreviation',
                             'ct.description as description',
                             'uc.expiration_date as expiration_date');

        if(!is_null($selections))
        {
            $query->whereIn('uc.certification_id',$selections);
        }

        return view('pages/admin/reports/certifications/expiredReport')->with('data',$query->get())->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @return $this
     */
    public function userCertificationsReport()
    {
        $users = Input::get('users',null);

        Log::info($users);

        //==============================================================================================================
        //Query the database for users who have certifications
        //==============================================================================================================

        $query = DB::table('users as u')
                    ->join('user_certifications as uc', 'u.id', '=', 'uc.user_id')
                    ->join('certification_types as ct', 'uc.certification_id', '=', 'ct.id')
                    ->orderBy('u.last_name')
                    ->orderBy('u.first_name')
                    ->select('u.id as user_id',
                             'u.first_name as first_name',
                             'u.last_name as last_name',
                             'ct.description as certification',
                             'uc.date_certified as date_certified',
                             'uc.expiration_date as expiration_date');

        if(!is_null($users))
        {
            $query->whereIn('u.id',$users);
        }

        Log::info($query->toSql());

        return view('pages/admin/reports/certifications/certificationsReport')
            ->with('users', $query->get())
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    public function comingDueReport()
    {
        $selections =  Input::get('certification_types', null);
        $days = Input::get('days');
        $minDate = Carbon::now();
        $maxDate = Carbon::now();
        $maxDate->addDays($days);

        $query = DB::table('users as u')
                    ->join('user_certifications as uc', 'u.id', '=', 'uc.user_id')
                    ->join('certification_types as ct', 'uc.certification_id', '=', 'ct.id')
                    ->where('uc.expiration_date', '>=', $minDate)
                    ->where('uc.expiration_date', '<=', $maxDate)
                    ->orderBy('u.last_name')
                    ->orderBy('u.first_name')
                    ->select('u.id as user_id',
                             'u.first_name as first_name',
                             'u.last_name as last_name',
                             'ct.abbreviation as abbreviation',
                             'ct.description as description',
                            'uc.expiration_date');

        if(!is_null($selections))
        {
            $query->whereIn('uc.certification_id',$selections);
        }

        return view('pages/admin/reports/certifications/comingDueReport')->with('data',$query->get())->with('sidebar_data', parent::get_sidebar_data());
    }
}
