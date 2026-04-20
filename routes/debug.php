<?php

use Illuminate\Support\Facades\Route;

Route::get('/debug/otp/create', function () {
    $otp = \App\Models\OTP::createOrUpdateOTP('09123456789');
    return response()->json([
        'success' => true,
        'message' => 'OTP Created',
        'phone' => $otp->phone,
        'otp_code' => $otp->otp_code,
        'expires_at' => $otp->expires_at,
    ]);
});

Route::get('/debug/otp/list', function () {
    $otps = \App\Models\OTP::all();
    return response()->json($otps);
});

Route::post('/debug/otp/verify', function () {
    $phone = request('phone');
    $code = request('code');
    
    $otp = \App\Models\OTP::where('phone', $phone)->first();
    
    if (!$otp) {
        return response()->json(['error' => 'OTP not found'], 404);
    }
    
    if ($otp->isExpired()) {
        return response()->json(['error' => 'OTP expired'], 400);
    }
    
    if ($otp->hasExceededAttempts()) {
        return response()->json(['error' => 'Max attempts exceeded'], 400);
    }
    
    $match = trim($otp->otp_code) === trim($code);
    
    return response()->json([
        'stored_otp' => $otp->otp_code,
        'input_code' => $code,
        'match' => $match,
        'attempts' => $otp->attempts,
    ]);
});
