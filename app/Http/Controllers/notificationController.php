<?php

namespace App\Http\Controllers;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Notification; 
class notificationController extends Controller
{
    public function sendNotification()
    {
        $message = "Mensaje enviado desde Laravel";
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new SlackNotification($message));
        
        return "Notificación enviada a Slack";
    }

    public function testError()
    {
        $object = new \stdClass();
        $property = $object->undefinedProperty;
    }

}
