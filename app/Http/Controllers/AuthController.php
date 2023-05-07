<?php

// namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //

    public function showLogin()
    {
        return response()->view('Auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string',
            'remember' => 'required|boolean'
        ]);

        if (!$validator->fails()) {
            // $feedback = Feedback::where('email', '=', $request->input('email'))->first();
            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard('supervisor')->attempt($credentials, $request->input('remember'))) {
                return response()->json(['message' => 'Logged in successfully'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'Login failed, check email or password'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('supervisor')->logout();
        $request->session()->invalidate();
        return redirect()->guest(route('ucas.login'));
    }
}
