<?php

namespace App\Http\Controllers\CommonControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{

    public function index()
    {
        return view('common_views.dashboard');
    }



    public function profile_photo_upload(Request $request)
    {
        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        //$image_name= time().'.png';
        $image_name = 'USER' . $request->user_id . '-' . time() . '.png';
        
        $folder_path = public_path('storage') . "/uploaded_photo/user_photo/";
        if(!File::isDirectory($folder_path)){
            File::makeDirectory($folder_path, 0777, true, true);
        }
        
        $path = public_path('storage') . "/uploaded_photo/user_photo/" . $image_name;


        if (!file_exists(storage_path().'/app/public/uploaded_photo/user_photo/')) {
            mkdir(storage_path().'/app/public/uploaded_photo/user_photo/', 0777, true);
        }

        file_put_contents($path, $data);
        $user = User::findOrFail($request->user_id);

        $photo = $user->photo_url;
        if ($photo)
        {
            $filename = public_path('storage') . $photo;
            File::delete($filename);
        }

        $user->photo_url = "/uploaded_photo/user_photo/" . $image_name;
        $user->save();


        return response()->json(['success' => 'done']);
    }
}
