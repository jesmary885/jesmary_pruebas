@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-blue-300"> <i class="fas fa-asterisk mr-1 text-blue-300"></i> DESCALIFICADOR</h1>

</div>

@stop

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#usa" data-toggle="tab">USA</a></li>
                <li class="nav-item"><a class="nav-link" href="#uka" data-toggle="tab">UK</a></li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="usa">
                    <div class="container">

                        @livewire('jumpers.descalificador', ['type' => 'usa']) 

                    </div>

                </div>

                <div class="tab-pane" id="uk">
                    <div class="container">
                      
                        @livewire('jumpers.descalificador', ['type' => 'uk']) 
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

