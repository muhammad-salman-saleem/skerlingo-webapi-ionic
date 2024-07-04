<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DirectRfqRefusedToImporterNotification extends Notification
{
    use Queueable;

    private $rfq = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rfq)
    {
        $this->rfq = $rfq;
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
            ->subject('skerlingo | ' . $this->rfq->sujet . ' rejected')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("Your request for quotation <b>" . $this->rfq->sujet . '</b> was rejected.')
            ->line("For more details about the statuts of your request, we invite you to email the support service at si@asmex.org");
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
