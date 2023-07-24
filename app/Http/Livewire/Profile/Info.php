<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Info extends Component
{
    public $plan, $next_payment, $balance, $last_payment_date, $estado;

    public function mount(){

        if(auth()->user()->check_renovation =='si') $this->estado=1 ; else $this->estado = 0; 
        $this->plan = auth()->user()->plan;
        
        if($this->plan == 30) $this->next_payment = date("d-m-Y",strtotime(auth()->user()->last_payment_date."+ 1 month"));
        else $this->next_payment = date("d-m-Y",strtotime(auth()->user()->last_payment_date."+ 15 days"));

        $this->balance = auth()->user()->balance;

        $this->last_payment_date = auth()->user()->last_payment_date;
    }
    public function render()
    {
        return view('livewire.profile.info');
    }

    public function update(){

        if($this->estado == 0) $estado = 'no'; 
        else $estado = 'si';

        $user = User::where('id',auth()->user()->id)->first();

        $user->update([
            'check_renovation' => $estado
        ]);
    }
}
