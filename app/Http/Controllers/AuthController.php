<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function checker()
    {
        return view('test');
    }

    public function registerPost(RegisterRequest $request)
    {
        $user_id = Str::random(16);
        $user_fullname = $request->first_name . ' ' . $request->last_name;

        $data = [
            'user_id' => $user_id,
            'user_nama' => $user_fullname,
            'user_alamat' => $request->address,
            'user_username' => $request->username,
            'user_email' => $request->email,
            'user_notelp' => $request->phone,
            'user_password' => bcrypt($request->password),
            'level' => 'anggota',
        ];

        $user = User::register($data);

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        return "fail";
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = [
            'user_username' => $request->username,
            'user_password' => $request->password
        ];

        $user = User::where('user_username', $credentials['user_username'])->first();

        if ($user && Hash::check($credentials['user_password'], $user->user_password)) {
            Auth::login($user);

            // Debugging Time!: https://stackoverflow.com/questions/21603347/laravel-authattempt-will-not-persist-login (Lihat model `User`)
            // return 'User logged in: ' . $user->user_username;

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'message' => 'Username atau password Anda salah.',
            ]);
        }
    }
}
