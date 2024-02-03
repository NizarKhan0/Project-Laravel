<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnCallback;

class UserController extends Controller
{
    public function profile()
    {
        //$request->session()->flush(); //(end session)
        // dd(Auth::user());
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id',Auth::user()->id)->get();
        return view('users.profile',['rent_logs' => $rentlogs]);
    }

    public function activeUser()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('admin.user.activeuser', ['users' => $users]);
    }

    public function registeredUser()
    {
        $registeredUser = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('admin.user.registered-user', ['registeredUsers' => $registeredUser]);
    }

    public function detailUser($slug = 'default-slug')
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id',$user->id)->get();

        //dd($user);
        return view('admin.user.detail', ['user' => $user, 'rent_logs' => $rentlogs]);
    }

    public function approveUser($slug)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('active.users')->with('error', 'User not found.');
        }

        $user->status = 'active';
        $user->save();

        return redirect()->route('active.users', ['slug' => $slug])->with('success', 'User approved successfully.');
    }

    public function rejectUser($slug)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('active.users')->with('error', 'User not found.');
        }

        // Force delete the user
        $user->forceDelete();

        return redirect()->route('active.users')->with('success', 'User rejected and removed successfully.');
    }

    public function banUser($slug)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('active.users')->with('error', 'User not found.');
        }

        // Soft delete the user
        $user->delete();

        return redirect()->route('active.users')->with('success', 'User banned successfully.');
    }
    public function bannedUser()
    {
        $bannedUser = User::onlyTrashed()->get();

        return view('admin.user.banneduser', ['bannedUser' => $bannedUser]);
    }

    public function restoreUser($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();

        if (!$user) {
            return redirect()->route('active.users')->with('error', 'User not found for restoration.');
        }

        $user->restore();
        return redirect()->route('active.users')->with('success', 'User restored successfully.');
    }

}