<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendCodeNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $code;
    public function __construct()
    {
        $this->code = new Otp;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $code = $this->code->generate($notifiable->email, 'numeric', 5, 40);
        echo $code->token;
        return (new MailMessage)
            ->greeting('Otp Code')
            ->line('Verify Your Code...')
            ->line('code: ' . $code->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
