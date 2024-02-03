<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        //from rentlogs modal
        //$today = Carbon::now()->toDateString();
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        return view('admin.rentlog', ['rent_logs' => $rentlogs]);
    }
}