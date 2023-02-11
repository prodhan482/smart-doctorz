<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TenantResource(Tenant::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'address'=>['required', 'max:255'],
            'phone_number'=>['required', 'max:255'],
            'web_url'=>['max:255'],
            'description'=>['max:255'],
        ]);

        $tenant = Tenant::create([
            'name'=> $request->name,
            'address'=> $request->address,
            'phone_number'=> $request->phone_number,
            'web_url'=> $request->web_url,
            'description'=>$request->description
        ]);

        return new TenantResource($tenant);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return new TenantResource($tenant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'name'=>['required', 'max:255'],
            'address'=>['required', 'max:255'],
            'phone_number'=>['required', 'max:255'],
            'web_url'=>['max:255'],
            'description'=>['max:255'],
        ]);

        $tenant->name = $request->name;
        $tenant->address = $request->address;
        $tenant->phone_number = $request->name;
        $tenant->web_url = $request->web_url;
        $tenant->description = $request->description;

        $tenant->save();

        return new TenantResource($tenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
