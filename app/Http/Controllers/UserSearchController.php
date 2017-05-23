<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Gender;
use App\Util;

class UserSearchController extends Controller
{
    /**
     * Method: search()
     *
     * Purpose: Displays a view allowing a given user to enter search criteria to locate user information in the
     * database.
     *
     * @todo Add validation to ensure authorization to perform search.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying the search criteria.
     */
    public function showSearch()
    {
        return view('pages/admin/user/search/index')
            ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
            ->with('data', null);
    }


    /**
     * Method: getRecords()
     *
     * Purpose: Performs the actions of querying the database for requested information. Checks each input field and
     * compares the search critera.
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector View displaying the search reults.
     */
    public function getRecords()
    {
        $empty_input = true;
        $data = null;
        //If all of the inputs are null do not process search query also ignore token sent with search query
        foreach(Input::all() as $key => $value) {
            if ($value != null && $key != '_token') {
                $empty_input = false;
            }
        }

        if(!$empty_input) {

            $query = DB::table('users as u');

            $query->where('u.user_status_id', '<', '5');//Get all users except for applicant users or users currently
            //filling out an application.

            $query->leftJoin('user_telephones as ut', 'u.id', '=', 'ut.user_id');

            $query->leftJoin('user_financial_aid as ufa', 'u.id', '=', 'ufa.user_id');

            $query->leftJoin('financial_aid_types as ufat', 'ufat.id', '=', 'ufa.type_id');


            if (Input::get('first_name', null) != null) {
                $query->where('u.first_name',
                    'LIKE',
                    '%' . trim(Input::get('first_name')) . '%'); //The '%' is a wildcard symbol
            }

            if (Input::get('middle_name', null) != null) {
                $query->where('u.middle_name',
                    'LIKE',
                    '%' . trim(Input::get('middle_name')) . '%');
            }

            if (Input::get('last_name', null) != null) {
                $query->where('u.last_name',
                    'LIKE',
                    '%' . trim(Input::get('last_name')) . '%');
            }

            if (Input::get('email', null) != null) {
                $query->where('u.email',
                    'LIKE',
                    '%' . trim(Input::get('email')) . '%');
            }

            if (Input::get('telephone_number', null) != null) {

                $query->where('ut.telephone_number',
                    'LIKE',
                    '%' . trim(Input::get('telephone_number')) . '%');
            }

            if (Input::get('financial_aid_types', null) != null) {

                $query->where('ufat.abbreviation',
                    'LIKE',
                    '%' . trim(Input::get('financial_aid_types')) . '%');
            }

            if (Input::get('address', null) != null) {
                $query->whereIn('u.id', function ($innerQuery) {
                    $address = '%' . trim(Input::get('address')) . '%';

                    $innerQuery->select(DB::raw('uad.user_id'))
                        ->from('user_addresses as uad')
                        ->whereRaw('uad.user_id = u.id')
                        ->where('uad.address1', 'LIKE', $address)
                        ->orWhere('uad.address2', 'LIKE', $address);
                });
            }

            $query->addSelect('u.id as id',
                'u.first_name as first_name',
                'u.middle_name as middle_name',
                'u.last_name as last_name',
                'u.email as email',
                //                         get primary telephone with DB::raw
                DB::raw('(SELECT DISTINCT iut.telephone_number
                                        FROM   user_telephones as iut
                                        WHERE  iut.user_id = u.id
                                        AND    iut.is_primary = TRUE) as telephone'),
                'ufat.abbreviation as financial_aid_type');


            $query->orderBy('u.last_name');
            $query->orderBy('u.first_name');

            //        var_dump($query->toSQL());

            $data = $query->distinct()->get();
        }


        return view('pages/admin/user/search/index')
            ->with('sidebar_data', (new DefaultController())->get_sidebar_data())
            ->with('data', $data);
    }
}
