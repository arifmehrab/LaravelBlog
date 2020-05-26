<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class authorPostApproved extends Notification implements ShouldQueue
{
    use Queueable;
    public $postApprove;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postApprove)
    {
        $this->postApprove = $postApprove;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Post Successfully Approved')
                    ->line('Hello '. $this->postApprove->user->name)
                    ->line('Your Post Successfully Approved.')
                    ->line('Post:- '. $this->postApprove->title)
                    ->line('If you want you can Share your post')
                    ->action('view Your post', url(route('author.post.index')))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
