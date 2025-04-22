<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use App\Services\DispositionsService;

class SendWelcomeEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-welcome-emails-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contacts = Contact::query()
            ->whereIn('disposition', DispositionsService::getNames())
            ->whereNull('email_sent_at')
            ->get();

        foreach ($contacts as $contact) {
            try {                
                Mail::to($contact)->send(new ThankyouForSubscribing($contact));

                $contact->updateQuietly(['email_sent_at' => now()]);
            } catch (\Throwable $th) {

                $contact->updateQuietly(['email_sent_at' => null]);
            }
        }

        $this->info("Messages sent to {$contacts->count()} new customers");
    }
}
