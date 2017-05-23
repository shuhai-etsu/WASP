<?php

namespace App\Http\Controllers;

class LogController extends DefaultController
{

    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function index()
    {
        try 
        {
            return view('pages/admin/system/log')
                    ->with('sidebar_data', parent::get_sidebar_data());
        }
        catch(Exception $exception)
        {

        }    
    }
}