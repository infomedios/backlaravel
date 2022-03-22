<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;


Use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function getAll(){
        $data = Appointment::get();
        return response()->json($data, 200);
    }

    public function create(Request $request){
        $data['title'] = $request['title'];
        $data['message'] = $request['message'];
        $data['price_expected'] = $request['price_expected'];
        $data['discount'] = $request['discount'];
        $data['status'] = $request['status'];
        $data['sheduled_date'] = $request['sheduled_date'];
        $data['person_id'] = $request['person_id'];
        Appointment::create($data);

        //create a new event
        $event = new Event;

        $event->name = $data['title'];
        $event->description = $data['message'];
        $date = Carbon::parse($data['sheduled_date'])->format('m/d/Y');
        $date = Carbon::createFromFormat('m/d/Y', $date);
        $event->startDateTime = $date;
        $event->endDateTime = $date->addHour();

        $event->save();

        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }

    public function delete($id){
        $res = Appointment::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
    }

    public function get($id){
        $data = Appointment::find($id);
        return response()->json($data, 200);
    }

    public function update(Request $request,$id){
        $data['title'] = $request['title'];
        $data['message'] = $request['message'];
        $data['price_expected'] = $request['price_expected'];
        $data['discount'] = $request['discount'];
        $data['status'] = $request['status'];
        $data['sheduled_date'] = $request['sheduled_date'];
        $data['person_id'] = $request['person_id'];
        Appointment::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }
}
