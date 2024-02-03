@extends('layouts.master')

@section('title', 'Book List')

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
                <h6 class="m-0 font-weight-bold text-primary">#Book List</h6>
                <div class="d-flex">
                    <a href="{{ route('booklist.deleted') }}" class="btn btn-secondary mr-2">
                        View Deleted List
                    </a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookModal">
                        Add Book
                    </button>
                    <!-- Add Book Modal -->
                    @include('admin.book.create')

                </div>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Cover</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
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
                        @foreach ($booklist as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <!-- Assuming this is inside a table row for each item -->
                                <td>
                                    <img src="{{ $item->cover ? asset('storage/cover/' . $item->cover) : asset('img/default.jpg') }}"
                                        alt="Book Cover" style="width: 100px; height: 150px;">
                                </td>
                                <td>{{ $item->book_code }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    @foreach ($item->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last)
                                            , <!-- Add a comma if it's not the last iteration -->
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if ($item->status == 'in stock')
                                        <span class="badge badge-success">Available</span>
                                    @else
                                        <span class="badge badge-danger">Not Available</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $item->slug }}">
                                        Edit
                                    </button>
                                    <!-- Edit Book Modal -->
                                    @include('admin.book.update')

                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{ $item->slug }}">
                                        Delete
                                    </button>

                                    <!-- Delete Book Modal -->
                                    @include('admin.book.delete')
                            </tr>
                            </td>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
