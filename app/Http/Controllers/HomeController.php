<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $appointments = DB::table('appointments')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('interval_schedule', 'interval_schedule.id', '=', 'appointments.interval_schedule_id')
            ->join('intervals', 'interval_schedule.interval_id', '=', 'intervals.id')
            ->join('schedules', 'interval_schedule.schedule_id', '=', 'schedules.id')
            ->join('doctors', 'schedules.doctor_id', '=', 'doctors.id')
            ->where('schedules.date', '>=', date('Y-m-d'))
            ->where('appointments.user_id', '=', Auth::user()->id)
            ->select('appointments.id', 'doctors.name', 'schedules.date', 'intervals.time', 'services.title')
            ->orderBy('schedules.date', 'asc')
            ->orderBy('intervals.time', 'asc')
            ->get();

        return view('home', compact('appointments'));
    }
}
