<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCode;
use App\Services\MelipayamakService;
use Illuminate\Http\Request;

class ResetPasswordByMobileController extends Controller
{
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
       $mobile = $request->mobile;
       $user = User::query()->where('mobile', $mobile)->first();
       if($user){
             $code = random_int(1111, 9999);
             UserCode::query()->create([
                'mobile' => $mobile,
                 'code' => $code,
             ]);
             // send sms
            //  MelipayamakService::sendSMS($mobile, $code);
           return view('auth.update-password', compact('mobile'));
       }else{

       }
    }


}
