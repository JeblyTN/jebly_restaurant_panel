<?php

namespace App\Http\Controllers;

class MySubscriptionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("my_subscriptions.index");
    }

    public function show($id)
    {
        return view('my_subscriptions.show')->with('id', $id);
    }
}


