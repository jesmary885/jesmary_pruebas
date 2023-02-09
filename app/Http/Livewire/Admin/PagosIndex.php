<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use Livewire\Component;
Use Livewire\WithPagination;

class PagosIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $fecha_inicio,$fecha_fin,$vista_registros = 0,$search,$buscador;

    protected $listeners = ['render' => 'render'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public function pendientes_verificar(){
        return PagoRegistrosRecarga::where('status','pendiente')->count();
    }
    public function verificados_dia(){
        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        return PagoRegistrosRecarga::where('status','verificado')
        ->whereDay('created_at', $dia)
        ->whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)
        ->count();
    }
    public function verificados_mes(){

        $mes= date('m');
        $ano= date('Y');

        return PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->count();
    }

    public function render()
    {
        if($this->vista_registros == 0){
            if($this->fecha_inicio && $this->fecha_fin){
                $fecha_inicio = date("Y-m-d",strtotime($this->fecha_inicio));
                $fecha_fin = date("Y-m-d",strtotime($this->fecha_fin));
                
                $registros = PagoRegistrosRecarga::where('status','pendiente')
                ->whereBetween('created_at',[$fecha_inicio,$fecha_fin])
                ->latest('id')
                ->paginate(15);

                $total_registros = PagoRegistrosRecarga::where('status','pendiente')
                ->whereBetween('created_at',[$fecha_inicio,$fecha_fin])
                ->count();
            }
            else{
                
                $registros = PagoRegistrosRecarga::where('status','pendiente')
                ->latest('id')
                ->paginate(15);

                $total_registros = PagoRegistrosRecarga::where('status','pendiente')
                ->count();
            }
            

        }

        if($this->vista_registros == 1){

            if($this->fecha_inicio && $this->fecha_fin){

                $fecha_inicio = date("Y-m-d",strtotime($this->fecha_inicio));
                $fecha_fin = date("Y-m-d",strtotime($this->fecha_fin));
                
                $registros = PagoRegistrosRecarga::where('status','verificado')
                ->whereBetween('created_at',[$fecha_inicio,$fecha_fin])
                ->paginate(15);

                $total_registros = PagoRegistrosRecarga::where('status','verificado')
                ->whereBetween('created_at',[$fecha_inicio,$fecha_fin])
                ->count();
            }
            else{
                $registros = PagoRegistrosRecarga::where('status','verificado')
                ->paginate(15);

                $total_registros = PagoRegistrosRecarga::where('status','verificado')
                ->count();
            }
        }
        return view('livewire.admin.pagos-index',compact('total_registros','registros'));
    }

    public function download($value){
        $url = storage_path('app/public/'.str_replace('-', '/', $value));
        return response()->download($url);
    }

    public function comment($comentario){
        $this->emit('comment',$comentario);
    }
}
