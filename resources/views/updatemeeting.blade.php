@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Meeting</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('updatemeeting')}}">
                        @csrf
                        <input type="text" name="meetingid" hidden value="{{$get_meeting->id}}">

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Subject</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="meeting_subject" value="{{$get_meeting->meeting_subject}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Date</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="meeting_date" value="{{$get_meeting->meeting_date}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end" >Time</label>

                            <div class="col-md-6">
                                <input type="time" class="form-control" name="meeting_time" value="{{$get_meeting->meeting_time}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Attendee One</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="attendee_one" value="{{$get_meeting->attendee_one}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Attendee Two</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="attendee_two" value="{{$get_meeting->attendee_one}}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
