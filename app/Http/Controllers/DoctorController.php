<?php

namespace App\Http\Controllers;

use App\Events\MailToPatient;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Doctor::where('user_id', $id)->update(['short_bio' => $request->short_bio]);

        return redirect()->back()->with('success', 'Biography is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function choosePatient()
    {
        $appointments = Appointment::where('doctor_id', null)->paginate(5);

        return view('appointments.index', compact('appointments'));
    }


    public function selectPatient(Request $request, $id)
    {
        $doctorId = Doctor::where('user_id', Auth::user()->id)->value('id');
        Appointment::where('id', $id)->update(
            ['doctor_id' => $doctorId]
        );

        $patientId = Appointment::where('id', $id)->value('patient_id');
        $email = User::where('id', $patientId)->value('email');
        $doctorName = Auth::user()->name;
        $doctorSurname = Auth::user()->surname;
        $time = Appointment::where('id', $request->id)->value('time');
        $date = Appointment::where('id', $request->id)->value('date');

        event(new MailToPatient($email, $doctorName, $doctorSurname, $time, $date));

        return redirect()->back()->with('success', 'Appointment is taken');
    }
}
