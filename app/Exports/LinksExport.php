<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LinksExport implements FromView
{
    protected $links;
    
    public function __construct($links)
    {
        $this->links = $links;

    }

   public function view(): View
   {

       return view('exportexcel.links', ['links'=> $this->links]);
   }
}
