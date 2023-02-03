<?php

namespace App\Http\Livewire\Compras;

use App\Models\saleMarketplace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ComprasIndex extends Component
{
    public $search;

    protected $listeners = ['render' => 'render'];

    public function color_status($value){
        if($value == 'solicitado')  return "text-green-500";
        elseif($value == 'Pago recibido')  return "text-yellow-400";
        elseif($value == 'Producto recibido')  return "text-blue-500";
        else return "text-red-500";
    }

    public function get_name($value){
        if(strlen($value) > 20){
            return substr($value, 0, 20) . '...';
        }
        return $value;
    }

    public function render()
    {
        $marketplaces = saleMarketplace::where('user_id',Auth::id())
        ->where('id', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(15);

        $nuevas = saleMarketplace::where('user_id',Auth::id())
            ->where('status','solicitado')
            ->count();

        $pago_recibido = saleMarketplace::where('user_id',Auth::id())
            ->where('status','Pago recibido')
            ->count();

        $orden_recibida = saleMarketplace::where('user_id',Auth::id())
            ->where('status','Producto recibido')
            ->count();

        $no_recibido_producto = saleMarketplace::where('user_id',Auth::id())
            ->where('status','Producto no recibido')
            ->count();

        $no_recibido_pago = saleMarketplace::where('user_id',Auth::id())
                ->where('status','Pago no recibido')
                ->count();

        $no_recibido = $no_recibido_producto + $no_recibido_pago;

        return view('livewire.compras.compras-index',compact('marketplaces','nuevas','pago_recibido','orden_recibida','no_recibido'));
    }
}
