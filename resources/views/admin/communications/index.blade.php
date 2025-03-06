@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">Emails</div>
                    <div class="card-body">
                        <a href="{{ url('admin/communications/send-email') }}" class="btn btn-primary btn-sm" title="compose an email">
                            <i class="fa fa-plus" aria-hidden="true"></i> Compose Email
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
