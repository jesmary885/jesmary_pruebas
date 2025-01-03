<?php

namespace App\Http\Livewire\Admin;

use App\Exports\LinksExport;
use App\Models\Links_usados;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class LinksGenerados extends Component
{
    use WithPagination;

    
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $jumpers = Links_usados::where('k_detected', 'LIKE', '%' . $this->search . '%')
            ->where('k_detected','!=','BITLAB')
            ->latest('id')
            ->paginate(25);

        $total = Links_usados::where('k_detected','!=','BITLAB')
            ->count();

        return view('livewire.admin.links-generados',compact('jumpers','total'));
    }

    public function ver_link($jumper){
        $jump = Links_usados::where('id',$jumper)->first();

        $this->emit('comment',$jump->link);
    }

    public function ver_link_resultado($jumper){
        $jump = Links_usados::where('id',$jumper)->first();

        $this->emit('comment',$jump->link_resultado);
    }

    public function export(){

        $links = Links_usados::latest('id')
            ->where('k_detected','!=','BITLAB')
            ->take('2500')
            ->get();

        return Excel::download(new LinksExport($links), 'Links_generados.xlsx');

    }
}
