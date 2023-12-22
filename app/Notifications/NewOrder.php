<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrder extends Notification
{
    use Queueable;
    private $message;
    /**
     * Create a new notification instance.
     */
    public function __construct($msg)
    {
        $this->message = $msg;
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
                    ->subject('New Order')
                    ->from('chop@choppingz.com', 'Choppingz Food Ordering')
                    ->greeting('Hello,')
                    ->line('New order #'.$this->message.' on your store')
                    ->action('View in dashboard', url('/vendor/dashboard'))
                    ->line('Thank you for using Choppingz!');
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
