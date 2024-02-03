@extends('layouts.master')

@section('title', 'Deleted Book')

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
                <h6 class="m-0 font-weight-bold text-primary">#Deleted Book List</h6>
                <a href="{{ route('booklist') }}" class="btn btn-primary mr-2">
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
                        @foreach ($deletedBooks as $item)
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
                                <td>{{ $item->status }}</td>
                                {{-- <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editModal{{ $item->slug }}">
                                        Restore
                                    </button> --}}
                                <td>
                                    <a href="{{ route('booklist.restore', $item->slug) }}" class="btn btn-warning mr-2">
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
