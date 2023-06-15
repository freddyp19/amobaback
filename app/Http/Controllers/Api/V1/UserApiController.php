<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserApiController extends Controller
{
    public function loginApi(Request $request)
    {
        //dd($request->all());
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            $myapptoken = Str::random(80);
            $token = Auth::user()->createToken($myapptoken)->plainTextToken;
            //dd($token);
            session()->put('token', $token);
            return response()->json(["success"=>true,"token"=>$token,"message"=>""],200);
        }
        return response()->json(["success"=>false,"token"=>"","message"=>"Usuario y/o contraseña inválido"], 200);
    }
}
