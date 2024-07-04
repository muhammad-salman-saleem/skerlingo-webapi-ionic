<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewImporterToAdminNotification extends Notification
{
    use Queueable;

    private $importer = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($importer)
    {
        $this->importer = $importer;
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

        $link = url("app/rfqs");
        return (new MailMessage)
            ->subject('skerlingo | New Importer Registration')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("a new Importer has registred in skerlingo <b>" . $this->importer->company . '</b> from <b>' . $this->importer->pays->label . '</b>');
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
