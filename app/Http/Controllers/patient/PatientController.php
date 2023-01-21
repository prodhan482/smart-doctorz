<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PatientController extends Controller
{
    //

    public function index()
    {

        $patients = Patient::orderBy('id', 'DESC')->get();
        // dd($patients);
        return view('tenant.manage_patients.manage_patients_index', [
            'patients' => $patients,
            
        ]);
    }

    public function create()
    {

        $patients = Patient::orderBy('id', 'DESC')->get();
        $tenants = Tenant::orderBy('id', 'DESC')->get();

        // dd($patients);
        return view('tenant.manage_patients.manage_create_patients', [
            'patients' => $patients,
            'tenants' => $tenants,
            
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
        $user->role = $request->role;
        $user->save();
        $role = Role::findOrCreate('patient');
        $input += ['user_id' => $user->name];
        // dd($input);

        $patient = new Patient();
        $patient->user_id = $user->id;
        $patient->tenant_id = $request->tenant_id;
        $patient->gender = $request->gender;
        $patient->blood_group = $request->blood_group;
        $patient->dob = $request->dob;
        $patient->save();
       
        $permission = Permission::findOrCreate('patient-can');
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        return redirect()->route('manage_patients.index')->with('success','patient created successfully');
    }
}
