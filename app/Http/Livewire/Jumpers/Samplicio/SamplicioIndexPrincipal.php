<?php

namespace App\Http\Livewire\Jumpers\Samplicio;

use App\Imports\CintImport;
use App\Models\Comments;
use App\Models\Link;
use App\Models\User;
use App\Models\User_Links_Points;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class SamplicioIndexPrincipal extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $jumper_complete,$busqueda_link,$rol_user,$type_basic,$descalific_active=0,$type,$jumper_complete_qt,$jumper_complete_sp,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $router_cint_detect=0 ;

    protected $listeners = ['render' => 'render'];
    
    public function mount(){

        $user= User::where('id',auth()->id())->first();
        $this->rol_user = $user->roles->first()->id;
        $this->jumper_2 = '';
        $this->user_auth =  auth()->user()->id;

        if(session('search')) $this->search = session('search');
    }

    public function render()
    {
        $long_psid = strlen($this->search);
        $subs_psid = 0;
        $jumper_complete = [];
        $comments ="";
        $jumper = "";
        $link_complete="";
        $this->points_user='no';
        $this->calc_link = 0;
        $this->jumper_2 = '';
        $this->user_auth =  auth()->user()->id;
        $this->no_detect = 0;

        if($long_psid>=5){

            $this->search = trim($this->search);

            $jumper = Link::where('psid',$this->search)
                ->where('jumper_type_id','11')
                ->first();

            if($jumper){

                $jumper_complete = $jumper->jumper;

                $this->busqueda_link = $jumper;

                $user_point= User_Links_Points::where('link_id',$jumper->id)
                ->where('user_id',$this->user_auth)
                ->first();
                            
                $comments = Comments::where('link_id',$jumper->id)
                ->latest('id')
                ->paginate(5);

                if($user_point) {
                  
                    if($user_point->point == 'positive'){
                
                        $this->points_user_positive='si';
                        $this->points_user_negative='no';
                        $this->points_user='si';

                    }

                    else{
                        $this->points_user_positive='no';
                        $this->points_user_negative='si';
                    }
                        
                }
                else{
                    $this->points_user_positive='no';
                    $this->points_user_negative='no';
                }

            }

            else{
                $this->no_detect = 1;
            }
        }

        return view('livewire.jumpers.samplicio.samplicio-index-principal');
    }

    public function positivo($jumper_id){

        $user_point= User_Links_Points::where('link_id',$jumper_id)
            ->where('user_id',$this->user_auth)
            ->first();

        if($user_point){
            $user_point->update([
                'point' => 'positive'
            ]);

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points_positive = $jumper_id->positive_points + 1;
            $new_points_negative = $jumper_id->negative_points - 1;

            $jumper_id->update([
                'positive_points' => $new_points_positive, 
                'negative_points' => $new_points_negative, 
            ]);

            $this->points_user_positive='si';
            $this->points_user_negative='no';

        }
        else{
            $links_points = new User_Links_Points();
            $links_points->user_id = auth()->user()->id;
            $links_points->link_id = $jumper_id;
            $links_points->point = 'positive';
            $links_points->save();

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points = $jumper_id->positive_points + 1;

            $jumper_id->update([
                'positive_points' => $new_points, 
            ]);

            $this->points_user_positive='si';
            $this->points_user_negative='no';

        }

        $this->emitTo('jumpers.samplicio.samplicio-index-principal','render');

        

    }

    public function negativo($jumper_id){
        $user_point= User_Links_Points::where('link_id',$jumper_id)
            ->where('user_id',$this->user_auth)
            ->first();

        if($user_point){
            $user_point->update([
                'point' => 'negative'
            ]);

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points_positive = $jumper_id->positive_points - 1;
            $new_points_negative = $jumper_id->negative_points + 1;

            $jumper_id->update([
                'positive_points' => $new_points_positive, 
                'negative_points' => $new_points_negative, 
            ]);

            $this->points_user_positive='no';
            $this->points_user_negative='si';

        }
        else{
            $links_points = new User_Links_Points();
            $links_points->user_id = auth()->user()->id;
            $links_points->link_id = $jumper_id;
            $links_points->point = 'negative';
            $links_points->save();

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points = $jumper_id->negative_points + 1;

            $jumper_id->update([
                'negative_points' => $new_points, 
            ]);

            $this->points_user_positive='no';
            $this->points_user_negative='si';

        }

        $this->emitTo('jumpers.samplicio.samplicio-index-principal','render');

        
    }

    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->busqueda_link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);
        }

        $this->emitTo('jumpers.samplicio.samplicio-index-principal','render');
    }

    public function clear(){
        $this->reset(['search']);
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('samplicio2.index');

    }
}