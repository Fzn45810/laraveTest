@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Meeting</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('savemeeting')}}">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Subject</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="meeting_subject">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Date</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="meeting_date">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Time</label>

                            <div class="col-md-6">
                                <input type="time" class="form-control" name="meeting_time">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Attendee One</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="attendee_one">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Attendee Two</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="attendee_two">
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

                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($get_meeting as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->meeting_subject }}</td>
                                <td>
                                    <i type="button" onclick="window.location='{{ route("edit", "$item->id")}}'" class="fa fa-edit" style="font-size:24px"></i>
                                    <i type="button" onclick="window.location='{{ route("delete", "$item->id")}}'" class="fa fa-trash" style="font-size:24px"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $get_meeting->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
