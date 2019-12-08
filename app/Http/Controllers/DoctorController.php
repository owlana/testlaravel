<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $doctors = Doctor::paginate(config('app.nbrPages.doctors'));
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Display info about the doctor.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $doctor = Doctor::find($id);
        return view('doctors.show', compact('doctor'));
    }
}
