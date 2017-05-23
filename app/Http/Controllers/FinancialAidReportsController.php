<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\FinancialAidType;

class FinancialAidReportsController extends DefaultController
{
    /**
     * @todo add header comments
     *
     * @return $this
     */
    public function financialAidRecipients()
    {
        return view('pages/admin/reports/financial_aid/recipients')
            ->with('data', FinancialAidType::where('id','>',1)
            ->orderBy('description','ASC')->pluck('description','id'))
            ->with('sidebar_data', parent::get_sidebar_data());
    }

    /**
     * @todo add header comments
     *
     * @return $this
     */
    public function recipientsReport()
    {
        $selections =  Input::get('financial_aid_types', null);

        $query = DB::table('users as u')
                    ->join('user_financial_aid as ufa', 'ufa.id', '=', 'u.id')
                    ->join('financial_aid_types as fat', 'fat.id', '=', 'ufa.type_id')
                    ->orderBy('u.last_name')
                    ->orderBy('u.first_name')
                    ->select('u.id as user_id',
                             'u.first_name as first_name',
                             'u.last_name as last_name',
                             'fat.abbreviation as abbreviation',
                             'fat.description as description');

        if(!is_null($selections))
        {
            $query->whereIn('ufa.type_id',$selections);
        }

        return view('pages/admin/reports/financial_aid/recipientsReport')
            ->with('data',$query->get())
            ->with('sidebar_data', parent::get_sidebar_data());
    }
}
