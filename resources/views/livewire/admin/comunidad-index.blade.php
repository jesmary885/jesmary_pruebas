<div>
    <h2 class="text-gray-200 font-bold p-2 text-lg">
        COMUNIDAD QUERYSET
    </h2>

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$users_activos}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">USUARIOS ACTIVOS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$users_inactivos}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">USUARIOS INACTIVOS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$registros_dias}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">REGISTRADOS DEL DÍA</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
                <div class="inner">
                <h3>{{$registros_mes}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">REGISTRADOS DEL MES</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <h2 class="text-gray-200 font-bold p-2 text-lg">
        ACTIVOS
    </h2>

    <div class="row">


        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$users_plan_15}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 15 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$users_plan_30}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 30 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    @if($rol_user == 1)

    <h2 class="text-gray-200 font-bold p-2 text-lg">
        GANANCIA DEL DÍA
    </h2>

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$ganancia_dia_15}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 15 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$ganancia_dia_30}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 30 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <h2 class="text-gray-200 font-bold p-2 text-lg">
        GANANCIA DEL MES
    </h2>

    <div class="row">

        <div class="col-lg-3 col-6">

        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$ganancia_dia_15}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 15 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$ganancia_dia_30}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">PLAN 30 DÍAS</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$ganancia_dia_30}}</h3>
                    <p class="sm:text-xs md:text-md font-bold">TOTAL</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                    <a href="# " class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>


    <h2 class="text-gray-200 font-bold p-2 text-lg">
        GANANCIA DEL MES DETALLADA
    </h2>

        @if ($users->count())
            <div class="card">
                @foreach ($users as $user)
                    <div>
                        {{$user->username}}
                    </div>
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                <tr>
                                    <th class="text-center py-3">Plan</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center ">50%</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($this->pago_user($user->id) as $pago)
                                        <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                          
                                            <td class="text-center">{{$pago->plan}} días</td>
                                            <td class="text-center">{{$plan->monto}} $</td>
                                            <td class="text-center">{{($plan->monto) / 2}}</td>
                               
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                @endforeach

                <div class="card-footer">
                    <div class="flex-1">
                        {{$users->links()}}
                    </div>

                </div>
            </div>
        @endif

    @endif

</div>
