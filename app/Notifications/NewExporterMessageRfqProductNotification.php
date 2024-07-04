<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewExporterMessageRfqProductNotification extends Notification
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

        $link = url("app/rfqs/details?rcode=" . $this->rfq->code);
        return (new MailMessage)
            ->subject('skerlingo new message | ' . $this->rfq->produit->label)
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("Your received a new message about your RFQ for the product / service : <b>" . $this->rfq->produit->label . '</b> from <b>' . $this->rfq->entreprise->label . '</b>')
            ->line("You can check the message on the following link : ")
            ->action('Go to skerlingo', $link);
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
