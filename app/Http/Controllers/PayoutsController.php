<?php

namespace App\Http\Controllers;

class PayoutsController extends Controller
{  

   public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view("restaurants_payouts.index");
    }

     public function create()
    {
        return view("restaurants_payouts.create");
    }

}