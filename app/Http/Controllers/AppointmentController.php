<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Examination;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::user()->id)
                                    ->orderBy('date', 'desc')->paginate(5);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Appointment::create([
            'patient_id' => Auth::user()->id,
            'date' => $request->date,
            'time' => Carbon::parse($request->time),
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Appointment created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::where('id', $id)->get();

        $patient = DB::table('patients', 'p')
                    ->select('p.health_id',
                    'u.name',
                    'u.surname',
                        'u.email',
                        'u.EMBG',
                        'u.phone_number'
                    )
                    ->join('users AS u', 'p.user_id', '=', 'u.id' )
                    ->where('p.user_id', $appointment[0]->patient_id)
                    ->get();


        $doctor = DB::table('doctors', 'd')
            ->select('d.short_bio',
                'u.name',
                'u.surname',
                'u.email',
                'u.EMBG',
                'u.phone_number'
            )
            ->join('users AS u', 'd.user_id', '=', 'u.id' )
            ->where('u.id', $appointment[0]->doctor_id)
            ->get();


        $hasExamination = Examination::where('appointment_id', $id)->count();

        $examinationDetails = Examination::where('appointment_id', $id)->value('description');


        if (Auth::user()->role_id == 2) {
            return view('appointments.show', compact('appointment', 'patient', 'hasExamination', 'examinationDetails'));
        } else {
            return view('appointments.userShow', compact('appointment', 'doctor', 'examinationDetails', 'hasExamination'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function edit($id)
//    {
//        $appointment = Appointment::find($id);
//
//        $doctors = Appointment::where('date', $appointment->date)
//            ->where('time', $appointment->time)
//            ->pluck('doctor_id');
//
//        if($doctors[0] == null) {
//            $doctorDetails = Doctor::join('users AS u', 'u.id', 'doctors.user_id')
//                ->select('u.name', 'u.surname', 'doctors.id')->get();
//        } else {
//            $doctorDetails = Doctor::whereNotIn('id', $doctors)->join('users AS u', 'u.id', 'doctors.user_id')
//                ->select('u.name', 'u.surname', 'doctors.id')->get();
//        }
//
//        return view('appointments.edit', compact('doctorDetails', 'appointment'));
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function update(Request $request, $id)
//    {
//        Appointment::where('id', $id)->update([
//            'doctor_id' => $request->doctor_id
//        ]);
//
//        return redirect()->route('myAppointments')
//            ->with('success', 'Doctor successfully added');
//
//    }

}
