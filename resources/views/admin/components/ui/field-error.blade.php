@error($name)
    <p class="mt-2 flex items-start gap-2 text-sm leading-6 text-rose-600">
        <i class="fas fa-circle-exclamation mt-1 shrink-0"></i>
        <span>{{ $message }}</span>
    </p>
@enderror
