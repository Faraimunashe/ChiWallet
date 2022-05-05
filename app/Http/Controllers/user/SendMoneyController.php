<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendMoneyController extends Controller
{
    public function index()
    {
        return view('user.sendmoney');
    }

    public function send(Request $request)
    {
        $request->validate([
            'accnum' => 'required|digits:6',
            'amount' => 'required|numeric'
        ]);

        $receiver = Account::where('accnum', $request->accnum)->first();
        if (is_null($receiver)) {
            return redirect()->back()->with('error', 'Sorry, receiver was not found!');
        }

        $sender = Account::where('user_id', Auth::user()->id)->first();
        if ($sender->accnum == $receiver->accnum) {
            return redirect()->back()->with('error', 'Sorry, cannot you cannot transfer to your own account try depositing!');
        }

        return view('user.confirm-receiver', [
            'receiver' => $receiver,
            'amount' => $request->amount
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'accnum' => 'required|digits:6',
            'amount' => 'required|numeric'
        ]);
        $sender = Account::where('user_id', Auth::user()->id)->first();
        $receiver = Account::where('accnum', $request->accnum)->first();

        $remaining_balance = $sender->balance - $request->amount;
        if ($remaining_balance < 0) {
            return redirect()->route('dashboard')->with('error', 'you have insufficient balance to send money!');
        }

        //sender
        $sender_log = new Transaction();
        $sender_log->action = 'SENT';
        $sender_log->user_id = Auth::user()->id;
        $sender_log->receiver_user_id = $receiver->user_id;
        $sender_log->sender_user_id = Auth::user()->id;
        $sender_log->status = 'SUCCESSFUL';
        $sender_log->begin_balance = $sender->balance;
        $sender_log->amount = $request->amount;
        $sender_log->end_balance  = $sender->balance - $request->amount;
        $sender_log->save();

        //receiver
        $receiver_log = new Transaction();
        $receiver_log->action = 'RECEIVED';
        $receiver_log->user_id = $receiver->user_id;
        $receiver_log->receiver_user_id = $receiver->user_id;
        $receiver_log->sender_user_id = Auth::user()->id;
        $receiver_log->status = 'SUCCESSFUL';
        $receiver_log->begin_balance = $receiver->balance;
        $receiver_log->amount = $request->amount;
        $receiver_log->end_balance  = $receiver->balance + $request->amount;
        $receiver_log->save();

        $sender->balance = $remaining_balance;
        $sender->save();

        $receiver->balance = $receiver->balance + $request->amount;
        $receiver->save();

        //mail to sender
        $details = [
            'title' => 'ChiWallet Transaction Update',
            'body' => 'You have successfully sent money $' . $request->amount . ' to ' . $receiver->lastname . ' ' . $receiver->firstname . '. Your remaining account balance is $' . $remaining_balance
        ];

        \Mail::to(Auth::user()->email)->send(new \App\Mail\TransactionMail($details));

        //mail to receiver
        $rdetails = [
            'title' => 'ChiWallet Transaction Update',
            'body' => 'You have received money $' . $request->amount . ' from ' . $sender->lastname . ' ' . $sender->firstname . '. Your new account balance is $' . $receiver->balance + $request->amount
        ];
        $recAcc = User::where('id', $receiver->user_id)->first();
        \Mail::to($recAcc->email)->send(new \App\Mail\TransactionMail($rdetails));

        return redirect()->route('dashboard')->with('success', 'successfully sent money to ' . $receiver->lastname . ' ' . $receiver->firstname . ' amount $' . $request->amount);
    }
}
