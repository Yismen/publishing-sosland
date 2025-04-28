<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use App\Services\CampaignBannerInfoService;
use App\Services\CampaignService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ThankyouForSubscribing extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     */
    public function __construct(public Contact $contact) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for Subscribing',
            to: [$this->contact->email],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $campaign = CampaignService::fromString($this->contact->campaign);

        return new Content(
            markdown: 'mail.thankyou-for-subscribing',
            with: [
                'banner_url' => $campaign->website,
                'banner_path' => $campaign->banner_path,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
