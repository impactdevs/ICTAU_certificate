@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary text-light">Create New Member type</div>
                <div class="card-body">
                    <a href="{{ url('/admin/member_type') }}" title="Back"><button class="button2"><i class="fa fa-arrow-left"
                                aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />
                    <form method="POST" action="{{ url('/admin/member_type') }}" accept-charset="UTF-8"
                        class="form-horizontal" enctype="multipart/form-data">
                        @csrf

                        @include ('admin.member-types.form', ['formMode' => 'create'])

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

