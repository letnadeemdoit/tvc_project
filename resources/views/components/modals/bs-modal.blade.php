@props([
    'id',
    'on'
])
@php
$id = $id ?? md5($attributes->wire('model'));
@endphp
<div
    class="modal fade"
    id="{{ $id }}Modal"
    tabindex="-1"
    role="dialog"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="{{ $id }}ModalLabel"
    aria-hidden="true"
    x-data="{
        show: @entangle($attributes->wire('model')).defer,
    }"
    x-init="$watch('show', value => {
        let id = $el.id;
        if (value) {
            $(`#${id}`).modal('show');
        } else {
            $(`#${id}`).modal('hide');
        }
    })"
    wire:ignore.self
>
    <div {{ $attributes->merge(['class' => 'modal-dialog']) }} role="document">
        {{ $slot }}
    </div>
</div>
