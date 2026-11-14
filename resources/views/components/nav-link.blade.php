@props(['href', 'icono', 'activo' => false])
<a href="{{ $href }}" @if ($activo) aria-current="page" @endif
    {{ $attributes->merge(['class' => 'foco flex items-center gap-3 rounded-md p-3 text-body-sm font-bold text-ink-muted transition hover:bg-surface-high aria-[current=page]:bg-surface-high aria-[current=page]:text-ink']) }}>
    <x-icon :name="$icono" />
    {{-- En móvil (390px) solo se ve el icono; el texto sigue disponible para lectores de pantalla --}}
    <span class="sr-only md:not-sr-only">{{ $slot }}</span>
</a>
