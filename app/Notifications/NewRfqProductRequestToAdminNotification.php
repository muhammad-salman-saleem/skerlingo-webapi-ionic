<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRfqProductRequestToAdminNotification extends Notification
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

        $link = url("app/rfqs?product=p&statut=1");
        return (new MailMessage)
            ->subject('skerlingo | RFQ for ' . $this->rfq->produit->label)
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("You have a new Request For Quotation for : <b>" . $this->rfq->produit->label . '</b> from the Importer : <b>' . $this->rfq->importer->company . '</b> based in <b>' . $this->rfq->pays->label . '</b>')
            ->line("You can manage this RFQ on the following link :")
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
