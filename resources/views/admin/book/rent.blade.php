@extends('layouts.master')

@section('title', 'Book Rent')

@section('content')


    {{-- {{ $books }} --}}
    <!-- DataTable with Hover -->
    <div class="col-lg-12">

        @if (session('error'))
            <div class="alert {{ session('alert-error') }}">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert {{ session('alert-success') }}">
                {{ session('success') }}
            </div>
        @endif

        <h6 class="m-0 font-weight-bold text-primary">#Book Rent</h6>

        <div class="card mb-4">
            <div class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Book</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <form action="{{ route('book.store') }}" method="post">
                                @csrf

                                <td data-label="Name">
                                    {{-- <select name="user[]" id="user" class="form-control userbox"> --}}
                                    <select class="form-control inputbox" name="user_id">
                                        <option value="">Select User</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->username }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td data-label="Book">
                                    <select class="form-control inputbox" name="book_id">
                                        <option value="">Select Book</option>
                                        @foreach ($books as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td data-label="Book">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
