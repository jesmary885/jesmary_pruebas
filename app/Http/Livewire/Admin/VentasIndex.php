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

    public function reputation_vendedor($value){
        if($value == 5){
               return [
                   1 => "fas fa-heart text-md text-red-500",
                   2 =>"fas fa-heart text-md text-red-500",
                   3 =>"fas fa-heart text-md text-red-500",
                   4=> "fas fa-heart text-md text-red-500",
                   5=> "fas fa-heart text-md text-red-500",
               ];
       }
       elseif($value == 4){
               return [
                   1 => "fas fa-heart text-md text-red-500",
                   2 =>"fas fa-heart text-md text-red-500",
                   3 =>"fas fa-heart text-md text-red-500",
                   4=> "fas fa-heart text-md text-red-500",
                   5=> "fas fa-heart-broken text-md text-gray-400",
               ];
       }

       elseif($value == 3){
               return [
                   1 => "fas fa-heart text-md text-red-500",
                   2 =>"fas fa-heart text-md text-red-500",
                   3 =>"fas fa-heart text-md text-red-500",
                   4=> "fas fa-heart-broken text-md text-gray-400",
                   5=> "fas fa-heart-broken text-md text-gray-400",
               ];
       }

       elseif($value == 2){
               return [
                   1 => "fas fa-heart text-md text-red-500",
                   2 =>"fas fa-heart text-md text-red-500",
                   3 =>"fas fa-heart-broken text-md text-gray-400",
                   4=> "fas fa-heart-broken text-md text-gray-400",
                   5=> "fas fa-heart-broken text-md text-gray-400",
               ];
       }

       elseif($value == 1){
           return [
                   1 => "fas fa-heart text-md text-red-500",
                   2 =>"fas fa-heart-broken text-md text-gray-400",
                   3 =>"fas fa-heart-broken text-md text-gray-400",
                   4=> "fas fa-heart-broken text-md text-gray-400",
                   5=> "fas fa-heart-broken text-md text-gray-400",
               ];
       }

       else{
           return [
               1 =>"fas fa-heart-broken text-md text-gray-400",
               2 =>"fas fa-heart-broken text-md text-gray-400",
               3 =>"fas fa-heart-broken text-md text-gray-400",
               4=> "fas fa-heart-broken text-md text-gray-400",
               5=> "fas fa-heart-broken text-md text-gray-400",
           ];

       }

   }

    public function render()
    {
        $marketplaces = 
            saleMarketplace::whereHas('marketplace',function(Builder $query){
                $query->where('user_id',Auth::id())
                ->where('name', 'LIKE', '%' . $this->search . '%');
        })
            ->orwhereHas('user',function(Builder $query2){
                    $query2->where('username','LIKE', '%' . $this->search . '%');
            })
            ->orwhere('id', 'LIKE', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(30);

        return view('livewire.admin.ventas-index',compact('marketplaces'));
    }

    public function download($value){
        $url = storage_path('app/public/'.str_replace('-', '/', $value));
        return response()->download($url);
    }
}



