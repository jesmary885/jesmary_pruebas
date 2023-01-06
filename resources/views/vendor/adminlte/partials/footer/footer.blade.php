<footer class="main-footer px-2 py-1">

<div class="card bg-gradient-primary w-1/5 float-right m-0 d-none d-sm-block">
            <div class="card-header border-0 ui-sortable-handle px-2 py-2 lg:px-4 lg:py-4" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <h3 class="card-title text-md hidden lg:block">
                    <i class="fas fa-hourglass-start mr-1"></i>
                    Cronómetro
                </h3>

                <h3 class="card-title block lg:hidden">
                    <i class="fas fa-hourglass-start mr-1"></i>
                </h3>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card-body px-2 pt-0 pb-1" style="display: block;">
                    <div>
                        <div id="contenedorInputs" class="flex">
                            <input type="number" class="form-control" id="minutos" placeholder="Min">
                            <input type="number" class="form-control" id="segundos" placeholder="Seg">
                        </div>

                        <div class="flex mt-2">
                            <div class="mr-3 mt-1">
                                <h2 class="font-semibold text-xl text-gray-300" id="tiempoRestante">00:00.0</h2>
                            </div>

                            <div>
                                <button type="button" id="btnIniciar" class="btn btn-success"><i class="fas fa-play"></i></button>
                            </div>
                            <div>
                                <button type="button" id="btnPausar" class="btn btn-light"><i class="fas fa-pause"></i></button>
                            </div>
                            <div>
                                <button type="button" id="btnDetener" class="btn btn-danger ml-2"><i class="fas fa-stop"></i></button>
                            </div>

                        </div>
                    </div>

                    
                </div>
            </div>
</div>

<div>


