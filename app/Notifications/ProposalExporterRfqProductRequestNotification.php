<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProposalExporterRfqProductRequestNotification extends Notification
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

        $link = url("app/rfqs?product=p");
        return (new MailMessage)
            ->subject('skerlingo | New RFQ from ' . $this->rfq->pays->label)
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("You received a new request for quotation for your product / service <b>" . $this->rfq->produit->label . '</b> from <b>' . $this->rfq->pays->label . '</b>')
            ->line("Click on the following link to check the RFQ :")
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
