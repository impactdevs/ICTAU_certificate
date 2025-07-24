@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Events</div>
                <div class="card-body">
                    <a href="{{ url('/admin/events/create') }}" class="btn btn-primary btn-sm" title="Add New training">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <form method="GET" action="{{ url('/admin/events') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span style="margin-left:5px">
                                <button class="btn btn-primary" type="submit" style="height:34px">
                                    Search
                                </button>
                            </span>
                        </div>
                    </form>

                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th><th>Topic</th><th>Date</th><th>Venue</th><th>Registration Link</th><th>Attendance</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->topic }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->event_date)->format('F j, Y') }}</td>
                                    <td>{{ $item->venue }}</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="registration-link-{{ $item->id }}"
                                                   value="{{ route('attendance.register', ['event_id' => $item->event_id]) }}"
                                                   readonly style="background: white; cursor: text;">
                                            <button class="btn btn-outline-secondary copy-btn" type="button"
                                                    data-clipboard-target="#registration-link-{{ $item->id }}"
                                                    title="Copy to clipboard">
                                                <i class="fa fa-copy"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('events.attendance', $item->event_id) }}" title="View Attendance">
                                            <button class="btn btn-success">
                                                <i class="fa fa-eye" aria-hidden="true"></i> View
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('/admin/events/' . $item->id . '/edit') }}" title="Edit Event">
                                            <button class="btn btn-warning">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>

                                        <form method="POST" action="{{ url('/admin/events' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Delete event" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $events->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add clipboard.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
    // Initialize clipboard.js
    document.addEventListener('DOMContentLoaded', function() {
        new ClipboardJS('.copy-btn');

        // Add feedback when copy is successful
        document.querySelectorAll('.copy-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const originalTitle = this.getAttribute('title');
                this.setAttribute('title', 'Copied!');
                setTimeout(() => {
                    this.setAttribute('title', originalTitle);
                }, 2000);
            });
        });
    });
</script>
@endsection