@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg ml-2"><i class="fas fa-cart-arrow-down"></i> {{__('messages.Mercado')}}</h1>

</div>

@stop

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#vendedores" data-toggle="tab">Vendedores</a></li>
                <li class="nav-item"><a class="nav-link" href="#compradores" data-toggle="tab">Compradores</a></li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="vendedores">
                    <div class="container py-8">
                        @foreach ($categories as $category)
                            <section class="mb-6">
                                <div class="flex items-center mb-2">
                                    <h1 class="text-lg uppercase font-semibold text-gray-200">
                                        {{$category->name}}
                                    </h1>

                                </div>

                                @livewire('marketplace.marketplace-index', ['category' => $category, 'type' => 'venta']) 

                            </section>

                        @endforeach

                    </div>

                </div>

                <div class="tab-pane" id="compradores">
                    <div class="container py-8">
                        @foreach ($categories as $category)
                            <section class="mb-6">
                                <div class="flex items-center mb-2">
                                    <h1 class="text-lg uppercase font-semibold text-gray-200">
                                        {{$category->name}}
                                    </h1>

                                </div>

                                @livewire('marketplace.marketplace-index', ['category' => $category, 'type'=> 'compra']) 

                            </section>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop





