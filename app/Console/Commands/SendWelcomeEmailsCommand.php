<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
            ->whereIn('disposition', config('app.mailable_dispositions'))
            ->whereNull('email_sent_at')
            ->get();

        foreach ($mailables as $mailable) {
            Mail::to($mailable)->send(new ThankyouForSubscribing($mailable));
        }
    }
}
