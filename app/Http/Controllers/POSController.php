<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class POSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function pointOfSale(){
        $commissionSettings = session('commissionSettings', [
            'enabled' => false,
            'type' => 'Percent',
            'value' => 0,
        ]);       
        return view("pos.index", compact('commissionSettings'));
    }

    public function posOrder(){
        return view("pos.order_index");
    }
}
