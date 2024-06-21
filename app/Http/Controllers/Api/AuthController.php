<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole('customer');

            Customer::create([
                'user_id' => $user->id,
            ]);

            DB::commit();

            return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create account. Please try again.'], 500);
        }
    }
}
