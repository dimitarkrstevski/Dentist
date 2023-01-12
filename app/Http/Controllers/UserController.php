<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Comment\Doc;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $userId = Auth::id();

       $userInfo = User::with('role')->where('id', $userId)->get();

       return view('profile.my-profile', compact('userInfo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('profile.new-profile', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create( [
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'EMBG' => $request->EMBG,
            'phone_number' => $request->phone_number,
            'street' => $request->street,
            'city' => $request->city,
            'date_of_birth' => $request->date_of_birth,
            'role_id' => $request->role_id,
        ]);

        if ($user->role_id === '2') {
            Doctor::create([
                'user_id' => $user->id
            ]);
        }else if ($user->role_id === '4') {
            Patient::create([
                'user_id' => $user->id
            ]);
        }

        return redirect()->back()->with('success', 'Profile is created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userInfo = User::findOrFail($id);

        return view('profile.user-profile', compact('userInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $bio = '';
        $healthId = '';

        if($user->role_id === 2) {
            $bio = Doctor::where('user_id', $id)->value('short_bio');
        }

        if ($user->role_id === 4) {
            $healthId = Patient::where('user_id', $id)->value('health_id');
        }


        return view('profile.edit-profile', compact('user', 'bio', 'healthId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request,  $id)
    {
       User::where('id', $id)->update(
           [
               'name' => $request->name,
               'surname' => $request->surname,
               'email' => $request->email,
               'EMBG' => $request->EMBG,
               'phone_number' => $request->phone_number,
               'street' => $request->street,
               'city' => $request->city,
               'date_of_birth' => $request->date_of_birth
           ]
       );

        return redirect()->back()->with('success', 'Profile is updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::delete($id);
    }
}