<a class="btn btn-success btn-sm float-right mr-2 px-2 py-1 text-md flex" href="{{route('registro.bloc')}}"> <i class="fas fa-book-open mr-2 py-1 md:py-0"></i> <p class="hidden lg:block">Tu bloc de notas</p> </a> 
</div>

        <script>
   
                const $tiempoRestante = document.querySelector("#tiempoRestante"),
                $btnIniciar = document.querySelector("#btnIniciar"),
                $btnPausar = document.querySelector("#btnPausar"),
                $btnDetener = document.querySelector("#btnDetener"),
                $minutos = document.querySelector("#minutos"),
                $segundos = document.querySelector("#segundos"),
                $contenedorInputs = document.querySelector("#contenedorInputs");
                let idInterval = null, 
                diferenciaTemporal = 0,
                fechaFuturo = null;
                fecha_futuro_bdd = null;
                diferencia_temporal_bdd = null;
            /*    minutos_bdd = null;
                segundos_bdd = null;*/
                let restante_bdd = 0;
      
                window.onload=function()
                {
                   restante_bdd = localStorage.getItem("restante_bdd")
                   fecha_futuro_bdd = localStorage.getItem("fecha_futuro_bdd")
                   diferencia_temporal_bdd = localStorage.getItem("diferencia_temporal_bdd")

                    if(restante_bdd > 0){
                        ocultarElemento($contenedorInputs);
                        mostrarElemento($btnPausar);
                        ocultarElemento($btnIniciar);
                        ocultarElemento($btnDetener);

                        if(diferencia_temporal_bdd > 0){
                            fechaFuturo = new Date(new Date().getTime() + diferencia_temporal_bdd);
                        }
                    

                        clearInterval(idInterval);
                        idInterval = setInterval(() => {
                            const tiempoRestante = fecha_futuro_bdd - new Date().getTime();

                            if (tiempoRestante <= 0) {
                                clearInterval(idInterval);
                                sonido.play();
                                ocultarElemento($btnPausar);
                                mostrarElemento($btnDetener);
                            
                            } else {
                                $tiempoRestante.textContent = milisegundosAMinutosYSegundos(tiempoRestante);
                            }
                        }, 50);
                    }
                }

               
                const cargarSonido = function (fuente) {
                    const sonido = document.createElement("audio");
                    sonido.src = fuente;
                    sonido.loop = true;
                    sonido.setAttribute("preload", "auto");
                    sonido.setAttribute("controls", "none");
                    sonido.style.display = "none"; // <-- oculto
                    document.body.appendChild(sonido);
                    return sonido;
                }

                const sonido = cargarSonido("timer.wav");
                const ocultarElemento = elemento => {
                    elemento.style.display = "none";
                }

                const mostrarElemento = elemento => {
                    elemento.style.display = "";
                }

                

                const iniciarTemporizador = (minutos, segundos) => {

                    ocultarElemento($contenedorInputs);
                    mostrarElemento($btnPausar);
                    ocultarElemento($btnIniciar);
                    ocultarElemento($btnDetener);


                    


                    if (fechaFuturo) {

                        fechaFuturo = new Date(new Date().getTime() + diferenciaTemporal);
                        diferenciaTemporal = 0;

                        localStorage.setItem("fecha_futuro_bdd",fechaFuturo.getTime());
                        localStorage.setItem("diferencia_temporal_bdd",diferenciaTemporal);
                    } else {

                        const milisegundos = (segundos + (minutos * 60)) * 1000;
                        fechaFuturo = new Date(new Date().getTime() + milisegundos);
                        localStorage.setItem("fecha_futuro_bdd",fechaFuturo.getTime());
                    }

                    localStorage.setItem("minutos_bdd",minutos);
                    localStorage.setItem("segundos_bdd",segundos);

                    clearInterval(idInterval);

        
                    idInterval = setInterval(() => {

                        const tiempoRestante = localStorage.getItem("fecha_futuro_bdd") - new Date().getTime();
                        if (tiempoRestante <= 0) {
                            clearInterval(idInterval);
                            sonido.play();
                            
                            ocultarElemento($btnPausar);
                            mostrarElemento($btnDetener);
                          
                        } else {
                            $tiempoRestante.textContent = milisegundosAMinutosYSegundos(tiempoRestante);
                            localStorage.setItem("restante_bdd",tiempoRestante);
                        }
                    }, 50);
                };

                const pausarTemporizador = () => {
                    ocultarElemento($btnPausar);
                    mostrarElemento($btnIniciar);
                    mostrarElemento($btnDetener);

                    fechaFuturo = localStorage.getItem("fecha_futuro_bdd")
                    diferenciaTemporal = fechaFuturo - new Date().getTime();
                    localStorage.setItem("diferencia_temporal_bdd",diferenciaTemporal);
                    clearInterval(idInterval);

                };

                const detenerTemporizador = () => {
                    clearInterval(idInterval);
                    fechaFuturo = null;
                    diferenciaTemporal = 0;
                    sonido.currentTime = 0;
                    sonido.pause();
                    $tiempoRestante.textContent = "00:00.0";
                    localStorage.setItem("restante_bdd",0);
                    init();

                    
                };

                const agregarCeroSiEsNecesario = valor => {
                    if (valor < 10) {
                        return "0" + valor;
                    } else {
                        return "" + valor;
                    }
                }
                const milisegundosAMinutosYSegundos = (milisegundos) => {
                    const minutos = parseInt(milisegundos / 1000 / 60);
                    milisegundos -= minutos * 60 * 1000;
                    segundos = (milisegundos / 1000);
                    return `${agregarCeroSiEsNecesario(minutos)}:${agregarCeroSiEsNecesario(segundos.toFixed(1))}`;
                };
                const init = () => {
                    $minutos.value = "";
                    $segundos.value = "";
                    mostrarElemento($contenedorInputs);
                    mostrarElemento($btnIniciar);
                    ocultarElemento($btnPausar);
                    ocultarElemento($btnDetener);
                };

                $btnIniciar.onclick = () => {
                    const minutos = parseInt($minutos.value);
                    const segundos = parseInt($segundos.value);

                    if (isNaN(minutos) || isNaN(segundos) || (segundos <= 0 && minutos <= 0)) {
                        const minutos= localStorage.getItem("minutos_bdd");
                        const segundos = localStorage.getItem("segundos_bdd");
                        iniciarTemporizador(minutos, segundos);
                    }
                    else{
                        iniciarTemporizador(minutos, segundos);
                    }
                };
                init();
                $btnPausar.onclick = pausarTemporizador;
                $btnDetener.onclick = detenerTemporizador;
        </script>
     
</footer>
