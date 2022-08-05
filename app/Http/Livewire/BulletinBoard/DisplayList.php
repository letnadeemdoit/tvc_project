<?php

namespace App\Http\Livewire\BulletinBoard;

use App\Models\Board;
use Livewire\Component;

class DisplayList extends Component
{
    public $HouseId,$Board;
    public $updateMode = false;
    protected $listeners = [
        'openResetBulletinForm'
    ];
    public function render()
    {
        $boards = Board::paginate(12);

        return view('livewire.bulletins.index', compact('boards'));
    }

    public function resetInput()
    {
        $this->Board = '';
    }

    protected function rules()
    {
        return [
            'Board' => 'required',
        ];
    }
    public function openResetBulletinForm(){
        $this->updateMode = false;
        $this->resetInput();
        $this->emit('openModal');
    }
    public function editBoardData($HouseId)
    {
        $board = Board::findOrFail($HouseId);
        if ($board) {
            $this->Board = $board->Board;
            $this->HouseId = $board->HouseId;
        }
        else{
            $this->updateMode = false;
        }
        $this->updateMode = true;
        $this->emit('openModal');
    }
    public function updateBulletin($HouseId){
        $this->validate();
        $updateBoard = array(
            'Board' => $this->Board,
        );
        Board::where('HouseId', $HouseId)->update($updateBoard);
        $this->emit('hideModal');
        session()->flash('success', 'Bulletin Board Updated successfully...');
        $this->updateMode = false;
        $this->resetInput();

    }
    public function createBulletin(){
        $this->validate();
//        $houseid = Auth::user()->HouseId;
//        $board = new Board();
//        $board->Audit_user_name        = $this->Audit_user_name;
//              $board->Audit_Role        = $this->Audit_Role;
//              $board->Audit_FirstName       = $this->Audit_FirstName;
//              $board->Audit_LastName      = $this->Audit_LastName;
//              $board->Audit_Email = $this->Audit_Email;
//              $board->Board = $this->Board;
//        $board->save();
//        $this->emit('hideModal');
//        session()->flash('success', 'New Bulletin successfully...');
    }
    public function destroy($id)
    {
        $board = Board::where('HouseId', $id)->first();

        if ($board) {
            $this->emit('hideModal');
            $board->delete();
            session()->flash('success', 'Board Deleted successfully...');

        }
    }
}
