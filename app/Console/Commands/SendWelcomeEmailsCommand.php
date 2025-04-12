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
        $mailables = Contact::query()
            ->whereIn('disposition', DispositionsService::getNames())
            ->whereNull('email_sent_at')
            ->get();

        foreach ($mailables as $mailable) {
            Mail::to($mailable)->send(new ThankyouForSubscribing($mailable));
        }

        $this->info("Messages sent to {$mailables->count()} new customers");
    }
}
