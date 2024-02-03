@extends('layouts.master')

@section('title', 'Deleted Category')

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
                <h6 class="m-0 font-weight-bold text-primary">#Deleted Category List</h6>
                <a href="{{ route('categories') }}" class="btn btn-primary mr-2">
                    Back
                </a>
                {{-- <div class="d-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                        Restore
                    </button>
                </div> --}}
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Genre</th>
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
                        @foreach ($deletedCategories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{-- <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editModal{{ $item->slug }}">
                                        Restore
                                    </button> --}}
                                    <a href="{{ route('categories.restore', $item->slug) }}" class="btn btn-warning mr-2">
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
