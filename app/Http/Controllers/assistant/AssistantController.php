<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AssistantController extends Controller
{
    //

    public function index()
    {

        $assistants = Assistant::orderBy('id', 'DESC')->get();
        // dd($assistants);
        return view('admin.manage_assistants.manage_assistant_index', [
            'assistants' => $assistants,
            
        ]);
    }

    public function create()
    {

        $assistants = Assistant::orderBy('id', 'DESC')->get();
        $tenants = Tenant::orderBy('id', 'DESC')->get();

        // dd($assistants);
        return view('admin.manage_assistants.manage_create_assistants', [
            'assistants' => $assistants,
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
        $role = Role::findOrCreate('ASSISTANT');
        $input += ['user_id' => $user->name];
        // dd($input);

        $assistant = new Assistant();
        $assistant->user_id = $user->id;
        $assistant->tenant_id = $request->tenant_id;
        $assistant->gender = $request->gender;
        // $assistant->experience = $request->experience;
        $assistant->save();
       
        $permission = Permission::findOrCreate('assistant-can');
        $role->givePermissionTo($permission);
        $user->assignRole($role);

        return redirect()->route('manage_assistants.index')->with('success','assistant created successfully');
    }
}
