<?php
namespace App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Controller;
use App\Http\Requests\Register\OtpRegisterRequest;
use App\Http\Requests\Register\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile' => $data['mobile'],
            'is_verified' => false,
        ]);

        return response()->json([
            'message' => 'OTP sent successfully.',
        ]);
    }

    public function otpRegister(OtpRegisterRequest $request)
    {
        $data = $request->validated();

        if ($request->otp !== '1234') {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update(['is_verified' => true]);

        return response()->json([
            'message' => 'Account verified successfully. Please login.'
        ]);
    }



}
