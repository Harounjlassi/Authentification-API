<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\User;
use DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Requests\RegisterRequest;
class Authcontroller extends Controller
{
    public function Login(Request $request){
        Try{
            if(Auth::attempt($request->only('email','password'))){
                
                    
                $user=Auth::user();
                $token=$user->createToken('app')->accessToken;
                return response([
                    'message'=>"successfuly login",
                    'token'=>$token,
                    'user'=>$user


                ],200);
            }





        }catch(Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);

        }
        return response([
            'message'=>"Invalid Email OR password"
        ],401);


    }
    public function Register(RegisterRequest $registerRequest){
        try{

            $user=User::create([
                'name'=>$registerRequest->name,
                'password'=>Hash::make($registerRequest->password),
                'email'=>$registerRequest->email,
              
            ]);
            $token=$user->createToken('app')->accessToken;
            return response([
                'message'=>"successfuly regestration ",
                'token'=>$token,
                'user'=>$user


            ],200);


        }catch(Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);

        }




    }
}
