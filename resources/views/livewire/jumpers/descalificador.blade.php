<div x-data="{jumper_complete: @entangle('jumper_complete'), pid: @entangle('pid_new'), psid: @entangle('psid_register')}">
    <div class="card">
        <div class="card-header form-row">

            <div class="col-sm-12 col-lg-13 col-xl-14">

                <div class="input-group">
                    <input wire:model="search" placeholder="" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                    @if($search)
                            <div class="input-group-prepend">
                                <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                        <i class="fas fa-backspace"></i>
                                </button>
                            </div>
                    @endif
                </div>
            </div>
        </div>
        

        <div class="flex justify-between mt-2">

            @if($psid_register == 0)
            <div class="px-4" :class="{'hidden': (psid != 0)}">
                <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                        <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Aún no has registrado tu PSID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:text-white" href="{{route('registro.psid')}}"> aquí</a> para registrarlo
                        
                    </font></font>
                </div>
            </div>
            @endif
            @if($pid_new == 0)
            <div class="px-4" :class="{'hidden': (pid != 0)}">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                    <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Aún no has registrado tu PID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:font-bold" href="{{route('registro.pid')}}"> aquí</a> para registrarlo
                    </font></font>
                </div>
            </div>
            @endif
        </div>

        <div class="mt-4" wire:loading>
            <div class="container2">
                <div class="cargando">
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <span class="texto-cargando font-bold text-gray-300 ">Loading...</span>
                </div>
            </div>
        </div>

    </div>

    @if ($jumper_detect == 1)
        <div>
        <div class=" info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">La descalificación ha sido procesada exitosamente </span>
           
                    </div>
            </div>

        </div>
            

    @endif

    @if ($jumper_detect == 2)
        <div>
        <div class=" info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Algo en su link no esta bien. </span>
                        <span class="info-box-number">Copielo correctamente...</span>
                    </div>
            </div>

        </div>
            

    @endif

    @if ($jumper_detect == 3)
        <div>
        <div class=" info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ha ocurrido un error. </span>
                        <span class="info-box-number">Intentelo de nuevo...</span>
                    </div>
            </div>

        </div>
            

    @endif

    

    <style>
     .container2{   
     display: grid;
         place-content: center;
         height: 100px;
     }
     .cargando{
         width: 120px;
         height: 30px;
         display: flex;
         flex-wrap: wrap;
         align-items: flex-end;
         justify-content: space-between;
     margin: 0 auto; 
     }
     .texto-cargando{ 
     padding-top:10px
     }
     .cargando span{
         font-size: 20px;
         text-transform: uppercase;
     }
     .pelotas {
         width: 30px;
         height: 30px;
         background-color: #00b8de;
         animation: salto .5s alternate
         infinite;
     border-radius: 50%  
     }
     .pelotas:nth-child(2) {
         animation-delay: .18s;
     }
     .pelotas:nth-child(3) {
         animation-delay: .37s;
     }
     @keyframes salto {
         from {
             transform: scaleX(1.25);
         }
         to{
             transform: 
             translateY(-50px) scaleX(1);
         }
     }
    </style>



</div>
