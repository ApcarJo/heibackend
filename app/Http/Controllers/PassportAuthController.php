<?php

// header('Access-Control-Allow-Origin', '*');

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


class PassportAuthController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'codename' => 'required|max:3',
            'password' => 'required|min:8',
        ]);
    

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'codename' => $request->codename,
            'password' => bcrypt($request->password)

        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }
    
    public function login (Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            // $user = auth()->user();
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user = auth()->user()->only(['email', 'name', 'id', 'isAdmin']);

            return response()->json(['token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
