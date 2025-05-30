<div>
    <div class="card">
        <div class="card-header">
            <div class="grid md:grid-cols-4 gap-2">
                @if($estado == "")
                    <div class="col-span-2">
                        <div class="input-group">
                            <input wire:model.defer="psid_search" placeholder="Ingrese su Psid" class="form-control w-full" aria-describedby="inputGroupPrepend" >

                       
                        </div>
                        <div class="input-group">
                            <input wire:model.defer="panel_search" placeholder="Ingrese el Subpanel"  class="form-control w-full mt-2" aria-describedby="inputGroupPrepend" >
                        </div>
                    </div>
                @endif

                @if($estado == "")
                    <div class="col-span-1 ">
                        <button type="submit" class="btn bg-info float-left mt-4 " wire:click="consultar">
                            <i class="fas fa-redo"></i> CONSULTAR
                        </button>
                    </div>
                @endif

                <div class="flex col-span-1 mt-4">
                    <div class="custom-control custom-switch"> 
                        <input value="1" wire:model="estado" type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Habilitar jumper</label>
                    </div>
                </div>
            </div>
        </div>

        @if($estado == "1")
            <div class="input-group mt-2 px-2">
                <input wire:model="jumper_search" placeholder="Ingrese el jumper de la encuesta" id="validationCustomUsername" class="form-control mb-2" aria-describedby="inputGroupPrepend" >
        
                @if($jumper_search)
                    <div class="input-group-prepend">
                        <button class="btn btn-md btn-outline-secondary input-group-text mb-2" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                <i class="fas fa-backspace"></i>
                        </button>
                    </div>
                @endif
            </div>
            @if ($respuesta)
                <div class="mt-4 w-full">
                    <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2">{{$respuesta['jumper']}}</p>   
                </div>
            @endif
        @endif

        @if ($jumper_detect == 10)
            <div class="px-4">
                <div class=" info-box bg-info">
                    <span class="info-box-icon"><i class="	fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Debes saltar la wix de la cuenta por la web, luego vuelve a intentarlo.</span>
                         
                        </div>
                </div>

            </div>
        @endif

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


        <div class="card-body mt-0">
            @if ($jumper_detect == 1)
                <div class="flex-nowrap justify-center callout callout-info w-full">
                    <p class="text-blue-400 text-clip text-sm text-center font-bold mb-2" id="jumper_copy">{{$informacion_complete['Survey']}}</p>
                    <div class="flex justify-center mb-2">
                        <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button>
                    </div>

                        <div class="flex items-center bg-gray-200 text-gray-800 border rounded-md">
                            <div class=" w-full">
                                <div class="grid sm:grid-cols-12 gap-4">
                                    <div class="col-span-12 sm:col-span-6 ">
                                      <div class="flex flex-row bg-gray-100 shadow-sm rounded p-3">
                                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-blue-100 text-blue-500">
                                            <svg class="w-6 h-6" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><path d="M437.02,74.98C388.667,26.628,324.38,0,256,0S123.333,26.628,74.98,74.98S0,187.62,0,256s26.628,132.667,74.98,181.02 S187.62,512,256,512s132.667-26.628,181.02-74.98S512,324.38,512,256S485.372,123.333,437.02,74.98z M425.706,425.706 C380.376,471.036,320.106,496,256,496s-124.376-24.964-169.706-70.294C40.964,380.376,16,320.106,16,256 S40.964,131.624,86.294,86.294C131.624,40.964,191.894,16,256,16s124.376,24.964,169.706,70.294 C471.036,131.624,496,191.894,496,256S471.036,380.376,425.706,425.706z"></path><path d="M48,256c0-114.691,93.309-208,208-208c41.368,0,81.326,12.111,115.555,35.024c3.671,2.458,8.64,1.474,11.098-2.198 c2.458-3.671,1.474-8.64-2.198-11.098C343.584,45.046,300.548,32,256,32c-59.833,0-116.084,23.3-158.392,65.608 C55.3,139.916,32,196.167,32,256c0,55.2,20.254,108.232,57.032,149.328c1.58,1.766,3.768,2.665,5.964,2.665 c1.899,0,3.806-0.672,5.332-2.039c3.292-2.947,3.573-8.004,0.626-11.296C66.807,356.5,48,307.257,48,256z"></path><path d="M442.273,131.547c-2.458-3.672-7.427-4.656-11.098-2.198c-3.671,2.458-4.656,7.427-2.198,11.098 C451.889,174.675,464,214.633,464,256c0,114.691-93.309,208-208,208c-47.583,0-94.096-16.479-130.969-46.401 c-3.431-2.784-8.469-2.26-11.253,1.171s-2.26,8.469,1.171,11.253C154.664,462.251,204.757,480,256,480 c59.833,0,116.084-23.3,158.392-65.608C456.7,372.084,480,315.833,480,256C480,211.453,466.954,168.417,442.273,131.547z"></path><path d="M394.658,100.955c5.379,4.813,10.565,9.964,15.414,15.308c1.579,1.74,3.749,2.624,5.927,2.624 c1.917,0,3.842-0.686,5.374-2.076c3.271-2.969,3.517-8.029,0.548-11.301c-5.22-5.752-10.803-11.296-16.593-16.478 c-3.292-2.946-8.35-2.666-11.296,0.626S391.365,98.008,394.658,100.955z"></path><path d="M256,104c4.418,0,8-3.582,8-8V72c0-4.418-3.582-8-8-8s-8,3.582-8,8v24C248,100.418,251.582,104,256,104z"></path><path d="M248,416v24c0,4.418,3.582,8,8,8s8-3.582,8-8v-24c0-4.418-3.582-8-8-8S248,411.582,248,416z"></path><path d="M104,256c0-4.418-3.582-8-8-8H72c-4.418,0-8,3.582-8,8s3.582,8,8,8h24C100.418,264,104,260.418,104,256z"></path><path d="M408,256c0,4.418,3.582,8,8,8h24c4.418,0,8-3.582,8-8s-3.582-8-8-8h-24C411.582,248,408,251.582,408,256z"></path><path d="M182.928,113.436l-12-20.785c-2.209-3.827-7.102-5.136-10.928-2.928c-3.826,2.209-5.137,7.102-2.928,10.928l12,20.785 c1.482,2.566,4.171,4.001,6.936,4.001c1.357,0,2.733-0.346,3.993-1.073C183.826,122.155,185.137,117.262,182.928,113.436z"></path><path d="M342.928,390.564c-2.209-3.826-7.103-5.135-10.928-2.928c-3.826,2.209-5.137,7.102-2.928,10.928l12,20.785 c1.482,2.566,4.171,4.001,6.936,4.001c1.357,0,2.733-0.346,3.993-1.073c3.826-2.209,5.137-7.102,2.928-10.928L342.928,390.564z"></path><path d="M96.659,356.001c1.357,0,2.733-0.346,3.993-1.073l20.785-12c3.826-2.209,5.137-7.102,2.928-10.928 c-2.209-3.826-7.103-5.135-10.928-2.928l-20.785,12c-3.826,2.209-5.137,7.102-2.928,10.928 C91.205,354.566,93.894,356.001,96.659,356.001z"></path><path d="M394.571,184.001c1.357,0,2.733-0.346,3.993-1.073l20.785-12c3.826-2.209,5.137-7.102,2.928-10.928 s-7.102-5.135-10.928-2.928l-20.785,12c-3.826,2.209-5.137,7.102-2.928,10.928C389.118,182.566,391.807,184.001,394.571,184.001z"></path><path d="M352,89.723c-3.826-2.21-8.719-0.899-10.928,2.928l-12,20.785c-2.209,3.826-0.898,8.719,2.928,10.928 c1.26,0.728,2.635,1.073,3.993,1.073c2.765,0,5.454-1.435,6.936-4.001l12-20.785C357.137,96.825,355.826,91.932,352,89.723z"></path><path d="M180,387.636c-3.826-2.209-8.719-0.898-10.928,2.928l-12,20.785c-2.209,3.826-0.898,8.719,2.928,10.928 c1.26,0.728,2.635,1.073,3.993,1.073c2.765,0,5.454-1.435,6.936-4.001l12-20.785C185.137,394.738,183.826,389.845,180,387.636z"></path><path d="M390.564,342.928l20.785,12c1.26,0.728,2.635,1.073,3.993,1.073c2.765,0,5.454-1.435,6.936-4.001 c2.209-3.826,0.898-8.719-2.928-10.928l-20.785-12c-3.826-2.21-8.719-0.898-10.928,2.928 C385.427,335.826,386.738,340.719,390.564,342.928z"></path><path d="M121.436,169.072l-20.785-12c-3.826-2.21-8.719-0.898-10.928,2.928c-2.209,3.826-0.898,8.719,2.928,10.928l20.785,12 c1.26,0.728,2.635,1.073,3.993,1.073c2.765,0,5.454-1.435,6.936-4.001C126.573,176.174,125.262,171.281,121.436,169.072z"></path><path d="M311.692,360.451c1.357,0,2.733-0.346,3.993-1.073c3.826-2.209,5.137-7.102,2.928-10.928l-44.38-76.869 C277.824,267.384,280,261.943,280,256c0-10.429-6.689-19.322-16-22.624V128c0-4.418-3.582-8-8-8s-8,3.582-8,8v105.376 c-9.311,3.302-16,12.195-16,22.624c0,13.234,10.766,24,24,24c1.497,0,2.961-0.145,4.383-0.408l44.374,76.858 C306.239,359.016,308.928,360.451,311.692,360.451z M248,256c0-4.411,3.589-8,8-8s8,3.589,8,8s-3.589,8-8,8S248,260.411,248,256z"></path></g></svg>
                                        </div>
                                        <div class="flex flex-col flex-grow ml-4">
                                          <div class="text-sm text-gray-500 font-bold">Tiempo</div>
                                          <div class=" text-sm">{{$informacion_complete['Time']}}</div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                      <div class="flex flex-row bg-white shadow-sm rounded p-3">
                                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-green-100 text-green-500">
                                          <!-- icon666.com - MILLIONS vector ICONS FREE --><svg class="w-6 h-6" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><g><g><g><g><path d="m276.775 25.373v171.085c-33.65.224-59.861 25.562-59.861 59.265s26.211 61.042 59.861 61.266v165.934l14.653 4.423 65.152-324.856 13.195-121.189z" fill="#fbf2e2"></path></g><g><path d="m362.806 75.274-73.38 418.076 138.645-395.017z" fill="#9bb6f1"></path></g><g><path d="m384.443 82.919-21.637-7.645-73.38 418.076 45.965-130.958z" fill="#6990eb"></path></g><g><g><path d="m297.732 204.149v-177.164l-20.957-3.613v180.777z" fill="#f7e0ba"></path></g><g><path d="m297.732 482.923v-186.946c-43.01 0-59.861-16.557-59.861-50.26 0-19.736 8.997-36.594 23.204-47.23-25.758 6.644-44.161 28.999-44.161 57.236 0 33.703 26.211 61.042 59.861 61.266v165.934l25.659 4.423.616-3.506z" fill="#f7e0ba"></path></g></g><g><path d="m276.775 196.399v-187.514h-194.902v494.988h194.902v-187.474c-33.137 0-60-26.863-60-60s26.863-60 60-60z" fill="#6de89a" style="fill: rgb(142, 232, 109);"></path></g><g><g><path d="m104.128 481.618v-472.733h-22.255v494.988h194.902v-22.255z" fill="#2ce079"></path></g></g><g><path d="m194.222 361.391h30.112v30.016h-30.112z" fill="#ffc277" transform="matrix(0 1 -1 0 585.676 167.121)"></path></g><g><path d="m134.222 361.391h30.112v30.016h-30.112z" fill="#e08ea2" transform="matrix(0 1 -1 0 525.676 227.121)"></path></g><g><path d="m194.222 421.391h30.112v30.016h-30.112z" fill="#e08ea2" transform="matrix(0 1 -1 0 645.676 227.121)"></path></g><g><path d="m134.222 421.391h30.112v30.016h-30.112z" fill="#d3e0ef" transform="matrix(0 1 -1 0 585.676 287.121)"></path></g><g><path d="m104.243 31.064h15v15h-15z" fill="#fff"></path></g><g><path d="m104.243 61.064h15v15h-15z" fill="#fff"></path></g></g></g></g><g><path d="m201.365 497h15v15h-15z" fill="#000000"></path><path d="m89.37 135.683h-15v376.317h112.263v-15h-97.263z" fill="#000000"></path><path d="m231.785 353.466h-45.017v45.113h45.017zm-15.001 30.112h-15.016v-15.112h15.016z" fill="#000000"></path><path d="m171.783 353.466h-45.017v45.113h45.017zm-15 30.112h-15.016v-15.112h15.016z" fill="#000000"></path><path d="m126.767 458.58h45.017v-45.113h-45.017zm15-30.113h15.016v15.112h-15.016z" fill="#000000"></path><path d="m186.768 458.58h45.017v-45.113h-45.017zm15-30.113h15.016v15.112h-15.016z" fill="#000000"></path><path d="m296.6 495.186 141.03-401.813-66.336-23.438 6.171-35.13-93.189-16.064v-18.741h-209.906v120.682h15v-105.682h179.905v173.932c-33.703 3.743-60.001 32.402-60.001 67.087s26.298 63.344 60.001 67.087v173.894h-37.909v15h52.91v-18.477l12.246 2.111zm-72.326-239.166c-.086-32.344 28.457-55.597 60.001-52.501v-169.557l75.812 13.068-17.978 102.355 14.774 2.595 11.78-67.066 49.856 17.615-105.994 301.99 41.723-237.538-14.774-2.595-55.14 313.926-.059-.01v-169.78c-31.543 3.098-60.09-20.165-60.001-52.502z" fill="#000000"></path></g></g></svg>
                                        </div>
                                        <div class="flex flex-col flex-grow ml-4">
                                          <div class="text-sm font-bold text-gray-500">Monto</div>
                                          <div class=" text-sm">{{$informacion_complete['Monto']}}</div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 ">
                                      <div class="flex flex-row bg-white shadow-sm rounded p-3">
                                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-orange-100 text-orange-500">
                                          <svg class="w-6 h-6" viewBox="0 0 512 512.0005" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="a" gradientUnits="userSpaceOnUse" x1=".001" x2="512.001" y1="256" y2="256"><stop offset="0" stop-color="#80d8ff"></stop><stop offset="1" stop-color="#ea80fc"></stop></linearGradient><path d="m220 0h-200c-11.046875 0-20 8.953125-20 20v200c0 11.046875 8.953125 20 20 20h200c11.046875 0 20-8.953125 20-20v-200c0-11.046875-8.953125-20-20-20zm-20 200h-160v-160h160zm299.65625 73.523438c-7.472656-3.097657-16.078125-1.386719-21.796875 4.332031l-200 200c-5.722656 5.722656-7.433594 14.324219-4.335937 21.796875 3.097656 7.476562 10.386718 12.347656 18.476562 12.347656h200c11.046875 0 20-8.953125 20-20v-200c0-8.089844-4.871094-15.382812-12.34375-18.476562zm-27.65625 198.476562h-131.714844l131.714844-131.714844zm-80-232c66.167969 0 120-53.832031 120-120s-53.832031-120-120-120-120 53.832031-120 120 53.832031 120 120 120zm0-200c44.113281 0 80 35.886719 80 80s-35.886719 80-80 80-80-35.886719-80-80 35.886719-80 80-80zm-157.859375 266.144531-85.855469 85.855469 85.855469 85.855469c7.8125 7.8125 7.8125 20.476562 0 28.285156-7.808594 7.808594-20.472656 7.8125-28.28125 0l-85.859375-85.855469-85.859375 85.859375c-7.808594 7.808594-20.472656 7.808594-28.28125 0-7.8125-7.8125-7.8125-20.476562 0-28.285156l85.855469-85.859375-85.855469-85.855469c-7.8125-7.8125-7.8125-20.476562 0-28.285156 7.808594-7.8125 20.472656-7.8125 28.28125 0l85.859375 85.855469 85.859375-85.859375c7.808594-7.808594 20.472656-7.808594 28.28125 0 7.8125 7.8125 7.8125 20.476562 0 28.289062zm0 0" fill="url(#a)"></path></svg>
                                        </div>
                                        <div class="flex flex-col flex-grow ml-4">
                                          <div class="text-sm text-gray-500 font-bold">Tipo</div>
                                          <div class=" text-sm">{{$this->type($informacion_complete['Survey'])}}</div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6">
                                      <div class="flex flex-row bg-white shadow-sm rounded p-3">
                                        <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl bg-red-100 text-red-500">
                                         <svg class="w-6 h-6" id="Layer_1" enable-background="new 0 0 52 52" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="0" x2=".707" y1="-1240" y2="-1239.293"><stop offset="0" stop-color="#dedfe3"></stop><stop offset=".1783311" stop-color="#dadbdf"></stop><stop offset=".3611409" stop-color="#cecfd3"></stop><stop offset=".546043" stop-color="#b9bcbf"></stop><stop offset=".7323959" stop-color="#9ca0a2"></stop><stop offset=".9181451" stop-color="#787d7e"></stop><stop offset="1" stop-color="#656b6c"></stop></linearGradient><g id="_x37_4"><path d="m7.4295807 37.3858337c-.5559225.0855255-.9651513.6170235-.875 1.1953125.0835595.5463486.6485095.9563942 1.1884766.8759766.5661335-.0838737.9660034-.6177826.8828125-1.1894531 0-.0019531-.0009766-.0039063-.0009766-.0058594-.0833416-.5427361-.652585-.9617767-1.1953125-.8759766z"></path><path d="m48.8026276 36.6514587c-.7734375-1.9765625-2.8789063-2.9677734-4.7412109-2.2802734-3.9610634 1.3507195-6.0002708 2.0497093-10.465332 3.230957.0089111-.1105957.0185547-.2211914.0170898-.3325195-.0097656-1.8740234-1.4677734-3.3925781-3.2509766-3.3925781-.0048828 0-.0087891 0-.0126953 0l-4.8955078.0097656c-1.7331696.049778-3.6960487-.589859-5.1435547-1.5693359-1.8886719-1.2529316-4.0869141-1.8984394-6.2695313-1.8964863l-2.0211182.0028076c-.4605713-1.2197266-1.6278076-2.0926514-2.9935303-2.0926514-.0019531 0-.0048828 0-.0078125 0l-5.0927734-.0703125c-.2568359-.0195313-.5244141.0996094-.7158203.2880859-.1904297.1875-.2978516.4443359-.2978516.7119141v18.3203144c0 .265625.1054688.5205078.2939453.7080078.1875.1865234.4414063.2919922.7060547.2919922h.0019531l5.1328125-.0117188c1.3391113-.0029297 2.4873047-.8255615 2.9727783-1.9906006.0225325.0000153-.0680666-.000061.4539795.0003662 3.2168217 0 5.1348209 1.6820335 6.0009766 2.0888672 2.8102875 1.6129837 5.9545803 1.8675156 8.78125.9472656 3.8701172-1.0449219 7.7011719-2.3583984 11.3867188-3.9033203 2.6865234-1.125 5.3525391-2.3984375 7.8369141-3.7421875 2.2577018-.9430922 3.1071739-3.3032264 2.3232422-5.3183593zm-39.7597657 9.9179688-4.1308594.0097656v-16.3046894c.140399.0019417-.8165708-.0113144 4.0976563.0566406.6748047 0 1.2246094.5488281 1.2265625 1.2236328l.03125 13.7851582c.0009766.6757813-.5488281 1.2275391-1.2246094 1.2294922zm36.5761719-6.4033203c-5.99403 3.229702-12.2975044 5.7388229-18.9335938 7.5322266-2.421875.7871094-4.984375.5146484-7.2089844-.7617188-.803688-.3713837-3.1793728-2.3574219-7.0009766-2.3574219-.0039063 0-.0078125 0-.0117188 0l-.197998-.0002441-.0275879-12.1555176c.4565792-.0006065 1.7804747-.0024414 1.8613281-.0024414 1.8007813 0 3.5634766.5400391 5.0976563 1.5576172 2.0564556 1.3935356 4.2050724 1.8818932 6.2636719 1.9082031l4.8945313-.0097656h.0048828c.6875 0 1.2490234.6279297 1.2529297 1.4101563.0113049.7969284-.5963364 1.3884163-1.2519531 1.390625l-8.8847656.0263672c-.5517578.0019531-.9980469.4511719-.9960938 1.0039063.0019531.5507813.4492188.9960938 1 .9960938h.0039063l8.8818359-.0263672c.6988525-.0008545 1.364502-.2453613 1.9018555-.6599121 5.1476784-1.2774353 8.3471718-2.3586349 12.4282227-3.7512207.9023438-.3320313 1.8652344.1455078 2.2431641 1.1123047.3933944 1.0092199.0527419 2.1914442-1.3203126 2.7871092z"></path><path d="m48.3514557 12.5450115c0-5.8945308-4.7910156-10.6904297-10.6806641-10.6904297-5.8994141 0-10.6992188 4.7958984-10.6992188 10.6904297 0 3.8054199 2.0068359 7.2642822 5.2149658 9.1760254-1.2088623 1.3809814-1.8765869 3.1743164-1.8145752 5.0378418.1357422 3.9345703 3.3857422 7.04883 7.296875 7.04883.0771484 0 .1552734-.0009766.2333984-.0039063 4.0233421-.1252251 7.1771774-3.4952106 7.0478516-7.5205097-.0517578-1.7128906-.6982422-3.3129883-1.8046875-4.567627 3.2033692-1.9130858 5.2060548-5.3696288 5.2060548-9.1706542zm-10.5117188 19.2607422c-.0576172.0009766-.1142578.0019531-.1708984.0019531-2.8388672 0-5.1992188-2.2617188-5.2988281-5.1162109-.0937538-2.8530521 2.1314659-5.3525715 5.1240234-5.4677734 2.8551445-.1000538 5.3693352 2.1600704 5.4570313 5.1220703 0 0 .0009766.0009766.0009766.0019531.0915183 2.8769207-2.1553117 5.3638096-5.1123048 5.4580078zm3.6806641-11.4765625c-1.0897026-.6827049-2.6387138-1.1527653-4.0976563-1.1035156-1.2956619.0484524-2.6504478.49967-3.6181641 1.1044922-2.953125-1.4628906-4.8330078-4.4638672-4.8330078-7.7851563 0-4.7919917 3.9023438-8.6904297 8.6992188-8.6904297 4.7861328 0 8.6806641 3.8984375 8.6806641 8.6904297 0 3.3203125-1.8798828 6.3203125-4.8310547 7.7841797z"></path><path d="m41.2772369 11.5479412h-2.6152344v-2.6152344c0-.5527344-.4472656-.9999995-1-.9999995s-1 .4472651-1 .9999995v2.6152344h-2.6152344c-.5527344 0-1 .4472656-1 1s.4472656 1 1 1h2.6152344v2.6152344c0 .5527344.4472656 1 1 1s1-.4472656 1-1v-2.6152344h2.6152344c.5527344 0 1-.4472656 1-1s-.4472656-1-1-1z"></path><path d="m39.7909088 25.5147381h-4.2568359c-.5527344 0-1 .4472656-1 1s.4472656 1 1 1h4.2568359c.5527344 0 1-.4472656 1-1s-.4472656-1-1-1z"></path></g></svg>
                                        </div>
                                        <div class="flex flex-col flex-grow ml-4 mr-4">
                                          <div class="text-sm text-gray-500 font-semibold ">Puntuación</div>
                                          <div class="flex">

                                            @if($this->tipo_total == 'si')
                                                <i class="font-semibold far fa-thumbs-up text-blue-600 mr-2">{{$this->positive($this->type($informacion_complete['Survey']))}}</i>

                                                <i class="font-semibold far fa-thumbs-down text-red-600">{{$this->negative($this->type($informacion_complete['Survey']))}}</i>
                                            @else

                                                <p>-</p>

                                            @endif
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="input-group mt-5">
                            <input wire:model="jumper_search" placeholder="Ingrese el jumper de la encuesta" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                            @if($jumper_search)
                            <div class="input-group-prepend">
                                <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                        <i class="fas fa-backspace"></i>
                                </button>
                            </div>
                        @endif
                        </div>


                        @if ($respuesta)

                            <div class="mt-4 w-full">
                                <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2">{{$respuesta['jumper']}}</p>   
                            </div>
            
                        @endif
                </div>
            @endif
        </div>



        @if ($informacion_complete == [] || $respuesta == [])
            <div class="flex justify-center ">
                <div class="mt-4 mb-4" wire:loading>
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

    </div>
    
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
    
