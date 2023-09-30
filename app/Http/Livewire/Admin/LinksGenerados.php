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
        ->latest('id')
        ->paginate(25);

        $total = Links_usados::count();

        return view('livewire.admin.links-generados',compact('jumpers','total'));
    }

    public function ver_link($jumper){
        $jump = Links_usados::where('id',$jumper)->first();

        $this->emit('comment',$jump->link);
    }

    public function export(){

        $links = Links_usados::where('k_detected', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->get();

        return Excel::download(new LinksExport($links), 'Links_generados.xlsx');

    }
}
