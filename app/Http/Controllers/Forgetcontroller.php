<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgetRequest;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

use App\Mail\ForgetMail;
use Carbon\Carbon;

class ForgetController extends Controller
{
    public function ForgetPassword(ForgetRequest $resetRequest)
    {
        $email = $resetRequest->email;

        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'Invalid Email'
            ], 401);
        }

        // Generate random token
        $token = rand(10, 1000000);

        try {
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at'=>Carbon::now()
            ]);

            // Mail send to user
            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message' => 'Reset password email sent to your mail'
            ], 200);

        }catch(Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);

        }

    }
}

