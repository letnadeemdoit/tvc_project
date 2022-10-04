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

    public $targetListener;
    protected $listeners = [
        'destroyable-confirmation-modal' => 'confirming'
    ];

    public function confirming($model, $id, $confirmationContent = [], $targetListener = 'destroyed-successfully')
    {
        $this->emitSelf('toggle', true);
        $this->model = app($model)->find($id);
        $this->targetListener = $targetListener;
        if (!empty(array_filter($confirmationContent))) {
            $this->confirmationContent = $confirmationContent;
        }
    }

    public function render()
    {
        return view('livewire.modals.destroyable-confirmation-modal');
    }

    public function destroy()
    {
        $data = [];
        $model = get_class($this->model);
        if ($this->model) {
            $data = $this->model->toArray();
            $this->model->delete();
        }
        $this->model = app($model);
        $this->emitSelf('toggle', false);
        $this->emit($this->targetListener, $data);
        $this->success('Deleted successfully.');
    }
}
