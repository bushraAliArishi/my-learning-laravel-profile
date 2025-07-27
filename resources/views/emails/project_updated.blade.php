@component('mail::message')
    # Project Update Notification

    Hello {{ $userName }},

    There has been an update to the project **{{ $projectName }}**.

    @component('mail::button', ['url' => $projectUrl])
        View Project
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
