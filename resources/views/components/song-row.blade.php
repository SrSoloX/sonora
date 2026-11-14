@props(['indice', 'pista'])
{{-- data-reproducir: al pulsar, el JS reproduce esta pista. data-pista: el JS marca aria-current en la que suena. --}}
<button type="button" data-reproducir="{{ $pista['id'] }}" data-pista="{{ $pista['id'] }}"
    class="foco grid w-full grid-cols-[24px_1fr_auto] items-center gap-3 rounded-md px-2 py-3 text-left transition hover:bg-surface-high aria-[current=true]:bg-surface-high">
    <span class="font-mono text-mono-sm text-ink-muted">{{ str_pad($indice + 1, 2, '0', STR_PAD_LEFT) }}</span>
    <span>
        <span class="block text-body-sm font-bold">{{ $pista['titulo'] }}</span>
        <span class="block text-body-sm font-medium text-ink-muted">{{ $pista['artista'] }}</span>
    </span>
    <span class="font-mono text-mono-sm text-ink-muted">{{ \App\Support\Catalogo::tiempo($pista['dur']) }}</span>
</button>
