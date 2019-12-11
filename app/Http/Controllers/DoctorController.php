<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Cache;

class DoctorController extends Controller
{
    /**
     * Display a listing of the doctors.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $doctors = Cache::remember('doctors_page_' . $page, 900, function () {
            return Doctor::with('specialities')
                ->with('services')
                ->orderBy('name', 'asc')
                ->paginate(config('app.nbrPages.doctors'));
        });

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Display info about the doctor.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $doctor = Cache::remember('doctor_' . $id, 900, function () use ($id) {
            return Doctor::with('specialities')
                ->with('services')
                ->with('schedules')
                ->findOrFail($id);
        });

        return view('doctors.show', compact('doctor'));
    }
}
