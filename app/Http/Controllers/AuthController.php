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
            'password' => bcrypt($request->password),
            'level' => 'anggota',
        ];

        $user = User::register($data);

        if ($user) {
            $credentials = [
                'user_username' => $request->username,
                'password' => $request->password
            ];
            Auth::attempt($credentials);
            return redirect()->route('dashboard');
        }

        return "fail";
    }

    public function loginPost(LoginRequest $request)
    {
        $credentials = [
            'user_username' => $request->username,
            'password' => $request->password
        ];

        // Auth::login tidak bisa (akan melogin user ke user paling terbaru walaupun user ketemu, D:)
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level == "admin") {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'message' => 'Username atau password Anda salah.',
            ]);
        }
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->user_id;
        $level = Auth::user()->level;

        $data = [
            'user_nama' => $request->user_nama,
            'user_alamat' => $request->user_alamat,
            'user_username' => $request->user_username,
            'user_email' => $request->user_email,
            'user_notelp' => $request->user_notelp,
            'password' => bcrypt($request->password),
        ];

        User::where('user_id', $id)->update($data);

        if ($level == "admin") {
            return redirect()->route('admin.pengaturan', ['action' => 'show'])->with('success', 'Profil berhasil diupdate!');
        }

        return redirect()->route('pengaturan', ['action' => 'show'])->with('success', 'Profil berhasil diupdate!');
    }
}
