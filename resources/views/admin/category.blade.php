@extends('layouts.master')

@section('title', 'Category')

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
                <h6 class="m-0 font-weight-bold text-primary">#Category List</h6>
                <div class="d-flex">
                    <a href="{{ route('categories.deleted') }}" class="btn btn-secondary mr-2">
                        View Deleted List
                    </a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                        Add Category
                    </button>
                </div>
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
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $item->slug }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $item->slug }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Category Modal -->
                            @include('admin.category.update')

                            <!-- Delete Category Modal -->
                            @include('admin.category.delete')

                            <!-- Add Category Modal -->
                            @include('admin.category.create')
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
