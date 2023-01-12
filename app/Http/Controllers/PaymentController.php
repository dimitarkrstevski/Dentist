<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // za admini
        $payments = DB::table('payments', 'p')
                        ->select('p.created_at', 'p.price_payed', 'pa.user_id', 'u.name', 'u.surname')
                        ->join('patients AS pa', 'pa.id', '=', 'p.patient_id')
                        ->join('users AS u', 'u.id', '=', 'pa.user_id')->get();

        return view('payments.index', compact('payments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $EMBG = $request->EMBG; //pole od forma

        $user = User::where('EMBG', $EMBG)->value('id');

        $patient = Patient::where('user_id', $user)->value('id');

        Payment::create([
            'patient_id' => $patient,
            'price_payed' => $request->price_payed
        ]);

        return redirect()->back()->with('success', 'Payment is added');
    }

    public function getReport()
    {
        $fileName = 'payments_report.csv';

        $data = DB::table('payments', 'p')
            ->select('p.created_at', 'p.price_payed', 'pa.user_id', 'u.name', 'u.surname')
            ->join('patients AS pa', 'pa.id', '=', 'p.patient_id')
            ->join('users AS u', 'u.id', '=', 'pa.user_id')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Date', 'Patient Name', 'Patient Surname', 'Price');

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $d) {
                $row['Date']  = Carbon::parse($d->created_at)->format('d-m-Y');
                $row['Patient Name'] = $d->name;
                $row['Patient Surname'] = $d->surname;
                $row['Price'] = $d->price_payed;

                fputcsv($file, array($row['Date'], $row['Patient Name'], $row['Patient Surname'], $row['Price'],));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
