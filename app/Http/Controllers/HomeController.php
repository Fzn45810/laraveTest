<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Meeting;
use Auth;
use Spatie\GoogleCalendar\Event;
use Google\Client;

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
        $get_meeting = Meeting::paginate(1);
        return view('home', compact('get_meeting'));
    }

    /**
     * Save Meeting with attendee
     *
     */
    public function save_meeting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meeting_subject' => 'required', 'string', 'max:255',
            'meeting_date' => 'required', 'string', 'max:255',
            'meeting_time' => 'required', 'string', 'max:255',
            'attendee_one' => 'required', 'string', 'email', 'max:255',
            'attendee_two' => 'string', 'email', 'max:255'
        ]);

        if ($validator->fails()) {
             return back()->withErrors($validator->errors());
        }

        $event = new Event();

        $event->name = $request->meeting_subject;
        $event->startDateTime = $request->meeting_date . " " . $request->meeting_time;
        $event->addAttendee(['email' => $request->attendee_one]);
        $event->addAttendee(['email' => $request->attendee_two]);
        $event->addMeetLink();

        $event->save();

        $meeting = new Meeting();
        $meeting->event_id = $event->id;
        $meeting->meeting_subject = $request->meeting_subject;
        $meeting->meeting_date = $request->meeting_date;
        $meeting->meeting_time = $request->meeting_time;
        $meeting->attendee_one = $request->attendee_one;
        $meeting->attendee_two = $request->attendee_two;

        $meeting->user()->associate(Auth::id());
        $meeting->save();

        return Redirect::route('home');
    }

    public function edit_meeting($id){
        $get_meeting = Meeting::where('id', $id)->first();
        return view('updatemeeting', compact('get_meeting'));
    }

    public function update_meeting(Request $request){
        $validator = Validator::make($request->all(), [
            'meeting_subject' => 'required', 'string', 'max:255',
            'meeting_date' => 'required', 'string', 'max:255',
            'meeting_time' => 'required', 'string', 'max:255',
            'attendee_one' => 'required', 'string', 'email', 'max:255',
            'attendee_two' => 'string', 'email', 'max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


        $get_meeting = Meeting::where('id', $request->meetingid)->first();

        $get_calenderevent = Event::find($get_meeting->event_id);

        $get_calenderevent->delete();

        $event = new Event();

        $event->name = $request->meeting_subject;
        $event->startDateTime = $request->meeting_date . " " . $request->meeting_time;
        $event->addAttendee(['email' => $request->attendee_one]);
        $event->addAttendee(['email' => $request->attendee_two]);
        $event->addMeetLink();

        $event->save();

        $get_meeting->update([
            'event_id' => $event->id,
            'meeting_subject' => $request->meeting_subject,
            'meeting_date' => $request->meeting_date,
            'meeting_time' => $request->meeting_time,
            'attendee_one' => $request->attendee_one,
            'attendee_two' => $request->attendee_two
        ]);

        $get_calenderevent->update([
            'name' => $request->meeting_subject,
            'startDateTime' => $request->meeting_date . " " . $request->meeting_time,
            'email' => $request->meeting_subject,
            'name' => $request->meeting_subject,
        ]);

        return back()->with(['status' => 'Successfully updated!']);
    }

    public function delete_meeting($id){
        $get_meeting = Meeting::where('id', $request->meetingid)->first();
        $get_calenderevent = Event::find($get_meeting->event_id);

        $get_calenderevent->delete();
        $get_meeting->delete();

        return back()->with(['status' => 'Successfully deleted!']);
    }
}
