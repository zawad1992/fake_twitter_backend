<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    
    /**
     * Constructor
     *
     * Initialize the controller by applying the 'auth:api' middleware.
     * This middleware restricts access to certain controller methods,
     * allowing only authenticated users to access them.
     */

    
    /**
     * Login
     *
     * Authenticate a user based on email and password. If authentication is
     * successful, generate a JWT (JSON Web Token) for the user. This token
     * is then returned as part of the response in JSON format along with
     * the user's details. This token is essential for accessing protected routes.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function login(LoginRequest $request)
    {
        try {
           
            $credentials = $request->only('email', 'password');
    
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }
    
            $user = Auth::user();
            return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    /**
     * Register
     *
     * Create a new user record in the database. Upon successful creation,
     * the user is automatically logged in, and a JWT token is generated.
     * This token, along with the user's details, is returned in the response.
     * The token can be used for subsequent requests to authenticated routes.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function register(RegisterRequest $request){
        try {
           
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            $token = Auth::login($user);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    /**
     * Logout
     *
     * Invalidate the current user's JWT token to log them out. This ensures
     * that the token cannot be used for further requests.
     *
     * @return JsonResponse
     */

    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    /**
     * Refresh
     *
     * Invalidate the current user's JWT token and generate a new one.
     * This method can be used for renewing a token to maintain a user's
     * authenticated session.
     *
     * @return JsonResponse
     */

    public function refresh()
    {
        try {
            $token = Auth::refresh();
            return response()->json([
                'status' => 'success',
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
}
