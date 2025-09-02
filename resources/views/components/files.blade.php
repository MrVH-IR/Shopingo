{{-- resources/views/components/files.blade.php --}}

@props(['href' => null])

@if($href)
    <a href="{{ $href }}"
       {{ $attributes->merge([
           'class' => '
                d-inline-flex align-items-center gap-1 px-3 py-2
                text-decoration-none rounded-3 fs-6
                custom-download-link
            '
       ]) }}
       target="_blank"
       rel="noopener noreferrer"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
        </svg>

        {{ $slot }}

        @if($attributes->get('title'))
            <small class="text-muted ms-1">({{ $attributes->get('title') }})</small>
        @endif
    </a>
@else
    <span class="text-muted small">{{ $slot ?: 'لینکی موجود نیست' }}</span>
@endif
