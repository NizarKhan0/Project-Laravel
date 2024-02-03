@extends('layouts.master')

@section('title', 'Profile')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <x-rent-log-table :rentlog='$rent_logs' />
        </div>
        <!--Row-->
    </div>

@endsection
