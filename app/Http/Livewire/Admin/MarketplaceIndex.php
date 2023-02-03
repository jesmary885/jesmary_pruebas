<?php

namespace App\Http\Livewire\Admin;

use App\Models\Marketplace;
use Livewire\Component;
use Livewire\WithPagination;

class MarketplaceIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$vista;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount($vista){
        $this->vista = $vista;

    }

    public function get_name($value){
        if(strlen($value) > 20){
            return substr($value, 0, 20) . '...';
        }
        return $value;
    }

    public function reputation($value){

        if($value->sales > 0){
            $valor = (100 * $value->points) / ($value->sales * 5);

            if($valor >= 95){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-yellow-400",
                    5=> "fas fa-star text-md text-yellow-400",
                ];
            }

            elseif($valor >=75 && $valor < 95){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-yellow-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
            }

            elseif($valor >=50 && $valor < 75){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-yellow-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
            }

            elseif($valor >=25 && $valor < 50){
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-yellow-400",
                    3 =>"fas fa-star text-md text-gray-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
            }

            else{
                return [
                    1 => "fas fa-star text-md text-yellow-400",
                    2 =>"fas fa-star text-md text-gray-400",
                    3 =>"fas fa-star text-md text-gray-400",
                    4=> "fas fa-star text-md text-gray-400",
                    5=> "fas fa-star text-md text-gray-400",
                ];
            }
        }

        else
        {
            return [
                1 =>"fas fa-star text-md text-gray-400",
                2 =>"fas fa-star text-md text-gray-400",
                3 =>"fas fa-star text-md text-gray-400",
                4=> "fas fa-star text-md text-gray-400",
                5=> "fas fa-star text-md text-gray-400"];
        }
    }

    public function render()
    {
        if($this->vista == 'venta'){
            $marketplaces = Marketplace::where('name', 'LIKE', '%' . $this->search . '%')
            ->where('user_id','=',auth()->id())
            ->where('type','venta')
            ->latest('id')
            ->paginate(20);
        }
        else{
            $marketplaces = Marketplace::where('name', 'LIKE', '%' . $this->search . '%')
            ->where('user_id','=',auth()->id())
            ->where('type','compra')
            ->latest('id')
            ->paginate(20);
        }
        

        return view('livewire.admin.marketplace-index',compact('marketplaces'));
    }
}
