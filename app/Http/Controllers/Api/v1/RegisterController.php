<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\Assistant;
use App\Models\Doctor;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'phone' => ['required', 'min:11', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {

        $this->validate($request, [
            'otp' => 'required|string',
        ]);

        $input_otp = $request->input('otp');
        $otp_hash = session('otp');

        if (Hash::check($input_otp, $otp_hash)) {

            return redirect()->route('manage_doctors.index');
            $user = session('user');
            $user->name = $request->input('name');
            $user->email = $request->input('email') ?? NULL;
            $user->password = $request->input('password');
            $user->save();
            $request->session()->flash('status', 'Task was successful!');
            Auth::loginUsingId($user->id);

            if ($user->role == "DOCTOR") {

                $doctor = new Doctor();
                $doctor->name = $user->name;
                $doctor->user_id = $user->id;
                $doctor->save();


                $doctor = User::find($request->user_id);
                $role = Role::findOrCreate('DOCTOR');
                $permission = Permission::findOrCreate('doctor-can');
                $role->givePermissionTo($permission);
                $user->assignRole($role);
                return redirect('/dashboard');
            } else {

                $assistant = new Assistant();
                $assistant->name = $user->name;
                $assistant->email = $user->email;
                $assistant->phone = $user->phone;
                $assistant->user_id = $user->id;

                // Generating assistant Unique ID
                $ldate = date('ym');
                $last_digit = sprintf("%03d", $user->id);
                $sid = $ldate . $last_digit;
                $assistant->sid = $sid;
                $assistant->save();





                $assistant = User::find($request->user_id);
                $role = Role::findOrCreate('ASSISTANT');
                $permission = Permission::findOrCreate('assistant-can');

                $role->givePermissionTo($permission);
                $role->givePermissionTo('assistant-can');
                $user->assignRole($role);
                return redirect()->route('assistant_profile', auth()->user()->id);
            }
        } else {
            return back()->with('message', 'Sorry wrong OTP.');
        }
    }

    public function sendOtp(Request $request)
    {
        $this->validate($request, [
            'phone' => ['required', 'min:11', 'unique:users'],
        ]);

        $count = session('count');
        if (!$count) {
            $count = 0;
        }
        $count = $count + 1;
        session(['count' => $count]);
        if ($count > 2) {
            return redirect('/register');
        }

        $phone = $request->input('phone');
        $phone_code = substr($phone, 0, 3);
        if ($phone_code != "+88") {
            $contracts = "+88" . $phone;
        } else {
            $contracts = $phone;
        }
        $otp = mt_rand(100000, 999999);
        $otp_hash = Hash::make($otp);
        session(['otp' => $otp_hash]);
        $message = "Your OTP is: " . $otp . " - Smart DoctorZ";

        $smsResponse = Helper::sendSMS($contracts, $message);

        $user = new User();
        $user->phone = $phone;
        session(['user' => $user]);
        return view('auth.otp-verify');
    }

    public function OtpVerify(Request $request)
    {

        if (!session('otp')) {
            return redirect('/register');
        }
        return view('auth.otp-verify');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
}
