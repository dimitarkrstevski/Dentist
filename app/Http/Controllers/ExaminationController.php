<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorId = Doctor::where('user_id', Auth::user()->id)->value('id');
        $doctorsAppointmentsIds = DB::table('appointments', 'a')
                    ->select('a.id')
                    ->where('a.doctor_id', $doctorId)->pluck('a.id')->toArray();


        $examinations = DB::table('examinations', 'e')
                        ->select('e.appointment_id', 'u.name', 'u.surname', 'e.created_at', 'a.doctor_id')
                        ->join('appointments AS a', 'a.id', '=', 'e.appointment_id')
                        ->join('users AS u', 'u.id', '=', 'a.patient_id')
                        ->whereIn('e.appointment_id', $doctorsAppointmentsIds)->get();

        return view('examination.index', compact('examinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        return view('examination.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Examination::create([
            'appointment_id' => $request->appointment_id,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Examination created');

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
    public function update(Request $request, Examination $examination)
    {
        $input = $request->all();
        $examination->fill($input)->save();
        return back()->with('message', 'Record Successfully Updated!');
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
}
