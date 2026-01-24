<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\forgotPasswordRequset;
use App\Http\Requests\Login\LoginRequset;
use App\Http\Requests\Login\ResetpasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function Login(LoginRequset $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->plainTextToken;

        if (!$user->is_verified) {
            return response()->json(['message' => 'Account not verified'], 403);
        }
        return response()->json([
            'message' => 'Login successfully.',
            'access_token' => $token,
        ], 200);
    }

    public function forgotPassword(ForgotPasswordRequset $request)
    {
        $data = $request->validated();

        if ($data['otp'] !== '1234') {
            return response()->json([ 'message' => 'OTP incorrect', ], 400);
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $user->update([
            'password' => bcrypt($data['password'])
        ]);
        return response()->json([
            'message' => 'OTP sent (use 1234)'
        ]);

    }

    public function resetpassword(ResetpasswordRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($data['otp'] !== '1234') {
            return response()->json([
                'message' => 'OTP incorrect',
                ], 400);
        }

        $user->update([
            'password' => bcrypt($data['password'])
        ]);

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successfully',
        ], 200);
    }



}
