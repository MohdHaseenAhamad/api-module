<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        # code...
        $validator = validator::make($request->all(), [
            'name' => ['required', 'min:2', 'max:100'],
            'email' => ['required', 'unique:users', 'max:100'],
            'password'=>['reqired','min:6','string'],
        ]);  /*Add User Information Validation*/
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>$validator->errors()
            ]);
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json([
            'status'=>200,
            'message'=>"User register Successfully",
            'data'=>$user
        ]);
    }
    public function login(Request $request)
    {
        # code...
        $validator = validator::make($request->all(), [
            'email' => ['required', 'unique:users', 'max:100' ],
            'password'=>['required','min:6','string'],
        ]);  /*Add User Information Validation*/
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'message'=>$validator->errors()
            ]);
        }
        $dataAttempt = array(
            'email' => $request->email,
            'password' => Hash::make($request->password)
        );
        $token =Auth::attempt($dataAttempt);
        if (!$token)
        {
            return response()->json([
                'status'=>400,
                'message'=>$token,
            ]);
        }
        return $this->responsedWithToken($token);
    }
    protected function responsedWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            //'expires_in' => auth()->factory()->getTTL() * 60
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
