<x-sosland.mail.message url="{{ $banner_url }}" banner_path="{{ url($banner_path) }}">

<a href="{{ $banner_url }}" style="display: inline-block; padding-bottom: 20px;" target="_blank">
    <img src="{{ $message->embed(url($banner_path)) }}" class="logo" alt="Sosland Logo" style="width: auto; height: 100%;">
</a>
<br />
Hello {{ $contact->name }}, <br />

Thank you for subscribing! We're excited to have you join our community of food industry professionals. Expect regular updates packed with the latest industry insights, news, and trends delivered right to your inbox.

To ensure you receive our newsletters without interruption, please safelist our domain, sosland-email.com. For most email providers, this involves adding our domain to your safe senders or whitelist. Usually, this option is in your email or spam/junk folder settings. For Outlook users, follow these steps:

1. Go to **Junk Email Options** in your settings.
1. Navigate to the Safe Senders tab.
1. Add sosland-email.com to the list and click **Add**.

We have instructions for safelisting with other email providers [HERE](https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaMf-4aVca).

If you have questions about your subscription, email <a href="mailto:subscriptions@sosland.com">subscriptions@sosland.com</a>.

For news and information in real time bookmark our website [{{ str($banner_url)->after('//')->after('www.') }}]({{ $banner_url }}).

Best regards,

## The Sosland Team

<tr style="mso-yfti-irow:2;mso-yfti-lastrow:yes; line-height: 1.05;">
    <!-- Footer Logo -->
        <td style="background:#527780;padding:22.5pt 15.0pt 22.5pt 15.0pt">
        <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100.0%;border-collapse:collapse;mso-yfti-tbllook:
         1184;mso-padding-alt:0in 0in 0in 0in">
         <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
          <td style="padding:0in 0in 0in 0in">
          </td>
         </tr>
         <tr style="mso-yfti-irow:1">
          <td style="padding:12.0pt 0in 12.0pt 0in">
          <p class="MsoNormal" align="center" style="text-align:center; line-height: 1rem;;"><span style="font-size:9.0pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
          &quot;Times New Roman&quot;;color:white">2345 Grand Blvd Suite 1950, Kansas City,
          MO 64108<br>
          Phone <a href="tel:+(800) 338-6201" style="color: #191919;">(800) 338-6201</a><br>
          Outside the US call <a href="tel:+(816) 756-1000" style="color: #191919">(816) 756-1000</a><br>
          &nbsp; </span></p>
          <p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:9.0pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
          &quot;Times New Roman&quot;;color:white"><a href="https://sosland.com" target="_blank"><img border="0" id="_x0000_i1026" src="{{ $message->embed(url('img/sosland.png')) }}"></a></span></p>
          <p style="text-align: center; color: white;">© {{ date('Y') }}&nbsp;Sosland Publishing Company</span></p>
          </td>
         </tr>
         <tr style="mso-yfti-irow:2;mso-yfti-lastrow:yes">
          <td style="padding:0in 0in 0in 0in">
          <p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-size:8.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
          &quot;Times New Roman&quot;;mso-bidi-font-family:Aptos;color:white;font-weight:
          normal"><a href="https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaFFEELVca" target="_blank" style="color: #191919;">Privacy Policy</a> | <a href="https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaFFEFaVca" target="_blank" style="color: #191919;">Contact Us</a> | <a href="mailto:keiths@eccogroupusa.com" target="_blank" style="color: #191919;">Unsubscribe</a></span></strong><span style="font-size:
          8.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
          color:white"></span></p>
          </td>
         </tr>
        </tbody></table>
        </td>
       </tr>

</x-sosland.mail.message>
