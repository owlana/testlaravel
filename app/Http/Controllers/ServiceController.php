<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $services = Cache::remember('services_page_' . $page, 900, function () {
            return Service::has('doctors')->paginate(config('app.nbrPages.services'));
        });

        return view('services.index', compact('services'));
    }

    /**
     * Display info about the service.
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $service = Cache::remember('service_' . $id, 900, function () use ($id) {
            return Service::with('doctors')->findOrFail($id);
        });

        return view('services.show', compact('service'));
    }
}
