<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\DoctorService;
use Illuminate\Http\Request;
use App\Http\Resources\DoctorServiceResource;


class DoctorServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DoctorServiceResource(DoctorService::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'fees',
        //     'effective_date',
        //     'expiry_date',
        //     'status',
        //     'tenant_id',
        //     'service_id',
        //     'user_id'  
        // ]);

        $doctorService = DoctorService::create([
            'fees'=>$request->fees,
            'effective_date'=>$request->effective_date,
            'expiry_date'=>$request->expiry_date,
            'status'=>$request->status,
            'tenant_id'=>$request->tenant_id,
            'service_id'=>$request->service_id,
            'user_id'=>$request->user_id  
        ]);

        return new DoctorServiceResource($doctorService);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorService  $doctorService
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorService $doctorService)
    {
        return new DoctorServiceResource($doctorService);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoctorService  $doctorService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorService $doctorService)
    {
        $doctorService->fees= $request->fees;
        $doctorService->effective_date= $request->effective_date;
        $doctorService->expiry_date= $request->expiry_date;
        $doctorService->status= $request->status;
        $doctorService->tenant_id= $request->tenant_id;
        $doctorService->service_id= $request->service_id;
        $doctorService->user_id= $request->user_id;  

        $doctorService->save();

        return new DoctorServiceResource($doctorService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorService  $doctorService
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorService $doctorService)
    {
        $doctorService->delete();
        return response()->json('Deleted Successfully', 200);
    }
}
