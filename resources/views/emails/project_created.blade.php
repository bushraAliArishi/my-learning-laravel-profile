<x-mail::message>
    # Project Creation Confirmation

    Hello {{ $userName }},

    You created your project successfully: **{{ $projectName }}**.

    <x-mail::button :url="$projectUrl">
        View Your Project
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}

    <x-mail::subcopy>
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </x-mail::subcopy>
</x-mail::message>
