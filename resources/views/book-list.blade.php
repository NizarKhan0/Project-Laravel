@extends('layouts.master')

@section('title', 'Book List')

@section('content')

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


    <div class="card">
        <div class="card">
            <div class="card-body d-flex flex-column align-items-center">
                <h1>Books</h1>

                <!-- Search Form -->
                <form action="" method="GET" class="mb-4 form-inline">
                    <div class="form-group mr-2">
                        <label for="title" class="mr-2">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group mr-2">
                        <label for="category" class="mr-2">Category</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Select category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <div class="container mt-4">
                    <div class="row">
                        @foreach ($books as $item)
                            <div class="col-md-2">
                                <div class="card mb-4 d-flex align-items-center h-100">

                                    <img src="{{ $item->cover ? asset('storage/cover/' . $item->cover) : asset('img/default.jpg') }}"
                                        alt="Book Cover" class="card-img-top" draggable="false"
                                        style="width: 100%; height: 150px; object-fit: cover;">
                                    <div class="card-body" style="height: auto; text-align: center;">
                                        <!-- Set a fixed height for the card body -->
                                        <h5 class="card-title font-weight-bold">
                                            @if ($item->status == 'in stock')
                                                <span class="badge badge-success">Available</span>
                                            @else
                                                <span class="badge badge-danger">Not Available</span>
                                            @endif
                                        </h5>
                                        <h5 class="card-title font-weight-bold">{{ $item->title }}</h5>
                                        <h5 class="card-title font-weight-bold">{{ $item->book_code }}</h5>

                                        <div class="categories">
                                            @foreach ($item->categories as $category)
                                                <span
                                                    class="badge badge-secondary font-weight-bold">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                        {{-- <a href="#" class="btn btn-primary font-weight-bold">Read More</a> --}}
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
