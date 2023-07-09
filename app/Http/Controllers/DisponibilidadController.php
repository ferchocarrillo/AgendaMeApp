<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisponibilidadController extends Controller

{
    public function disponibilidad()
    {

        $carbon = new \Carbon\Carbon();
        $desde = $carbon->now();
        $date1 = $desde->format('d-m-Y');
        $hasta = $desde->addDays(30);
        $date2 = $hasta->format('d-m-Y');



        $counts = Appointment::where('status', 'Confirmada')->whereBetween('scheduled_date', [$date1, $date2])->get();

        $citesCount = $counts->count();

        //dd($date1, $date2);

        // $monthCounts = Appointment::all();
        // where('created_at', '>=', $modifiedMutable = $day->add(1, 'day'))
        // ->groupBy(DB::raw('Date(created_at)'))
        // ->orderBy('created_at', 'DESC')->get();


        // $monthCounts = Appointment::select(
        //     DB::raw('DAY(created_at) as DAY'),
        //     DB::raw('COUNT(*) as count')
        // )
        //     ->groupBy('day')
        //     ->get()
        //     ->toArray();
        // $counts = array_fill(0, 12, 0);
        // foreach ($monthCounts as $monthCount) {
        //     $index = $monthCount['day'] - 1;
        //     $counts[$index] = $monthCount['count'];
        // }
        //dd($counts);
        return view('disponibilidad', compact('date1', 'date2', 'counts', 'citesCount'));
        // return view('disponibilidad', compact('counts', 'modifiedMutable', 'mutable'));



    }
}
