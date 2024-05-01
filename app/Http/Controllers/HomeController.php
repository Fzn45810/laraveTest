<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Meeting;
use Auth;

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
        // dd(Auth::id());
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

        $meeting = new Meeting();
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

        Meeting::where('id', $request->meetingid)
        ->update([
            'meeting_subject' => $request->meeting_date,
            'meeting_date' => $request->meeting_date,
            'meeting_time' => $request->meeting_time,
            'attendee_one' => $request->attendee_one,
            'attendee_two' => $request->attendee_two
        ]);

        return back()->with(['status' => 'Successfully updated!']);
    }

    public function delete_meeting($id){
        Meeting::where('id', $id)->delete();
        return back()->with(['status' => 'Successfully deleted!']);
    }
}
