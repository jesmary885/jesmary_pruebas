<?php

namespace App\Http\Livewire\Admin;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosPaying extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search, $vista_registros = 0,$total_registros;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function links($user){
        return Link::where('user_id',$user)->count();
        
    }

    public function links_negativos($user){
        return Link::where('user_id',$user)
            ->where('negative_points','>','2')
            ->count();
    }

    public function render()
    {
        if($this->vista_registros == 0){

            $users = User::where('username', 'LIKE', '%' . $this->search . '%')
                ->where('type','!=','gratis')
                ->where('id','!=','2017')
                ->where('id','!=','2018')
                ->where('id','!=','2019')
                ->where('id','!=','2020')
                ->where('id','!=','2021')
                ->where('id','!=','2022')
                ->where('id','!=','2023')
                ->where('id','!=','2024')
                ->where('id','!=','2033')
                ->where('id','!=','2034')
                ->where('id','!=','2035')
                ->where('id','!=','2036')
                ->where('id','!=','2037')
                ->where('id','!=','2038')
                ->where('id','!=','2039')
                ->where('id','!=','2040')
                ->where('status','activo')
                ->permission('ssidkr.index')
                ->latest('id')
                ->paginate(20);
            
            $this->total_registros = User::where('type','!=','gratis')
                ->where('status','activo')
                ->permission('ssidkr.index')
                ->count();
        }

        elseif($this->vista_registros == 1){

                $users = User::where('username', 'LIKE', '%' . $this->search . '%')
                    ->where('status','activo')
                    ->where('type','basico')
                    ->where('id','!=','2017')
                    ->where('id','!=','2018')
                    ->where('id','!=','2019')
                    ->where('id','!=','2020')
                    ->where('id','!=','2021')
                    ->where('id','!=','2022')
                    ->where('id','!=','2023')
                    ->where('id','!=','2024')
                    ->where('id','!=','2033')
                    ->where('id','!=','2034')
                    ->where('id','!=','2035')
                    ->where('id','!=','2036')
                    ->where('id','!=','2037')
                    ->where('id','!=','2038')
                    ->where('id','!=','2039')
                    ->where('id','!=','2040')
                    ->permission('ssidkr.index')
                    ->latest('id')
                    ->paginate(20);
                
                $this->total_registros = User::where('type','basico')
                    ->where('status','activo')
                    ->permission('ssidkr.index')
                    ->count();
            
        }

        elseif($this->vista_registros == 2){

            $users = User::where('username', 'LIKE', '%' . $this->search . '%')
                ->where('status','activo')
                ->where('type','premium 30')
                ->where('plan','30')
                ->where('id','!=','2017')
                ->where('id','!=','2018')
                ->where('id','!=','2019')
                ->where('id','!=','2020')
                ->where('id','!=','2021')
                ->where('id','!=','2022')
                ->where('id','!=','2023')
                ->where('id','!=','2024')
                ->where('id','!=','2033')
                ->where('id','!=','2034')
                ->where('id','!=','2035')
                ->where('id','!=','2036')
                ->where('id','!=','2037')
                ->where('id','!=','2038')
                ->where('id','!=','2039')
                ->where('id','!=','2040')
                ->permission('menu.premium')
                ->latest('id')
                ->paginate(20);
            
            $this->total_registros = User::where('type','premium 30')
                ->where('status','activo')
                ->where('plan','30')
                ->where('id','!=','2017')
                ->where('id','!=','2018')
                ->where('id','!=','2019')
                ->where('id','!=','2020')
                ->where('id','!=','2021')
                ->where('id','!=','2022')
                ->where('id','!=','2023')
                ->where('id','!=','2024')
                ->where('id','!=','2033')
                ->where('id','!=','2034')
                ->where('id','!=','2035')
                ->where('id','!=','2036')
                ->where('id','!=','2037')
                ->where('id','!=','2038')
                ->where('id','!=','2039')
                ->where('id','!=','2040')
                ->permission('menu.premium')
                ->count();
        
    }

    elseif($this->vista_registros == 3){

        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
            ->where('status','activo')
            ->where('type','premium 10')
            ->where('plan','10')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('menu.premium')
            ->latest('id')
            ->paginate(20);
        
        $this->total_registros = User::where('type','premium 10')
            ->where('status','activo')
            ->where('plan','10')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('menu.premium')
            ->count();
    
    }

    else{

        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
            ->where('status','activo')
            ->where('type','premium 2')
            ->where('plan','2')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('menu.premium')
            ->latest('id')
            ->paginate(20);
        
        $this->total_registros = User::where('type','premium 2')
            ->where('status','activo')
            ->where('plan','2')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('menu.premium')
            ->count();

    }
        return view('livewire.admin.usuarios-paying',compact('users'));
    }
}
