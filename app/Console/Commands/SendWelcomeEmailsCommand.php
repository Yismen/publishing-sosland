<?php

namespace App\Console\Commands;

use App\Jobs\ProcessGreetCustomers;
use App\Models\Contact;
use App\Services\DispositionsService;
use Illuminate\Console\Command;

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
            if ($contact->email_sent_at === null) {
                ProcessGreetCustomers::dispatch($contact);
            }
        }

        $this->info("Messages sent to {$contacts->count()} new customers");
    }
}
