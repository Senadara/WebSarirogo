@props([
    'options' => [],
])

<select 
    {{ $attributes->merge([
        'class' => 'w-full px-4 py-2 rounded-lg border text-sm'
    ]) }}
>
    <option>Pilih jenis aktivitas</option>

    @foreach ($options as $item)
        <option value="{{ $item }}">{{ $item }}</option>
    @endforeach
</select>
