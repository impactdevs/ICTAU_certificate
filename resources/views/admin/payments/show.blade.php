@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">Payment Details</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/payment') }}" title="Back"><button class="btn btn-success"><i class="fa fa-arrow-left"
                                    aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/payment/' . $payment->id . '/edit') }}" title="Edit payment details"><button
                                class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/payment' . '/' . $payment->id) }}" accept-charset="UTF-8"
                            style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger" title="Delete payment"
                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i> Delete</button>
                        </form>
                        <br />
                        <br />

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Receipt No:</th>
                                        <td>{{ $payment->receipt_no }}</td>
                                    </tr>
                                    <tr>
                                        <th> First Name </th>
                                        <td> {{ $payment->first_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Last Name </th>
                                        <td> {{ $payment->last_name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Amount </th>
                                        <td> {{ $payment->amount}} </td>
                                    </tr>
                                    <tr>
                                        <th> Balance </th>
                                        <td> {{ $payment->balance }} </td>
                                    </tr>
                                    <tr>
                                        <th> Payment Mode </th>
                                        <td> {{ $payment->payment_mode }} </td>
                                    </tr>
                                    <tr>
                                        <th> Being Payment of </th>
                                        <td> {{ $payment->payment_of }} </td>
                                    </tr>
                                    @if($payment->payment_mode == 'cheque')
                                    <tr>
                                        <th> Cheque Number </th>
                                        <td> {{ $payment->cheque_number }} </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <th> Received By </th>
                                        <td> {{ $payment->received_by }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
