<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('specialities')->paginate(config('app.nbrPages.doctors'));
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Display info about the doctor.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }
}
