<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

use App\Mail\ForgetMail;
use Carbon\Carbon;


class ResetController extends Controller
{
    public function reset(ResetRequest $resetRequest){
        $email=$resetRequest->email;
        $token=$resetRequest->token;
        $password=Hash::make($resetRequest->password);

        $emailcheck=DB::table('password_reset_tokens')->where('email',$email)->first();
        $pincheck=DB::table('password_reset_tokens')->where('token',$token)->first();

        if (!$emailcheck){

            return response([
                'message'=>"Email Not Found"
            ],401);
        }

        if (!$pincheck){

            return response([
                'message'=>"Pin code Invalid "
            ],401);
        }
        DB::table('users')->where('email',$email)->update(['password' => $password]);
        DB::table('password_reset_tokens')->where('email',$email)->delete();

            return response([
                'message'=>"Password  change succefully "
            ],200);




    }
}
