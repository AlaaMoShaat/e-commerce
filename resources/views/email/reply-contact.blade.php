<x-mail::message>
    Hello {{ $clientName }},

    {{ $replyMessage }}

    <x-mail::button :url="config('app.url')">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
    {{ config('app.url') }}
</x-mail::message>
