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

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
