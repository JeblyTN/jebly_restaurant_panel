<?php

namespace App\Http\Controllers;

class AdvertisementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view("advertisements.index");
    }
    public function create()
    {
        return view('advertisements.create');
    }
    public function edit($id)
    {
        return view('advertisements.edit')->with('id', $id);
    }
    public function view($id)
    {
        return view('advertisements.view')->with('id', $id);
    }
    public function chat($id)
    {
        return view('advertisements.chat')->with('id', $id);
    }

}