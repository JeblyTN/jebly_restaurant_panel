<?php

namespace App\Http\Controllers;

class CouponController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
      public function index()
    {
        return view("coupons.index");
    }

    public function edit($id)
    {
        return view('coupons.edit')->with('id', $id);
    }

    public function create()
    {
        return view('coupons.create');
    }

}


