@component('mail::message')
# Post Baru: {{ $post->title }}

{{ $post->summary }}

[Selengkapnya]({{ url('/posts/'.$post->slug) }})

Terima kasih,
{{ config('app.name') }}
@endcomponent
