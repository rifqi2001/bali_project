<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Register(Request $R){
        try{
            $cred = new User();
            $cred->name = $R->name;
            $cred->email = $R->email;
            $cred->password = Hash::make($R->password);
            $cred->save();
            $response=['status' => 200, 'message' => 'Register Successfully! Welcome to Our Community'];
            return response()->json($response);
        }catch(Exception $e){
            $response = ['status'=>500, 'message' => $e];
        }
    }

    function Login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Temukan user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Periksa apakah user ditemukan dan password cocok
        if ($user && Hash::check($request->password, $user->password)) {
            // Buat token baru
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            // Kembalikan respon sukses dengan token dan data user
            return response()->json([
                'status' => 200,
                'token' => $token,
                'user' => $user,
                'message' => 'Successfully Login'
            ]);
        }

        // Jika user tidak ditemukan atau password salah
        return response()->json([
            'status' => 500,
            'message' => 'No account found with this email or Wrong email or password! please try again'
        ]);
    }

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'message' => 'Invalid login details'
    //         ], 401);
    //     }

    //     $user = Auth::user();
    //     $token = $user->createToken('authToken')->accessToken;

    //     return response()->json([
    //         'user' => $user,
    //         'token' => $token,
    //     ]);
    // }
}
