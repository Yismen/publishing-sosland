<?php

namespace App\Jobs;

use Throwable;
use App\Models\Contact;
use App\Mail\ThankyouForSubscribing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

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

            $this->contact->failure()->updateOrCreate(
                [
                    'failable_id' => $this->contact->id,
                    'failable_type' => Contact::class,
                ],
                [
                    'email_failed_at' => now(),
                    'data' => json_encode($this->contact->toArray()),
                    'exception' => json_encode([
                        'message' => $th->getMessage(),
                        'code' => $th->getCode(),
                        'file' => $th->getFile(),
                        'line' => $th->getLine(),
                    ]),
                ]

            );
        }
    }
}
