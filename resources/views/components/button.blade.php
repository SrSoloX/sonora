@props(['variant' => 'primary'])
@php
    $base = 'foco rounded-pill px-6 py-3 text-body-sm font-bold transition disabled:cursor-not-allowed disabled:opacity-50';
    $variantes = [
        'primary'   => 'bg-accent text-on-accent hover:bg-accent-hover',
        'secondary' => 'border-2 border-line-strong text-ink hover:bg-surface-high',
        'ghost'     => 'text-ink-muted hover:bg-surface-high hover:text-ink',
    ];
@endphp
<button {{ $attributes->merge(['type' => 'button', 'class' => $base.' '.$variantes[$variant]]) }}>{{ $slot }}</button>
