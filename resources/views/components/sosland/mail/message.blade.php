@props([
    'url', 'banner_path'
])
<x-sosland.mail.layout>
{{-- Header --}}
    <x-slot:header >
        <x-sosland.mail.header url="{{ $url }}" banner_path="{{ $banner_path }}">
        </x-sosland.mail.header>
    </x-slot:header>

{{-- Body --}}
{{ $slot }}

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
          Phone (800) 338-6201<br>
          Outside the US call (816) 756-1000<br>
          &nbsp; </span></p>
          <p class="MsoNormal" align="center" style="text-align:center"><span style="font-size:9.0pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
          &quot;Times New Roman&quot;;color:white"><img border="0" id="_x0000_i1026" src="https://hostedcontent.dragonforms.com/hosted/images/dragon/12274/1871.png"></span></p>
          <p style="text-align: center; color: white;">© {{ date('Y') }}&nbsp;Sosland Publishing Company</span></p>
          </td>
         </tr>
         <tr style="mso-yfti-irow:2;mso-yfti-lastrow:yes">
          <td style="padding:0in 0in 0in 0in">
          <p class="MsoNormal" align="center" style="text-align:center"><strong><span style="font-size:8.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:
          &quot;Times New Roman&quot;;mso-bidi-font-family:Aptos;color:white;font-weight:
          normal"><a href="https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaFFEELVca" target="_blank" style="color: #191919;">Privacy Policy</a> | <a href="https://sosland-email.com/portal/wts/ug%5EcmT%5Eh3bybbSEhaFFEFaVca" target="_blank" style="color: #191919;">Contact Us</a> | <a href="https://sosland-email.com/portal/unsubscribeconfirm/?2h5V%2BeAh79dKMVjvY5z28w%3D%3DA" target="_blank" style="color: #191919;">Unsubscribe</a></span></strong><span style="font-size:
          8.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
          color:white"></span></p>
          </td>
         </tr>
        </tbody></table>
        </td>
       </tr>
{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-sosland.mail.subcopy>
{{ $subcopy }}
</x-sosland.mail.subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
{{-- <x-slot:footer>
<x-sosland.mail.footer>
© {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
</x-sosland.mail.footer>
</x-slot:footer> --}}
</x-sosland.mail.layout>
