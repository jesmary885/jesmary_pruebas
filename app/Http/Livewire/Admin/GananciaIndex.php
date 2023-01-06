<?php

namespace App\Http\Livewire\Admin;

use App\Models\saleMarketplace;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GananciaIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$fecha_inicio,$fecha_fin,$arry;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

        $fecha_inicio = date("Y-m-d", strtotime($this->fecha_inicio));
        $fecha_fin = date("Y-m-d", strtotime($this->fecha_fin));
        $user_idd = Auth::id();

        $sales = 
            saleMarketplace::whereBetween(DB::raw('DATE(created_at)'),[$fecha_inicio,$fecha_fin])
            ->whereHas('marketplace',function(Builder $query){
                $query->where('user_id',Auth::id());
            })
            ->where('status', 1)
            ->latest('id')
            ->paginate(10);

        $movimientos_pagos = DB::select('SELECT sum(sm.total_paid) as quantity, pm.name as metodo_nombre from sale_marketplaces sm 
            right join payment_methods pm on pm.id = sm.payment_method_id
            right join marketplaces m on m.id = sm.marketplace_id AND m.user_id = :user_idd 
            where sm.status = "1" AND sm.created_at BETWEEN :fecha_inicio AND :fecha_fin
            group by pm.name order by sum(sm.total_paid) desc',
            array('user_idd' => $user_idd,'fecha_inicio' => $fecha_inicio,'fecha_fin' => $fecha_fin));


        $data=json_encode($movimientos_pagos);
        $array = json_decode($data, true);

        return view('livewire.admin.ganancia-index',compact('sales','array'));
    }
}
