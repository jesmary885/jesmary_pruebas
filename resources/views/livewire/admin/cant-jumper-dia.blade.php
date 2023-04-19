<div>
    <div class="card-body">

        <h2 class="font-bold text-gray-200 mb-4 text-lg">Cantidad de jumpers generados en el día {{\Carbon\Carbon::parse($date_actual)->format('d-m-Y')}}</h2>
        <div class="row">

            @foreach ($jumpers as $jumper)
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    
                    <div class="info-box-content">
                        <span class="info-box-text font-bold text-lg text-cyan-500">{{$jumper->name}}</span>
                        <span class="info-box-number text-lg">{{$this->cant($jumper->name)}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
