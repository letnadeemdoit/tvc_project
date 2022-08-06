<?php

namespace App\Http\Livewire\Traits;

trait Destroyable
{
    public $model;
    protected $destroyableConfirmationContent = [
        'title' => '',
        'description' => ''
    ];

    public function destroy($id)
    {
        if ($this->model) {
            $deletableModel = app($this->model)->findOrFail($id);
            $this->emit(
                'destroyable-confirmation-modal',
                $this->model,
                $id,
                $this->destroyableConfirmationContent
            );
        }
    }
}
