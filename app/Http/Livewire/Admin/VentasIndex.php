<?php

namespace App\Http\Livewire\Admin;

use App\Models\saleMarketplace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VentasIndex extends Component
{
    public $search;

    protected $listeners = ['render' => 'render'];

    public function status_value($value){
        if($value == 1) return 'Pagado y entregado';
        elseif($value == 2) return 'No pagado ni entregado';
    }

    public function get_name($value){
        if(strlen($value) > 20){
            return substr($value, 0, 20) . '...';
        }
        return $value;
    }

    public function reputation_producto($value){
         if($value == 5){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-yellow-400",
                    5=> "fas fa-star text-md text-yellow-400",
                ];
        }
        elseif($value == 4){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-yellow-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
        }

        elseif($value == 3){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
        }

        elseif($value == 2){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-gray-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
        }

        elseif($value == 1){
            return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-gray-400",
                    3 =>"fas fa-star text-md text-gray-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
        }

        else{
            return [
                1 =>"fas fa-star text-md text-gray-400",
                2 =>"fas fa-star text-md text-gray-400",
                3 =>"fas fa-star text-md text-gray-400",
                4=> "fas fa-star text-md text-gray-400",
                5=> "fas fa-star text-md text-gray-400",
            ];

        }

    }

    public function color_status($value){
        if($value == 'solicitado')  return "text-green-500";
        elseif($value == 'Pago recibido')  return "text-yellow-400";
        elseif($value == 'Producto recibido')  return "text-blue-500";
        else return "text-red-500";
    }

    public function render()
    {
        $marketplaces = 
            saleMarketplace::whereHas('marketplace',function(Builder $query){
                $query->where('user_id',Auth::id())
                ->where('name', 'LIKE', '%' . $this->search . '%');
        })
            ->where('id', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(15);
        
        $nuevas = saleMarketplace::whereHas('marketplace',function(Builder $query){
            $query->where('user_id',Auth::id());})
            ->where('status','solicitado')
            ->count();

        $pago_recibido = saleMarketplace::whereHas('marketplace',function(Builder $query){
            $query->where('user_id',Auth::id());})
            ->where('status','Pago recibido')
            ->count();

        $orden_recibida = saleMarketplace::whereHas('marketplace',function(Builder $query){
            $query->where('user_id',Auth::id());})
            ->where('status','Producto recibido')
            ->count();

        $no_recibido_producto = saleMarketplace::whereHas('marketplace',function(Builder $query){
            $query->where('user_id',Auth::id());})
            ->where('status','Producto no recibido')
            ->count();

        $no_recibido_pago = saleMarketplace::whereHas('marketplace',function(Builder $query){
                $query->where('user_id',Auth::id());})
                ->where('status','Pago no recibido')
                ->count();

        $no_recibido = $no_recibido_producto + $no_recibido_pago;

        return view('livewire.admin.ventas-index',compact('marketplaces','nuevas','pago_recibido','orden_recibida','no_recibido'));
    }

    public function download($value){
        $url = storage_path('app/public/'.str_replace('-', '/', $value));
        return response()->download($url);
    }
}



