@component('mail::message')
# Introduction

The body of your message.
{{ $project->description }}

@component('mail::button', ['url' => ''])
Button Text {{ $foo }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
