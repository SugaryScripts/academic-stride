@props([
    'label' => '',
    'name' => null,
    'placeholder' => 'Pilih pilihan',
    'disabled' => false,
    'required' => null,
    'inline' => false,
    'style_select' => 'form-select-sm'
])
@php
    $idName = $name ?? $attributes->whereStartsWith('wire:model')->first();
@endphp

@if($label)
    <label for="{{ $idName }}" class="{{ $inline ? 'form-label' : 'col-form-label' }}">
        {{ $label }}
        @if(isset($required))
            <span class="text-danger">*</span>
        @endif
    </label>
@endif
<select id="{{ $idName }}"
        {{ $attributes->whereStartsWith('wire:') }}
        {{ $disabled ? 'disabled' : "wire:loading.class=border-warning" }}
        {{ $attributes }}
        class="form-control {{ $style_select }} @error( $attributes->whereStartsWith('wire:model')->first() ) is-invalid @enderror">
    <option value="">{{ $placeholder }}</option>
    {{ $slot }}
</select>
<div class="invalid-feedback">
    @error( $attributes->whereStartsWith('wire:model')->first() ) {{ $message }} @enderror
</div>
