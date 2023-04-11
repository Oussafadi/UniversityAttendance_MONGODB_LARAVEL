@component('mail::message')
# First Email

Dear {{ $email }}

@component('mail::button', ['url' => '../bvn.blade.php'])
Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent