<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationController extends Controller
{
    //
    public function notice()
    {
        return response()->view('auth.verify-notice');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification email sent'], Response::HTTP_OK);
    }

    public function verify(EmailVerificationRequest $request)
    {
        //
        $request->fulfill();
        return redirect()->route('ucas.starter');
    }
}
