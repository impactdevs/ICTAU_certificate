@extends('layouts.user_type.auth')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex flex-row justify-content-between">
                        <p>Members</p>
                        <a href="{{ url('/admin/member/create') }}" class="btn btn-primary btn-sm" title="Add New member">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                    </div>
                    <div class="card-body" style="max-height: 73vh; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-sm" data-toggle="table"
                            data-pagination="true" data-page-list="[5, 25, 50, 100, all]" data-search="true">
                            <thead>
                                <tr>
                                    <th>Membership ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Membership Type</th>
                                    <th>Last Subscribed on</th>
                                    <th>status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($member as $item)
                                    <tr>
                                        <td class="{{ $item->applicant_id ? 'text-success' : '' }}"> <a
                                                href="{{ url('/admin/member/' . $item->id) }}" title="View member"
                                                class="{{ $item->applicant_id ? 'text-success' : '' }}">
                                                {{ $item->membership_id }}
                                            </a></td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->membershipType->membership_type_name }}</td>
                                        @php
                                            $subscription = isset($item->subscriptions[0]) ? $item->subscriptions[0] : null;
                                        @endphp
                                        <td>
                                            @if ($subscription)
                                                {{ \Carbon\Carbon::parse($subscription->subscribed_on)->format('d M Y') }}
                                            @else
                                                {{  \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (
                                                ($subscription && \Carbon\Carbon::parse($subscription->subscribed_on)->year == now()->year) ||
                                                (!$subscription && \Carbon\Carbon::parse($item->created_at)->year == now()->year)
                                            )
                                                <span class="badge bg-success">Running</span>
                                            @else
                                                <span class="badge bg-danger">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/member/' . $item->id) }}" title="View member"><button
                                                    class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i>
                                                    View</button></a>
                                            <a href="{{ url('/admin/member/' . $item->id . '/edit') }}"
                                                title="Edit member"><button class="btn btn-warning"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i>
                                                    Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/member' . '/' . $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger" title="Delete member"
                                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                        class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Certificate
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><button class="dropdown-item" type="button"><a
                                                                class="dropdown-item"
                                                                href="{{ url('/get-certificate?id=' . $item->id . '&file_type=png') }}">PNG</a></button>
                                                    </li>
                                                    <li><button class="dropdown-item" type="button"><a
                                                                class="dropdown-item"
                                                                href="{{ url('/get-certificate?id=' . $item->id . '&file_type=pdf') }}">PDF</a></button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Renew Button triggers modal -->
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#renewModal-{{ $item->id }}">Renew</button>

                                            <!-- Renewal Modal -->
                                            <div class="modal fade" id="renewModal-{{ $item->id }}" tabindex="-1" aria-labelledby="renewModalLabel-{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="renewModalLabel-{{ $item->id }}">Renew Membership</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <h5 class="mb-2 text-primary">
                                                                    <i class="fa fa-user-circle me-2"></i>
                                                                    {{ $item->first_name }} {{ $item->last_name }}
                                                                </h5>
                                                                <p class="mb-1">
                                                                    <span class="fw-semibold">Membership Type:</span>
                                                                    <span class="badge bg-info text-dark">{{ $item->membershipType->membership_type_name }}</span>
                                                                </p>
                                                                <p class="mb-3">
                                                                    <span class="fw-semibold">Current Expiry:</span>
                                                                    <span class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                                                </p>
                                                            </div>
                                                            <form method="POST" action="{{ route('subscriptions.store') }}">
                                                                @csrf
                                                                <input type="hidden" name="membership_id" value="{{ $item->id }}">
                                                                <div class="mb-3">
                                                                    <label for="subscribed_on-{{ $item->id }}" class="form-label fw-semibold">
                                                                        <i class="fa fa-calendar-alt me-1"></i>
                                                                        Date of Renewal
                                                                    </label>
                                                                    <input type="date" name="subscribed_on" id="subscribed_on-{{ $item->id }}" class="form-control border-primary" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                                </div>
                                                                <div class="d-flex justify-content-end gap-2">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        <i class="fa fa-times me-1"></i> Cancel
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fa fa-check me-1"></i> Confirm Renewal
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
