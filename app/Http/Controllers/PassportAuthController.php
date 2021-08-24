<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\User;
use Illuminate\Http\Request;

class PassportAuthController extends Controller
{
=======
use Illuminate\Http\Request;
use App\Models\technicalguarantee;

class PassportAuthController extends Controller
{
    //
>>>>>>> a68707ee392ef11f8f1d8f47c993ca1864b378af

    public function register(Request $request)
    {
        $this->validate($request, [
<<<<<<< HEAD
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
    
=======
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
    

        $tg = technicalguarantee::create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $tg->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

>>>>>>> a68707ee392ef11f8f1d8f47c993ca1864b378af
    public function login (Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
<<<<<<< HEAD
            // $user = auth()->user();
            $user = auth()->user()->only(['email', 'name', 'id', 'isAdmin']);
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;

            return response()->json(['token' => $token, 'user' => $user], 200);
=======
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
>>>>>>> a68707ee392ef11f8f1d8f47c993ca1864b378af
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> a68707ee392ef11f8f1d8f47c993ca1864b378af
