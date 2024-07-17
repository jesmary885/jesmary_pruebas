<div>

    <div class="input-group mt-4">
            <input wire:model="jumper_search" placeholder="Ingrese el jumper de la encuesta" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
            @if($jumper_search)
                <div class="input-group-prepend">
                    <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                            <i class="fas fa-backspace"></i>
                    </button>
                </div>
            @endif    
            
            @if($jumper_search)
                        <div class="input-group-prepend ml-4">
                            <button type="submit"  wire:click="generar"  class="btn btn-sm rounded-sm btn-info text-bold" title="{{__('messages.copiar_portapapeles')}}" >Analizar</button> 
                        </div>
                @endif

               

                @if ($error != 0)

        


                <div class="mt-4 w-full">
                    <div class="px-4">
                        <div class=" info-box bg-warning">
                            <span class="info-box-icon"><i class="far fa-sad-tear"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{$error}}</span>
                    
                                </div>
                        </div>
                
                    </div>
                </div>

                @endif
    </div>

    @if ($jumper_detect == 15)
 

    <div class="px-4">
        <div class=" info-box bg-warning">
            <span class="info-box-icon"><i class="far fa-sad-tear"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ha ocurrido un error</span>
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
