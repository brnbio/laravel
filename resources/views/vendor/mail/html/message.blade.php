@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
<p>
    Bei Fragen stehen wir gerne telefonisch von {{ config('app.opening_times') }}
    unter {{ config('app.phone') }} oder per E-Mail an {{ config('app.email') }} zur Verfügung.
</p>
<p>
    Viele Grüße,<br>
    Dein {{ config('app.name') }} Online Team
</p>
<p class="sub mt-5">
    {{ config('app.name') }} ist ein Angebot der [FIRMA]<br>
    [ANSCHRIFT]
</p>
<p class="sub">
    E-Mail: [MAIL]<br>
    Website: {{ config('app.url') }}<br>
    Telefon: {{ config('app.phone') }}
</p>
<p class="sub">
    Geschäfsführer: [NAME]<br>
    Eingetragen beim Amtsgericht [AG], HR[A/B/C] [HRNR]<br>
    Umsatzsteuer-ID: [VATID]
</p>
<p class="sub">
    Verantwortlicher für eigene Inhalte gem. § 55 RStV: [NAME]
</p>
@endcomponent
@endslot
@endcomponent
