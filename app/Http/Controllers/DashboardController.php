<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user')) {
            $acc = Account::where('user_id', Auth::user()->id)->first();
            if (is_null($acc)) {
                return view('user.add-account-info');
            }

            return view('user.dashboard', [
                'acc' => $acc
            ]);
        } elseif (Auth::user()->hasRole('recruiter')) {
            return redirect()->route('recruiter-dashboard');
        } elseif (Auth::user()->hasRole('admin')) {
            return view('admin.dashboard');
        }
    }
}
