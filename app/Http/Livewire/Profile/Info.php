<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Info extends Component
{
    public $plan, $next_payment, $balance;

    public function mount(){
        $this->plan = auth()->user()->plan;
        
        if($this->plan == 30) $this->next_payment = date("d-m-Y",strtotime(auth()->user()->last_payment_date."+ 1 month"));
        else $this->next_payment = date("d-m-Y",strtotime(auth()->user()->last_payment_date."+ 15 days"));

        $this->balance = auth()->user()->balance;
    }
    public function render()
    {
        return view('livewire.profile.info');
    }
}
