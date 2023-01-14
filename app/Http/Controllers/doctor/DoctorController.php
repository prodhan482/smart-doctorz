<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class DoctorController extends Controller
{
    //

    public function index()
    {

        $doctor = Doctor::orderBy('id', 'DESC')->get();
        return view('admin.manage_doctors.manage_add_doctors', [
            'doctor' => $doctor,
            
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required',
        ]);

        $input = $request->all();
        $user = User::create($input);
        // $role = Role::findOrCreate('DONOR');
        $input += ['user_id' => $user->name];
        // dd($input);

        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->chamber_id = $request->chamber_id;
        $doctor->chamber_name = $request->chamber_name;
        $doctor->gender = $request->gender;
        $doctor->education = $request->education;
        $doctor->experience = $request->experience;
        $doctor->save();
       
        // $permission = Permission::findOrCreate('student-profile-show');
        // $role->givePermissionTo($permission);
        // $user->assignRole($role);

        return redirect()->route('manage_doctors.index')->with('success','Doctor created successfully');
    }
}
