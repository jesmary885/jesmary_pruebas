<?php

namespace App\Http\Livewire\Jumpers\Cint;

use App\Imports\CintImport;
use App\Models\Comments;
use App\Models\Link;
use App\Models\User_Links_Points;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CintIndex extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap";

    public $no_detect,$file,$jumper_redirect,$link_complete_2,$search,$jumper_2,$points_user,$user_auth,$comentario,$calc_link,$jump;

    protected $listeners = ['render' => 'render'];



    public function basic($jumper,$link_complete){
        return redirect()->route('ssidkr.index', [$jumper,$link_complete]);
    }


    public function render()
    {
        $long_psid = strlen($this->search);
        $subs_psid = 0;
        $jumper_complete = 0;
        $comments ="";
        $jumper = "";
        $link_complete="";
        $this->points_user='no';
        $this->calc_link = 0;
        $this->jumper_2 = '';
        $this->user_auth =  auth()->user()->id;
        $this->no_detect = 0;

        if($this->jumper_redirect != 0){
            $jumper = $this->jumper_redirect;
            
            if($this->jumper->jumper_type_id == 3){
                
                $link_complete = $this->link_complete_2;
                $this->calc_link = 1;
            } 
           

            $this->jumper_2 = '1';
            $user_point= User_Links_Points::where('link_id',$this->jumper->id)
                    ->where('user_id',$this->user_auth)
                    ->first();
                    
            $comments = Comments::where('link_id',$this->jumper->id)
                    ->latest('id')
                    ->paginate(5);
                    
            if($user_point) $this->points_user='si';
            else $this->points_user='no';

            if($this->jumper->jumper_type_id == 1){
                    $calc_link = 1;
                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&basic='.$this->jumper->basic;
            } 
                
            if($this->jumper->jumper_type_id == 2){
                if(session('pid')){
                    $this->calc_link = 1;
                    $calculo_high_new = $this->calculo_high($this->jumper->id);
                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$calculo_high_new;

                    }
                else{
                    if($this->calc_link == 0){
                        $jumper_complete = 'Ingrese su PID para calcular el valor high';
                    }
                    else{
                        //$calculo_high_new = $this->calculo_high($jumper->id);
                        $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$this->calculo_high;
                    }
                }
            } 


        
        }
        else{

            if($long_psid >= 7){
                $jumper = Link::where('id_id',$this->search)->first();

                if($jumper){
                    $jumper_complete = $jumper->jumper;
                    $this->calc_link = 1;

                    $this->jumper_2 = '1';
                
                    $user_point= User_Links_Points::where('link_id',$jumper->id)
                        ->where('user_id',$this->user_auth)
                        ->first();
                                    
                    $comments = Comments::where('link_id',$jumper->id)
                        ->latest('id')
                        ->paginate(5);
                                    
                    if($user_point) $this->points_user='si';
                    else $this->points_user='no';
                }
                else{
                    
                    $busqueda_psid= strpos($this->search, 'psid'); 

                    if($busqueda_psid !== false){ //si no tiene la palabra psid
                      
                        $subs_psid = substr($this->search,($busqueda_psid + 5),5);
                        $subs_psid_sin_cortar = substr($this->search,($busqueda_psid + 5));
                        $psid_complete = substr($subs_psid_sin_cortar,0,21);
                    }

                    else{ // busco los **
                        $busqueda_id= strpos($this->search, '**');
                        $subs_psid = substr($this->search,($busqueda_id - 22),5);
                        $subs_psid_sin_cortar = substr($this->search,($busqueda_id - 22));
                        $psid_complete = substr($subs_psid_sin_cortar,0,21);
                    }


                    $url_detect_com= strpos($this->search, '.com');
                    $k_detect= strpos($this->search, '_k=');
                    if($url_detect_com)$url_detect = substr($this->search,8,($url_detect_com-8)).'.com';
                    else $url_detect = 'error';

                    if($url_detect != 'dkr1.ssisurveys.com' && $url_detect != 'error'){
                        
                        $link = new Link();
                        $link->jumper = $url_detect;
                        $link->psid = $subs_psid;
                        $link->user_id = auth()->user()->id;
                        $link->jumper_type_id = 15;
                        if($k_detect) $link->k_detected = 'K='.substr($this->search,($k_detect + 3),4);
                        $link->save();
                    }

                    else{
            
                        $this->no_detect = 1;
                        $this->calc_link = 0;
                    }


                $this->jumper_2 = '';
                 
                }
            }

            

            if($long_psid>70){
                $subs_psid = substr($this->search,49,5);
                $jumper = Link::where('psid',$subs_psid)->first();
                if($jumper){

                    if(session('psid')) $link_complete =substr($this->search,49,21).substr(session('psid'),21);
                    else $link_complete = substr($this->search,49,22);

                    if($jumper->jumper_type_id == 1){
                    $this->jump = $jumper;
                    $this->basic($jumper,$link_complete);
                    }
                }

                else $this->jumper_2 = '';
            }
        
        }

        return view('livewire.jumpers.cint.cint-index',compact('jumper_complete','jumper','comments','subs_psid'));
    }

    public function positivo($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $new_points = $jumper_id->positive_points + 1;

        $jumper_id->update([
            'positive_points' => $new_points, 
        ]);

        $links_points = new User_Links_Points();
        $links_points->user_id = auth()->user()->id;
        $links_points->link_id = $jumper_id->id;
        $links_points->point = 'positive';
        $links_points->save();
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    public function negativo($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $new_points = $jumper_id->negative_points + 1;

        $jumper_id->update([
            'negative_points' => $new_points, 
        ]);
        $links_points = new User_Links_Points();
        $links_points->user_id = auth()->user()->id;
        $links_points->link_id = $jumper_id->id;
        $links_points->point = 'negative';
        $links_points->save();
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    public function comentar($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $comment = new Comments();
        $comment->comment = $this->comentario;
        $comment->link_id = $jumper_id->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        $this->reset(['comentario']);
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    
}
