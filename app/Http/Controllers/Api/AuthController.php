<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registro(Request $request){

        $validar = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validar->fails()){
            return response()->json($validar->errors());
        }

        $usuario = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'data'=>$usuario, 
                'access_token'=>$token,
                'token_type'=>'Bearer',
            ]);
    }

    public function login(Request $request){

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()
                    ->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $usuario = User::where('email', request('email'))->firstOrFail();
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=> 'Hi '.$usuario->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user'=>$usuario,
        ]);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Saliste de sesión'
        ];

    }

}
