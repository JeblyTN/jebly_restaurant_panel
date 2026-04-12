<?php

namespace App\Http\Controllers;

class WithdrawMethodController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("withdraw_method.index");

    }
    public function create()
    {
        return view("withdraw_method.create");
    }
}