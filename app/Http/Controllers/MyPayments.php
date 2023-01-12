<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyPayments extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // only for logged users
        $myPayments = DB::table('payments', 'p')
            ->select('p.created_at', 'p.price_payed', 'pa.user_id', 'u.name', 'u.surname', 'p.created_at')
            ->join('patients AS pa', 'pa.id', '=', 'p.patient_id')
            ->join('users AS u', 'u.id', '=', 'pa.user_id')
            ->where('pa.user_id', Auth::user()->id)
            ->orderBy('p.created_at', 'desc')
            ->get();

        $totalSum =  DB::table('payments', 'p')
            ->sum('p.price_payed');

        return view('payments.myPayments', compact('myPayments', 'totalSum'));
    }
}
