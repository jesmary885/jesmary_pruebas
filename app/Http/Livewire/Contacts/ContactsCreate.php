<?php

namespace App\Http\Livewire\Contacts;

use App\Models\Contact;
use App\Models\User;
use Livewire\Component;

class ContactsCreate extends Component
{

    public $name,$username;
    public $isopen = false;
    public $accion,$contact;

    protected $rules = 
    [
        'name' => 'required|max:50',
        'username' => 'required|max:50',
    ];

    public function open()
    {
        $this->isopen = true;  
    }

    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(Contact $contact, $accion)
    {
        $this->contact = $contact;
        $this->accion = $accion;

        if($this->accion == 'edit'){
            $this->name = $this->contact->name;
            $this->username =  $this->contact->user->username;
        }
    }

    public function render()
    {
        return view('livewire.contacts.contacts-create');
    }

    public function save(){
        $rules = $this->rules;
        $this->validate($rules);

        $contact_save = User::where('username',$this->username)->first();

        if($contact_save){
            if($this->accion == 'create'){
            $contact = new Contact();
            $contact->name = $this->name;
            $contact->user_id = auth()->user()->id;
            $contact->contact_id = $contact_save->id;
            $contact->save();

            $this->reset(['name','username','isopen']);
            $this->emitTo('contacts.contacts-index','render');

            $this->emit('alert','Contacto creado correctamente');
            }
             else{
                $this->contact->update([
                    'name' => $this->name,
                    'contact_id' => $contact_save->id
                ]);
                $this->reset(['isopen']);
                $this->emitTo('contacts.contacts-index','render');
                $this->emit('alert','Datos modificados correctamente');
            }
        }
        else{
            $this->emit('error', 'El username que ha ingresado no coincide con ninguno de nuestros registros');
        }
    }
}
