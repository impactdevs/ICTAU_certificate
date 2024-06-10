@extends('layouts.user_type.auth')

@section('content')
    <form action="{{ url('admin/general-settings-update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="send_welcome_email_after" class="control-label">{{ 'Send Welcome email After:' }}</label>
            <input class="form-control shadow-none" name="send_welcome_email_after" type="text" id="send_welcome_email_after"
                value="{{ $general_settings->send_welcome_email_after ?? '' }}"
                aria-describedby="send_welcome_email_after_help">
            <div id="send_welcome_email_after_help" class="form-text">
                Should be in days (eg. 30 or 4.5)
            </div>
        </div>

        <div class="form-group">
            <label for="send_certificate_after" class="control-label">{{ 'Send Certificate After:' }}</label>
            <input class="form-control shadow-none" name="send_certificate_after" type="text" id="send_certificate_after"
                value="{{ $general_settings->send_certificate_after ?? '' }}"
                aria-describedby="send_certificate_after_help">
            <div id="send_certificate_after_help" class="form-text">
              Should be in days (eg. 30 or 4.5)
            </div>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="UPDATE">
        </div>
    </form>
@endsection
