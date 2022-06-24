{{-- <h1>Verify e-mail</h1>

<p>{!! $body !!}</p>
<br> --}}
{{-- <form action="{{ $action_link }}" method="post"></form> --}}
{{-- <a href="{{ $action_link }}">Verify E-mail</a> --}}




@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}

<h2 style="margin-left: 17.5%">
Click the button below to verify your Email
</h2>

@component('mail::button', ['url' => $action_link])
    Register Here
@endcomponent

{{-- Subcopy --}}


{{-- Footer --}}
@slot('footer')
@component('mail::footer')
©{{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
