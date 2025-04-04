<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Loan;
use App\Models\User;

class NewLoan extends Notification
{
    use Queueable;

    private string $userName;

    /**
     * Create a new notification instance.
     */
    public function __construct(Loan $newLoan)
    {
        $user = User::find($newLoan->user_id);
        $this->userName = $user->name;
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
                    ->greeting('NEW LOAN')
                    ->line('New loan from ' . $this->userName)
                    ->line('The introduction to the notification.')
                    ->action('Check Loan', url(env('APP_URL') . '/loans/list'))
                    ->line('Thank you for using our application!');
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
