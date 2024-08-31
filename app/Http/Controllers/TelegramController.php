<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TelegramController extends Controller
{
    public function redirectToTelegram()
    {
        $botToken = env('TELEGRAM_BOT_TOKEN');
         $botUsername = 'SourngTECHBot'; // Replace this with your bot's username
        $telegramUrl = "https://t.me/{$botUsername}?start={$botToken}";
        // $telegramUrl = "https://t.me/your_bot_username";
        // dd($telegramUrl);
        return redirect($telegramUrl);
    }

    public function handleTelegramCallback(Request $request)
    {
        $telegramData = $request->input('tg_user'); // Assuming Telegram sends data as 'tg_user'

        if (!$telegramData) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Telegram.');
        }

        $telegramUser = json_decode($telegramData, true);
        // dd($telegramUser);
        $user = User::firstOrCreate(
            ['telegram_id' => $telegramUser['id']],
            ['username' => $telegramUser['username']]
        );

        Auth::login($user, true);

        return redirect()->intended('dashboard');
    }
}