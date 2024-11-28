<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotify extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];


    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'contact_title' => $this->contact->title,
            'user_name' => $this->contact->name,
            'date' => date('Y-m-d  h:m a'),
            'link' => route('admin.contact.show', $this->contact->id),

        ];
    }
        //for customize broadcast
        public function broadcastType(): string
        {
            return 'NewContactNotify';
        }
        //for customize database

        public function databaseType(object $notifiable): string
        {
            return 'NewContactNotify';
        }
          //customize rename channels
    /**
     * The channels the admin receives notification broadcasts on.
     */


}
