<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountdownController extends Controller
{
    // Menyetel countdown (30 menit)
    public function setCountdown(Request $request)
    {
        // Jika session sudah ada, jangan ubah
        if (!session()->has('countdown_time')) {
            $countdownTime = 30 * 60;  // 30 menit dalam detik
            session(['countdown_time' => $countdownTime]);
        }

        return response()->json([
            'message' => 'Countdown started.',
            'time' => session('countdown_time')
        ]);
    }

    // Mengambil waktu countdown yang tersisa
    public function getCountdown()
    {
        $remainingTime = session('countdown_time', 0); // Ambil countdown waktu, default ke 0 jika tidak ada

        return response()->json([
            'remainingTime' => $remainingTime
        ]);
    }
}
