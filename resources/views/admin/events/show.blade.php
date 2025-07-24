@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4>Event {{ $event->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ url('/admin/events') }}" class="btn btn-secondary" title="Back">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                            </a>

                            <div>
                                <a href="{{ route('attendances.create', ['event_id' => $event->event_id]) }}">Register New Attendance</a>

                            </div>
                            <div>
                                <a href="{{ url('/admin/events/' . $event->id . '/edit') }}" class="btn btn-success" title="Edit Event">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Certificate Generator
                                </a>

                                <a href="{{ url('/admin/events/' . $event->id . '/edit') }}" class="btn btn-warning" title="Edit Event">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </a>
                                <form method="POST" action="{{ url('admin/events/' . $event->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger" title="Delete Event" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Topic</h5>
                                        <p class="card-text">{{ $event->topic }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Date</h5>
                                        <p class="card-text">{{ $event->event_date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Venue</h5>
                                        <p class="card-text">{{ $event->venue }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card border-primary shadow-sm">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title">Template</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <img src="{{ asset($event->certificate_template_path) }}" alt="Current Image" class="img-fluid mt-3" style="max-width: 50%;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ADD THIS BELOW the certificate template section -->

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card border-info shadow-sm">
                                        <div class="card-header bg-info text-white d-flex justify-content-between">
                                            <h5 class="card-title mb-0">Attendances</h5>
                                            <a href="{{ route('attendances.create', ['event_id' => $event->event_id]) }}" class="btn btn-sm btn-outline-light">
                                                <i class="fa fa-plus-circle"></i> Register New
                                            </a>
                                         </div>
                                         <div class="card-body p-0">
                                            @if ($event->attendances->isEmpty())
                                                <div class="p-3 text-center">
                                                    <p class="text-muted">No attendances have been recorded for this event yet.</p>
                                                </div>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table table-bordered mb-0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Full Name</th>
                                                                <th>Email</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                                 @foreach ($event->attendances as $index => $attendee)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $attendee->first_name }} {{ $attendee->last_name }}</td>
                                                                <td>{{ $attendee->email }}</td>
                                                                <td>
                                                                    <a href="{{ route('attendances.show', $attendee->id) }}" class="btn btn-sm btn-primary">
                                                                        <i class="fa fa-eye"></i> View
                                                                    </a>
                                                                    <a href="{{ route('attendances.edit', $attendee->id) }}" class="btn btn-sm btn-warning">
                                                                        <i class="fa fa-pencil"></i> Edit
                                                                    </a>
                                                                        <form action="{{ route('attendances.destroy', $attendee->id) }}" method="POST" style="display:inline;">
                                                                             @csrf
                                                                                 @method('DELETE')
                                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                                                    <i class="fa fa-trash"></i> Delete
                                                                                </button>
                                                                        </form>
                                                                </td>
                                                            </tr>
                                                                @endforeach
                                                         </tbody>
                                                    </table>
                                                </div>
                                            @endif

                                        </div>
                                </div>
                         </div>
                    </div>
             </div>
@endsection
