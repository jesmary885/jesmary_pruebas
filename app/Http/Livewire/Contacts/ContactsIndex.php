<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactsIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search, $contact_delete;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $contacts = Contact::where('user_id',auth()->user()->id)
        ->latest('id')
        ->paginate(10);

        return view('livewire.contacts.contacts-index',compact('contacts'));
    }

    public function delete($contactId){

        $this->contact_delete = $contactId;
      

        $this->emit('confirm', 'Esta seguro de eliminar esta persona de sus contactos?','contacts.contacts-index','confirmacion','El contacto se ha eliminado.');
    }

    public function confirmacion(){
        $contact_destroy = Contact::where('id',$this->contact_delete)->first();
        $contact_destroy->delete();
     $this->resetPage();
    }

    public function contact($contact){

        $this->emit('render');
        return redirect()->to('/chat-conver/'.$contact);

    }
}
