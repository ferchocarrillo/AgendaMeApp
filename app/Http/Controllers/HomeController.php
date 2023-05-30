<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $estadisticas = Appointment::get();
        // $estPend = Appointment::
        // ->where('status', 'Reservada')
        // ->

        // ;
        // return view('home');

        return view('home', compact(
            'estadisticas'
        ));
    }
}
