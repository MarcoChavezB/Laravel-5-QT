<?php

namespace App\Http\Controllers;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification; 

use App\Models\Hotel;

class hotelsController extends Controller
{
    public function sendNotify($message){
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new SlackNotification($message));
    }

    public function indexJWT(){
        $this->sendNotify("Se mostraron todos los hoteles");
        return Hotel::all();
    }
}
