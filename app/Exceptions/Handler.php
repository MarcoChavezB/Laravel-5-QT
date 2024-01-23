<?php

namespace App\Exceptions;
use App\Notifications\SlackNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            Log::error("Error: " . $exception->getMessage());
    
            $message = "Error en el servidor:\n\n"
                . "Mensaje: " . $exception->getMessage() . "\n"
                . "Archivo: " . $exception->getFile() . "\n"
                . "Línea: " . $exception->getLine();
    
            Notification::route('slack', env('SLACK_WEBHOOK_URL'))
                ->notify(new SlackNotification($message));
        }    
        parent::report($exception);
    }
    
    
}
