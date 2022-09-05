@props([
    'id',
    'on'
])
@php
$id = 'x' . ($id ?? md5(time())) . 'Modal';
@endphp
<div
    class="modal fade"
    id="{{ $id }}"
    x-ref="{{ $id }}"
    tabindex="-1"
    role="dialog"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="{{ $id }}Label"
    aria-hidden="true"
    x-data="{
        modalEl: null,
        show(){
            this.modalEl.modal('show')
        },
        hide(){
            this.modalEl.modal('hide')
        },
        setUpModalEvents() {
            let $modal = this.modalEl;
            this.modalEl.on('shown.bs.modal', function () {
                $dispatch('modal-is-shown', {modal: $modal});
            });
            this.modalEl.on('hidden.bs.modal', function () {
                $dispatch('modal-is-hidden', {modal: $modal});
            });
        }
    }"
    x-init="() => {
        // Initialize modal
        modalEl = $($refs.{{ $id }});

        @this.on('toggle', function (toggle) {
            if (toggle) {
                show();
            } else {
                hide();
            }
        });

        setUpModalEvents();
    }"
    wire:ignore.self
>
    <div {{ $attributes->merge(['class' => 'modal-dialog']) }} role="document">
        {{ $slot }}
    </div>
</div>
