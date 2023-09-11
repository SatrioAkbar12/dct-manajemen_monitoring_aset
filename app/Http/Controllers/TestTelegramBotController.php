<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NotificationChannels\Telegram\TelegramUpdates;

class TestTelegramBotController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:testTelegram.getUpdates');
    }

    public function getUpdates()
    {
        $updates = TelegramUpdates::create()->get();

        if($updates['ok']) {
            return dd($updates['result']);
        }
    }
}
