<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	  public function index()
    {
        return view("foods.index");
    }

    public function edit($id)
    {
    	  return view('foods.edit')->with('id',$id);
    }

    public function create()
    {
      return view('foods.create');
    }

    public function global()
    {
      return view('foods.global');
    }
}
