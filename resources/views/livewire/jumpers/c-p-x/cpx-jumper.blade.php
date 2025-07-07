<div>
    <div class="card">

        <div class="card-body">

            
            <div class="grid md:grid-cols-4 gap-2">


                    <div class="col-span-4">
                   

                        <div class="w-full flex mt-1" >

                            <input wire:model.defer="link" placeholder="Introduzca el link" class="form-control w-full" >

                            @if($link)
                                <div class="input-group-prepend">
                                    <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                            <i class="fas fa-backspace"></i>
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
   
                    


            </div>

        </div>
        <div class="card-footer ">

            <div >
                <button type="submit" class="btn bg-info " wire:click="procesar">
                    PROCESAR
                </button>
            </div>
        </div>

    </div>

        



        @if ($jumper_detect == 2)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="far fa-sad-tear"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Lo siento.</span>
                            <span class="info-box-number">Ha ocurrido un error al generar el jumper...</span>
                        </div>
                </div>

            </div>
        @endif

           @if ($jumper_detect == 6)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Esta intentando generar más de 6 jumpers en menos de 30 min. </span>
                            <span class="info-box-number">Intentelo luego.</span>
                        </div>
                </div>
            </div>
        @endif




        @if ($jumper_detect == 3)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Algo en su link no esta bien. </span>
                            <span class="info-box-number">Copielo correctamente...</span>
                        </div>
                </div>
            </div>
        @endif

         @if ($jumper_complete == [])
                <div class="flex justify-center">
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
                
         @endif

         @if ($jumper_complete)


            <div class="card">



                <div class="card-body mt-0">

                    

                        <div class="flex-nowrap justify-center callout callout-info w-full">
                            
                                
                                <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2" id="jumper_copy">{{$jumper_complete['jumper']}}</p>

    
                                
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