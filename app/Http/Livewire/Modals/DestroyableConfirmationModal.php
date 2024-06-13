<?php

namespace App\Http\Livewire\Modals;

use App\Http\Livewire\Traits\Toastr;
use Livewire\Component;

class DestroyableConfirmationModal extends Component
{
    use Toastr;

    public $model = null;
    public $reject = null;
    public $confirmationContent = [
        'title' => 'Are you sure you want to delete this?',
        'description' => 'You would not be able to recover this!'
    ];

    public $targetListener;
    protected $listeners = [
        'destroyable-confirmation-modal' => 'confirming'
    ];

    public function confirming($model, $id, $confirmationContent = [],$rejected = null,$targetListener = 'destroyed-successfully')
    {
        if ($rejected === 'rejected'){
            $this->reject = $rejected;
            $this->confirmationContent = [
                'title' => 'Are you sure you want to reject this?',
                'description' => 'You would not be able to recover this!'
            ];
        }
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
        $this->dispatchBrowserEvent($this->targetListener, $data);
        if ($this->reject === 'rejected'){
            $this->success('Rejected successfully.');
        }
        else{
            $this->success('Deleted successfully.');
        }
    }
}
