<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Paynowlog;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\Auth;

class PollPaynow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poll:paynow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to poll the paynow url with an undone status code, to see if the transactions were completed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$client = new Http();
        $transaction = Paynowlog::where('status', 'Sent')->get();

        if (is_null($transaction)) {
            echo 'nothing in the paynow log';
        }

        //loop through the paynow transactions and perform updates
        foreach ($transaction as $item) {

            try {

                $result = Http::get($item->poll_url);

                //get response code
                $status_code = $result->status();
                if ($status_code == 200) {
                    $payload = $result->body();

                    $values = array();

                    $nv_strings = explode('&', $payload);
                    foreach ($nv_strings as $s) {
                        $nv = explode('=', $s, 2);
                        $name = urldecode($nv[0]);
                        $value = (isset($nv[1]) ? urldecode($nv[1]) : null);
                        $values[$name] = $value;
                    }

                    //$itemdata = json_encode($values);
                    $One_transaction = Transaction::where('reference', $values['paynowreference'])->first();

                    $new_balance = $One_transaction->start_balance + $values['amount'];

                    if (!is_null($One_transaction)) {
                        //check db tables [balances, paynowlogs]
                        $acc = Account::where('user_id', $One_transaction->user_id)->first();

                        //check poll status
                        if ($values['status'] == 'Paid') {
                            //update balance table
                            $acc->amount = $acc->balance + $values['amount'];
                            $acc->save();

                            //update logs
                            $One_transaction->end_balance = $new_balance;
                            $One_transaction->status = "SUCCESSFUL";
                            $One_transaction->save();

                            //mail to depositing account
                            $details = [
                                'title' => 'ChiWallet Transaction Update',
                                'body' => 'You have successfully deposited money $' . $values['amount'] . ' to your account ' . $acc->accnum . '. Your new account balance is $' . $acc->balance + $values['amount']
                            ];

                            \Mail::to(Auth::user()->email)->send(new \App\Mail\TransactionMail($details));
                        } else {

                            //if poll status not paid
                            $One_transaction->status = $values['status'];
                            $One_transaction->save();
                        }
                    }

                    // update paynow table
                    $paynow = Paynowlog::find($item->id);
                    $paynow->status = $values['status'];
                    $paynow->save();
                    //echo $values['status'];
                    //echo $itemdata['status'];

                    echo 'Settled transactions successfully';
                }
            } catch (Exception $e) {
                echo $e;
            }

            //bad request error
        }

        echo 'this is my first basic scheduler';
    }
}
