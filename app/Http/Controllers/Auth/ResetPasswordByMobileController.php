<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCode;
use App\Services\MelipayamakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordByMobileController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendSMS(Request $request)
    {
        $request->validate([
            'mobile'=>'required|exists:users,mobile',
        ]);

         $mobile = $request->mobile;
         $code = random_int(1111, 9999);
         UserCode::query()->create([
            'mobile' => $mobile,
             'code' => $code,
         ]);
             // send sms
            //  MelipayamakService::sendSMS($mobile, $code);
        return redirect()->route('auth.reset_password',['mobile'=>$mobile]);

    }

    public function resetPassword($mobile)
    {
        return view('auth.update-password', compact('mobile'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'mobile'=>'required',
            'password'=>'required|min:8',
            'code'=>'required'
        ]);

        $mobile = $request->mobile;
        $code = $request->code;
        $password = $request->password;

        $user_code = UserCode::query()->where('mobile', $mobile)->where('code', $code)->first();
        if ($user_code) {
            $user = User::query()->where('mobile', $mobile)->first();
            $user->update([
                'password' => Hash::make($password),
                'mobile_verified_at' => now(),
            ]);
            return redirect()->route('login');
        }else{
            $request->session()->flash('message','کد نامعتبر است');
            return redirect()->route('auth.reset_password',['mobile'=>$mobile]);
        }
    }


}
