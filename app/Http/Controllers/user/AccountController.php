<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'natid' => 'required|string|max:16',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'address' => 'required|string'
        ]);

        $accnum = rand(000000, 999999);
        $acc = new Account();
        $acc->user_id = Auth::user()->id;
        $acc->accnum = $accnum;
        $acc->firstname = $request->firstname;
        $acc->lastname = $request->lastname;
        $acc->natid = $request->natid;
        $acc->gender = $request->gender;
        $acc->dob = $request->dob;
        $acc->address = $request->address;
        //type
        //amount
        $acc->save();

        return redirect()->back()->with('success', 'successfully added your information');
    }
}
