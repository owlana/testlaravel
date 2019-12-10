<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::has('doctors')->paginate(config('app.nbrPages.services'));
        return view('services.index', compact('services'));
    }

    /**
     * Display info about the service.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $service = Service::with('doctors')->findOrFail($id);
        return view('services.show', compact('service'));
    }
}
