<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProposalExporterRfqDirectRequestNotification extends Notification
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

        $link = url("app/");
        return (new MailMessage)
            ->subject('skerlingo | New RFQ : ' . $this->rfq->sujet)
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("We received a new request for quotation <b>" . $this->rfq->sujet . '</b> from <b>' . $this->rfq->pays->label . '</b>')
            ->line("Click on the following link to check the RFQ :")
            ->action('Go to skerlingo', $link)
            ->line("** This RFQ is shared with all skerlingo members of your sector, be the first to answer the importer to Grow your chances to win a new order.");
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
