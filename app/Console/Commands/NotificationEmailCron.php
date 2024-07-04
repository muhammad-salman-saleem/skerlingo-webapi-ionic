<?php

namespace App\Console\Commands;

use App\Rfq;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class NotificationEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationemail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $expire_stamp = date('Y-m-d H:i:s', strtotime("-5 min"));

        $rfqs = Rfq::where(function ($query) use ($expire_stamp) {

            $query->whereHas('messages', function ($query_two) use ($expire_stamp) {
                $query_two->whereNull('vu');
                $query_two->whereNull('notified');
                $query_two->where('created_at', '<=', $expire_stamp);
            });
        })->orderBy('created_at', 'desc')->get();


        Log::info("Cron is working fine! " . $expire_stamp . ' | count : ' . count($rfqs));

        foreach ($rfqs as $rfq) {

            $message = $rfq->lastMessage();

            if (!$message)
                continue;

            if ($message->to_importer) {
                if ($rfq->produit_id)
                    $rfq->importer->notify(new \App\Notifications\NewExporterMessageRfqProductNotification($rfq));
                else
                    $rfq->importer->notify(new \App\Notifications\NewExporterMessageRfqDirectNotification($rfq));
            } else {

                $utilisateurs = User::where('entreprise_id', $rfq->entreprise_id)->orderBy('created_at', 'DESC')->get();
                if ($rfq->produit_id)
                    foreach ($utilisateurs as $item_user) {
                        $item_user->notify(new \App\Notifications\NewImporterMessageRfqProductNotification($rfq));
                    }
                else
                    foreach ($utilisateurs as $item_user) {
                        $item_user->notify(new \App\Notifications\NewImporterMessageRfqDirectNotification($rfq));
                    }
            }


            $message->notified =  date('Y-m-d H:i:s');
            $message->save();
        }
    }
}
