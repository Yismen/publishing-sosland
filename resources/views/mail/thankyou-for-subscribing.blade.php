<x-sosland.mail.message url="{{ $banner_url }}" banner_path="{{ url($banner_path) }}">

<a href="{{ $banner_url }}" style="display: inline-block;"><img src="{{ $message->embed(url($banner_path)) }}" class="logo" alt="Sosland Logo" style="width: auto; height: 120px;">
</a>
<br />
Hello {{ $contact->name }},

Thank you for subscribing! We're excited to have you join our community of food industry professionals. Expect regular updates packed with the latest industry insights, news, and trends delivered right to your inbox.

To ensure you receive our newsletters without interruption, please safelist our domain, sosland-email.com. For most email providers, this involves adding our domain to your safe senders or whitelist. Usually, this option is in your email or spam/junk folder settings. For Outlook users, follow these steps:

1. Go to **Junk Email Options** in your settings.
1. Navigate to the Safe Senders tab.
1. Add sosland-email.com to the list and click **Add**.

We have instructions for safelisting with other email providers [HERE](https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaMf-4aVca).

If you have questions about your subscription, email [subscriptions@sosland.com](subscriptions@sosland.com).

For news and information in real time bookmark our website [{{ str($banner_url)->after('//')->after('www.') }}]({{ $banner_url }}).

Best regards,

## The Sosland Team
</x-sosland.mail.message>
