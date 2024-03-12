<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Helpers\ApiValidation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{

    /**
     * here authenticate of user
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            // $request->authenticate($credentials);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user instanceof User) {
                    $token = $user->createToken('api', ['role:user'])->plainTextToken;
                    $data['token'] = $token;
                    $data['user'] = $user;
                    return ApiResponse::withData($data);
                } else {
                    return  ApiValidation::invalidCredentials('The provided credentials are incorrect');
                }
            } else {
                return  ApiValidation::invalidCredentials('The provided credentials are incorrect');
            }
        } catch (\Exception $e) {
            return  ApiValidation::invalidCredentials($e->getMessage());
        }
    }
    /**
     * log out script
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponse::withSuccess('Successfully logged out');
    }
}
