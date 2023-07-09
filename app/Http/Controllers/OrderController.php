<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\OrderProcessed;
use App\Models\Order;


class OrderController extends Controller
{
    public function store(Request $request)
    {
      $order = factory(Order::class)->create();

      //$order = "+513187200092";



      $request->user()->notify(new OrderProcessed($order));


      return redirect()->route('home')->with('status', 'Order Placed!');
    }
}
