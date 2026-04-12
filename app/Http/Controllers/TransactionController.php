<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("transaction.index");
    }
}