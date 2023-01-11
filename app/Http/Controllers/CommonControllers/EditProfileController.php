<?php

namespace App\Http\Controllers\CommonControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{
    public function index()
    {
        return view('common_views.edit_profile');
    }



    public function update_user_password(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'min:4',new MatchOldPassword],
            'new_password' => ['required','min:4'],
            'confirm_new_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> $request->new_password]);

        return back()->with('success', 'Password Updated Successfully');
    }


    public function update_user_other_info(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:14'],
        ]);




        $user_id = auth()->user()->id;
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');


        if(User::where('email',$email)->where('id','!=',$user_id)->exists())
            return redirect()->route('edit_user_profile')->with('error','Email Already Exists !!');

        if(User::where('phone',$phone)->where('id','!=',$user_id)->exists())
            return redirect()->route('edit_user_profile')->with('error','Phone Number Already Exists !!');



        $user = User::find($user_id);
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->save();

        return redirect()->route('edit_user_profile')->with('success','Information Updated Successfully !!');

    }
}
