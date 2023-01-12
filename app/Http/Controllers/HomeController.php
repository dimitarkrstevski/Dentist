<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Payment;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 2) {

            $doctorId = Doctor::where('user_id', Auth::user()->id)->value('id');
            $data = DB::table('appointments', 'a')
                ->select('a.date',
                                'a.id',
                                'a.time', 'u.name', 'u.surname')
                ->join('users AS u', 'u.id', '=', 'a.patient_id')
                ->where('a.doctor_id', $doctorId)->get();
            return view('dashboard', compact('data'));
        }

        if (Auth::user()->role_id == 4) {
            $data = Price::all();

            return view('dashboard', compact('data'));
        }

        if (Auth::user()->role_id == 1) {

            $date = Carbon::now();

            $year = $date->year;
            $month = $date->month;
           $price = Payment::whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('price_payed');

            return view('dashboard', compact('price'));
        }



        return view('dashboard');

    }
}
