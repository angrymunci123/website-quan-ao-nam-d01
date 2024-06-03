<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function or_lists(){
        return view("admin.order.order_list");
    }
}
