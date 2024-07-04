<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DirectRfqApprovedToImporterNotification extends Notification
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
            ->subject('skerlingo | ' . $this->rfq->sujet . ' approved')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("Your request for quotation <b>" . $this->rfq->sujet . '</b> was approved by skerlingo Team.')
            ->line("We will shared it with the verified Moroccan Exporters and you will be notified when you will get proposals.")
            ->line("You can check your RFQ on :")
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
