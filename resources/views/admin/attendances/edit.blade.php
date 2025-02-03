@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Edit Attendance #{{ $attendance->id }}</div>
                <div class="card-body">
                    <a href="{{ url('/admin/attendance') }}" title="Back">
                        <button class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                    </a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/admin/attendance/' . $attendance->id) }}" accept-charset="UTF-8" class="form-horizontal">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        <!-- First Name Field -->
                        <x-forms.input name="first_name" label="First Name" type="text" id="first_name" placeholder="First Name" value="{{ $attendance->first_name ?? '' }}" />

                        <!-- Last Name Field -->
                        <x-forms.input name="last_name" label="Last Name" type="text" id="last_name" placeholder="Last Name" value="{{ $attendance->last_name ?? '' }}" />

                        <!-- Email Field -->
                        <x-forms.input name="email" label="Email" type="email" id="email" placeholder="Email" value="{{ $attendance->email ?? '' }}" />

                        
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Update Attendance">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
