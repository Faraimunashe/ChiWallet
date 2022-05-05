<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class StatementController extends Controller
{
    public function index()
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)->get();
        return view('user.statement', [
            'transactions' => $transaction
        ]);
    }

    public function download()
    {
        $statement = Transaction::where('user_id', Auth::user()->id)->get();

        $pdf = PDF::loadView('pdf.statement', [
            'statement' => $statement
        ]);

        return $pdf->download(Auth::user()->name . '_statement.pdf');
    }
}
