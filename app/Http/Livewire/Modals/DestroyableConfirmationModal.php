<?php

namespace App\Http\Livewire\Modals;

use App\Http\Livewire\Traits\Toastr;
use Livewire\Component;

class DestroyableConfirmationModal extends Component
{
    use Toastr;

    public $model = null;
    public $confirmationContent = [
        'title' => 'Are you sure you want to delete this?',
        'description' => 'You would not be able to recover this!'
    ];

    protected $listeners = [
        'destroyable-confirmation-modal' => 'confirming'
    ];

    public function confirming($model, $id, $confirmationContent = [])
    {
        $this->emitSelf('toggle', true);
        $this->model = app($model)->find($id);

        if (!empty(array_filter($confirmationContent))) {
            $this->confirmationContent = $confirmationContent;
        }
    }

    public function render()
    {
        return view('livewire.modals.destroyable-confirmation-modal');
    }

    public function destroy() {
        if ($this->model) {
            $this->model->delete();
        }
        $this->emitSelf('toggle', false);
        $this->emit('destroyed-successfully');
        $this->success('Deleted successfully.');
    }
}
