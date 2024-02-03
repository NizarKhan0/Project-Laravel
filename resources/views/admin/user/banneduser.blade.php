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
                <h6 class="m-0 font-weight-bold text-primary">#Banned User List</h6>
                <div class="d-flex">
                    <a href="{{ route('active.users') }}" class="btn btn-primary mr-2">
                        Back
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
                        @foreach ($bannedUser as $item)
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
                                    <a href="{{ route('restore.users', $item->slug) }}" class="btn btn-warning mr-2">
                                        Restore
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
