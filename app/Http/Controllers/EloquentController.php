<?php

namespace App\Http\Controllers;
use App\Company;
use App\Customer;
use Illuminate\Http\Request;

class EloquentController extends Controller
{
    //

    public function Home()
    {
    	$companies = Company::all();
        return view('welcome',compact('companies'));
    }
}
