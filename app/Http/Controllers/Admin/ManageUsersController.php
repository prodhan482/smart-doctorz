<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tenant;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('admin.manage_users.manage_users_index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.manage_users.manage_users_create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('manage_users.index')
            ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.manage_users.manage_users_show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        $tenants = Tenant::all();
        $tenant_id = $user->tenant_id;


        // dd($tenants);   



        return view('admin.manage_users.manage_users_edit',compact('user','roles','userRole','tenants','tenant_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'email|unique:users,email,'.$id,
            'phone' => 'required|numeric|unique:users,phone,'.$id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required',
            // 'tenant_id' => 'required'
        ]);

        $input = $request->all();

        // dd($input);
        if(empty($input['password'])){
            $input = Arr::except($input,array('password'));
        }

        // $input = $request->tenant;


        $user = User::find($id);
        $user->tenant_id = $request->tenant_id;
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('manage_users.index')
            ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('manage_users.index')
            ->with('success','User deleted successfully');
    }
}
