{{-- Marcador de portada (sin imágenes reales): barras ámbar sobre surface-high. --}}
@props(['barras' => [50, 80, 60, 90, 40], 'grande' => false])
<div aria-hidden="true"
    {{ $attributes->merge(['class' => 'flex aspect-square items-end gap-1 bg-surface-high p-4 '.($grande ? 'rounded-lg' : 'rounded-md')]) }}>
    @foreach ($barras as $h)
        <i class="flex-1 rounded-pill bg-accent" style="height: {{ $h }}%"></i>
    @endforeach
</div>
