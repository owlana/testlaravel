<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IntervalSchedule;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentAjaxController extends Controller
{
    private $response = ['status' => 0];
    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->input('service')
            || !$request->input('interval')
        ) {
            return response($this->response);
        }

        $appointment = new Appointment();
        $appointment->user_id = Auth::user()->id;
        $appointment->service_id = $request->input('service');
        $appointment->interval_schedule_id = $request->input('interval');

        DB::beginTransaction();
        try {
            $appointment->save();
            IntervalSchedule::where('id', $request->input('interval'))->update(['is_busy' => true]);
        } catch(\Exception $e) {
            DB::rollBack();
            return response($this->response);
        }
        DB::commit();

        $this->response['status'] = 1;
        return response($this->response);
    }

    public function delete(Request $request)
    {
        $appointment = Appointment::find($request->input('appointment'));
        if (!$appointment) {
            return response($this->response);
        }

        DB::beginTransaction();
        try {
            Appointment::destroy($request->input('appointment'));
            IntervalSchedule::where('id', $appointment->interval_schedule_id)->update(['is_busy' => false]);
        } catch(\Exception $e) {
            DB::rollBack();
            return response($this->response);
        }
        DB::commit();

        $this->response['status'] = 1;
        return response($this->response);
    }

    public function getIntervals(Request $request)
    {
        if (!$request->input('date')) {
            return false;
        }

        if (!$intervals = Schedule::find($request->input('date'))->intervals) {
            return false;
        }

        return view('doctors.intervals', compact('intervals'));
    }
}
