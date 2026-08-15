<div>
    <div class="card">
        <div class="card-body">

            {{-- Panel --}}
            <div class="w-1/2">
                <select wire:model.defer="opcion" class="form-control w-full">
                    <option value="" selected>Panel</option>
                    <option value="oo">OO</option>
                    <option value="vo">VO</option>
                    <option value="er">ER</option>
                </select>
                <x-input-error for="opcion" />
            </div>

            <hr class="my-4 border-gray-200">

            {{-- Birth date --}}
            <div class="mt-2">
                <label class="block mb-1 font-medium">Birth date</label>
                <div class="flex gap-2">
                    <input wire:model.defer="mes" type="number" placeholder="MM" maxlength="2"
                        class="form-control w-16">
                    <input wire:model.defer="dia" type="number" placeholder="DD" maxlength="2"
                        class="form-control w-16">
                    <input wire:model.defer="ano" type="number" placeholder="AAAA" maxlength="4"
                        class="form-control w-20">
                </div>
                <x-input-error for="birth_month" />
            </div>

            {{-- Gender --}}
            <div class="w-1/2 mt-4">
                <select wire:model.defer="gender" class="form-control w-full">
                    <option value="" selected>Gender</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                </select>
                <x-input-error for="gender" />
            </div>

            {{-- Nombre / Apellido --}}
            <div class="flex gap-4 mt-4">
                <div class="w-1/2">
                    <input wire:model.defer="firstname" placeholder="Firstname"
                        class="form-control w-full">
                    <x-input-error for="firstname" />
                </div>
                <div class="w-1/2">
                    <input wire:model.defer="lastname" placeholder="Lastname"
                        class="form-control w-full">
                    <x-input-error for="lastname" />
                </div>
            </div>

            {{-- Email / Password --}}
            <div class="flex gap-4 mt-4">
                <div class="w-1/2">
                    <input wire:model.defer="email" type="email" placeholder="Email"
                        class="form-control w-full">
                    <x-input-error for="email" />
                </div>
                <div class="w-1/2">
                    <input wire:model.defer="password" placeholder="Password"
                        class="form-control w-full">
                    <x-input-error for="password" />
                </div>
            </div>

            {{-- Zip / Address --}}
            <div class="flex gap-4 mt-4">
                <div class="w-1/3">
                    <input wire:model.defer="zip" placeholder="Zip code"
                        class="form-control w-full">
                    <x-input-error for="zip" />
                </div>
                <div class="w-full">
                    <input wire:model.defer="address" placeholder="Street address"
                        class="form-control w-full">
                    <x-input-error for="address" />
                </div>
            </div>

            {{-- Captcha --}}
            <div class="w-full mt-4">
                <input wire:model.defer="capt" placeholder="Captcha"
                    class="form-control w-full">
                <x-input-error for="capt" />
            </div>

        </div>

        <div class="card-footer">
            <div>
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
                            <span class="info-box-number">Ha ocurrido un error al generar la respuesta..</span>
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




        @if($jumper_complete)
            <div class="flex-nowrap justify-center callout callout-info w-full">

                <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2" id="jumper_copy">{{$jumper_complete['Value']}}</p>

                

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

    @section('js')
        <script>
            function copiarAlPortapapeles(id_elemento) {
                
                var codigoACopiar = document.getElementById(id_elemento);
                var seleccion = document.createRange();
                seleccion.selectNodeContents(codigoACopiar);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(seleccion);
                var res = document.execCommand('copy');
                window.getSelection().removeRange(seleccion);

                toastr.options={
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Copy..')
            }
        </script>


      
    @stop
</div>
