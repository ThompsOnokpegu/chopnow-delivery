<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendPasswordResetLink extends Notification
{
    use Queueable;
    private $message;
    private $actionURL;
    private $name;
    /**
     * Create a new notification instance.
     */
    public function __construct($msg,$url,$name)
    {
        $this->message = $msg;
        $this->actionURL = $url;
        $this->name = $name;
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
        return (new MailMessage)
                    ->subject('Password Reset')
                    ->from('notice@chopnow.com', 'ChopNow')
                    ->greeting('Hello '.$this->name.',')
                    ->line($this->message)
                    ->action('Reset Password', $this->actionURL);
                    
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
