<x-mail::message>
# Introduction

Thank you for subscribe!!

<x-mail::button :url="route('frontend.index')">
Visit our Wesite
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
