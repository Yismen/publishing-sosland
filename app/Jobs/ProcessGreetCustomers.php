<?php

namespace App\Jobs;

use App\Mail\ThankyouForSubscribing;
use App\Models\Contact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ProcessGreetCustomers implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Contact $contact) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if ($this->contact->fresh()->email_sent_at === null) {
                Mail::send(new ThankyouForSubscribing($this->contact));

                $this->contact->updateQuietly(['email_sent_at' => now()]);
            }
        } catch (\Throwable $th) {
            $this->contact->updateQuietly(['email_sent_at' => null]);
        }
    }
}
