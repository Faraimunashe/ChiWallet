<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        return view('user.deposit');
    }
    public function deposit(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10|starts_with:07',
            'amount' => 'required|numeric'
        ]);

        if ($request->amount <= 5) {
            return redirect()->back()->with('error', 'Amount must be greater than 5 rtgs');
        }

        $myacc = Account::where('user_id', Auth::user()->id)->first();

        //$startingBalance = $account->amount;
        $wallet = "ecocash";

        //get all data ready
        $email = Auth::user()->email;
        $phone = $request->phone;
        $amount = $request->amount;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-deposit-money'),
            route('user-deposit-money'),
        );

        // Create Payments
        $invoice_name = "chiwallet" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("My chiwallet deposit", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //deposit
                    $stts = 'PENDING';
                    if ($info['status'] == 'paid') {
                        $stts = 'SUCCESSFUL';
                    }
                    $sender_log = new Transaction();
                    $sender_log->action = 'DEPOSIT';
                    $sender_log->user_id = Auth::user()->id;
                    $sender_log->sender_user_id = Auth::user()->id;
                    $sender_log->status = $stts;
                    $sender_log->begin_balance = $myacc->balance;
                    $sender_log->amount = $request->amount;
                    $sender_log->end_balance  = $myacc->balance + $info['amount'];
                    $sender_log->reference = $info['paynowreference'];
                    $sender_log->save();

                    //update balance
                    $myacc->balance = $myacc->balance + $info['amount'];
                    $myacc->save();

                    //mail to depositing account
                    $details = [
                        'title' => 'ChiWallet Transaction Update',
                        'body' => 'You have successfully deposited money $' . $info['amount'] . ' to your account ' . $myacc->accnum . '. Your new account balance is $' . $myacc->balance + $info['amount']
                    ];

                    \Mail::to(Auth::user()->email)->send(new \App\Mail\TransactionMail($details));

                    return redirect()->route('dashboard')->with('success', 'you have successfully deposited money to your account');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();


                    $deposit_log = new Transaction();
                    $deposit_log->action = 'DEPOSIT';
                    $deposit_log->user_id = Auth::user()->id;
                    $deposit_log->sender_user_id = Auth::user()->id;
                    $deposit_log->status = $info['status'];
                    $deposit_log->begin_balance = $myacc->balance;
                    $deposit_log->amount = $request->amount;
                    $deposit_log->end_balance  = $myacc->balance;
                    $deposit_log->reference = $info['paynowreference'];
                    $deposit_log->save();

                    return redirect()->route('dashboard')->with('warning', 'Please wait a moment and refresh page transaction still processing');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->route('dashboard')->with('error', 'We could not perform your request at the moment');
    }
}
