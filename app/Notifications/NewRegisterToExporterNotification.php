<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewRegisterToExporterNotification extends Notification
{
    use Queueable;

    private $password = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
            ->subject('skerlingo | Registration request')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("Thanks for your interest in joingning skerlingo.ma as a Moroccan Exporter.")
            ->line("By joining skerlingo.ma you will : ")
            ->line("- Recieve Requests for quotations from international importers.")
            ->line("- Publish your products and services to the Moroccan Exporters Catalog.")
            ->line("- Participate in the B2B meetings with worldwide importers to open and penetrate new markets.")
            ->line('We received your request and a team member will contact you asap to approve your registration and start receiving your first requests for quotations.');
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
