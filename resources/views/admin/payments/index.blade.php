@extends('layouts.user_type.auth')

@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">PAyments</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/payment/create') }}" class="btn btn-primary btn-sm" title="Add New payment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/admin/payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Receipt No</th><th>First Name</th><th>Last Name</th><th>Amount</th><th>Balance</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payment as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->receipt_no }}</td>
                                        <td class="text-center">{{ $item->first_name }}</td>
                                        <td class="text-center">{{ $item->last_name }}</td>
                                        <td class="text-center">{{ number_format((int)$item->amount, 0, '.', ',') }}</td>
                                        <td class="text-center">{{ number_format((int)$item->balance, 0, '.', ',') }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/payment/' . $item->id) }}" title="View payment"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/payment/' . $item->id . '/edit') }}" title="Edit payment"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/payment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger" title="Delete payment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            <a href={{"/get-receipt?id=".$item->id}} class="btn btn-primary">Receipt</a>
                                            <a href={{"/share-receipt?id=".$item->id}} class="btn btn-primary">Share</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $payment->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Payment Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="POST">
            <div class="form-group">
                <label for="amount" class="control-label">{{ 'Amount' }}</label>
                <input class="form-control" name="amount" type="text" id="amount" />
            </div>

            <div class="form-group">
                <label for="payment_of" class="control-label">{{ 'Being Payment of:' }}</label>
                <input class="form-control" name="payment_of" type="text" id="payment_of" />
            </div>

            {{-- Cash or cheque checkboxes --}}
            <div class="form-group">
                <label for="payment_mode" class="control-label">{{ 'Payment Mode' }}</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="cash" checked>
                    <label class="form-check-label" for="cash">
                      Cash
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="cheque">
                    <label class="form-check-label" for="cheque">
                      Cheque
                    </label>
                  </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
    @endsection
