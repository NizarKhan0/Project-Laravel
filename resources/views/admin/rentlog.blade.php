@extends('layouts.master')

@section('title', 'Rent Log')

@section('content')

    {{-- {{ $rent_logs }} --}}

    <!-- Container Fluid-->
    <div class="container-fluid" id="container-wrapper">
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rent Log</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active" aria-current="page">Rent Log</li>
            </ol>
        </div> --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rent Log</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('#') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('#') }}">Tables</a></li>
                <li class="breadcrumb-item {{ request()->is('rent-logs') ? 'active' : '' }}" aria-current="page">Rent Log
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <x-rent-log-table :rentlog='$rent_logs' />
            </div>
            <!--Row-->
        </div>
        <!---Container Fluid-->
    </div>

@endsection
