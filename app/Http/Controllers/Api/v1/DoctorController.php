<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $doctors = Doctor::orderBy('id', 'DESC')->get();
        // dd($doctors);
        return view('admin.manage_doctors.manage_doctor_index', [
            'doctors' => $doctors,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $doctors = Doctor::orderBy('id', 'DESC')->get();
        $tenants = Tenant::orderBy('id', 'DESC')->get();

        // dd($doctors);
        return view('admin.manage_doctors.manage_add_doctors', [
            'doctors' => $doctors,
            'tenants' => $tenants,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $user->role = $request->role;
        $user->save();
        $role = Role::findOrCreate('DOCTOR');
        $input += ['user_id' => $user->name];
        // dd($input);

        $doctor = new Doctor();
        $doctor->user_id = $user->id;
        $doctor->tenant_id = $request->tenant_id;
        $doctor->category = $request->category;
        $doctor->gender = $request->gender;
        $doctor->education = $request->education;
        $doctor->experience = $request->experience;
        $doctor->save();

        $permission = Permission::findOrCreate('doctor-can');
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        return redirect()->route('manage_doctors.index')->with('success', 'Doctor created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
