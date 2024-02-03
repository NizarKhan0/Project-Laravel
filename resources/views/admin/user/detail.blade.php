@extends('layouts.master')

@section('title', 'Detail User')

@section('content')

    <!-- DataTable with Hover -->
    <div class="col-lg-12">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">#User Detail</h6>
                {{-- <div class="d-flex">
                    @if ($user->status == 'inactive')
                        <!-- Approve Button with Modal Trigger -->
                        <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                            data-target="#approveModal{{ $user->slug }}">
                            Approve
                        </button>
                        <!-- Approve Modal -->
                        <div class="modal fade" id="approveModal{{ $user->slug }}" tabindex="-1" role="dialog"
                            aria-labelledby="approveModalLabel{{ $user->slug }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="approveModalLabel{{ $user->slug }}">Approve User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to approve the user "{{ $user->username }}"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <a href="{{ route('approve.users', ['slug' => $user->slug]) }}"
                                            class="btn btn-info">Approve</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reject Button with Modal Trigger -->
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#rejectModal{{ $user->slug }}">
                            Reject
                        </button>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal{{ $user->slug }}" tabindex="-1" role="dialog"
                            aria-labelledby="rejectModalLabel{{ $user->slug }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="rejectModalLabel{{ $user->slug }}">Reject User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to reject the user "{{ $user->username }}"?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <a href="{{ route('reject.users', ['slug' => $user->slug]) }}"
                                            class="btn btn-danger">Reject</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div> --}}
                <div class="d-flex">
                    <a href="{{ route('active.users') }}" class="btn btn-primary mr-2">
                        Back
                    </a>
                </div>

            </div>
            <!-- Simple Tables -->
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                @if ($user->status == 'inactive')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        @if ($user)
                            <tbody>
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @if ($user->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    @if ($user->status == 'inactive')
                                        <td>
                                            <!-- Approve Button with Modal Trigger -->
                                            <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                                data-target="#approveModal{{ $user->slug }}">
                                                Approve
                                            </button>
                                            <!-- Approve Modal -->
                                            <div class="modal fade" id="approveModal{{ $user->slug }}" tabindex="-1"
                                                role="dialog" aria-labelledby="approveModalLabel{{ $user->slug }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="approveModalLabel{{ $user->slug }}">Approve User
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to approve the user
                                                                "{{ $user->username }}"?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <a href="{{ route('approve.users', ['slug' => $user->slug]) }}"
                                                                class="btn btn-info">Approve</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Reject Button with Modal Trigger -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#rejectModal{{ $user->slug }}">
                                                Reject
                                            </button>

                                            <!-- Reject Modal -->
                                            <div class="modal fade" id="rejectModal{{ $user->slug }}" tabindex="-1"
                                                role="dialog" aria-labelledby="rejectModalLabel{{ $user->slug }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="rejectModalLabel{{ $user->slug }}">Reject User
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to reject the user
                                                                "{{ $user->username }}"?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <a href="{{ route('reject.users', ['slug' => $user->slug]) }}"
                                                                class="btn btn-danger">Reject</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        @else
                            <p>User not found</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- Simple Tables -->
        <x-rent-log-table :rentlog='$rent_logs' />

    </div>


@endsection
