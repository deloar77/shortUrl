<?php

namespace App\Http\Controllers\API\V1;
use App\Http\Controllers\Controller;
use App\Help\JWTToken;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    public function UserRegistration(Request $request){

        
        User::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ]);
        return response()->json([
            'status'=>"sucess",
            'message'=>"registration complete"
        ]);
    }
    public function UserLogin(Request $request){
       $user= User::where('email',$request->input('email'))
             ->where('password',$request->input('password'))
             ->first();
             if($user!==null){
                $token = $user->createToken('secretkey')->plainTextToken;

                
                return response()->json([
                    'status'=>"sucess",
                    'message'=>"login complete",
                    'token'=>$token
                ]);
             }
    }

    public function logout(Request $request){
       //auth()->user()->tokens()->delete();
    }
}
