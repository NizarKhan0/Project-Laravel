@extends('layouts.master')

@section('title', 'User')

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
                <h6 class="m-0 font-weight-bold text-primary">#Active User List</h6>
                <div class="d-flex">
                    <a href="{{ route('banned.users') }}" class="btn btn-secondary mr-2">
                        View Banned User
                    </a>
                    <a href="{{ route('registered.users') }}" class="btn btn-primary mr-2">
                        New Registred User
                    </a>
                </div>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    @if ($item->phone)
                                        {{ $item->phone }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ asset('/admin/user/detail/' . $item->slug) }}"
                                        class="btn btn-secondary mr-2">
                                        Detail
                                    </a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $item->slug }}">
                                        Ban
                                    </button>

                                    <!-- Ban User Modal -->
                                    @include('admin.user.ban')
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
