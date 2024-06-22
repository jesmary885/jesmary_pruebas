@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-cyan-400"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> ENCUESTAR</h1>


</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

   
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#cuenta1" data-toggle="tab">CUENTA 1</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cuenta2" data-toggle="tab">CUENTA 2</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cuenta3" data-toggle="tab">CUENTA 3</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cuenta4" data-toggle="tab">CUENTA 4</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cuenta5" data-toggle="tab">CUENTA 5</a></li>
                
                </ul>
            </div>
    
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="cuenta1">
                        <div class="container ">

                            @livewire('jumpers.encuestar.encuestar1-index',key('1')) 
                            
    
                        </div>
                    </div>

                    <div class="tab-pane" id="cuenta2">
                        <div class="container ">
                     
    
                            @livewire('jumpers.encuestar.encuestar2-index',key('2')) 
    
                        </div>
                    </div>
    
                    <div class="tab-pane" id="cuenta3">
                        <div class="container ">
                     
    
                            @livewire('jumpers.encuestar.encuestar3-index',key('3')) 
    
                        </div>
                    </div>
    
                    <div class="tab-pane" id="cuenta4">
                        <div class="container ">
                     
    
                            @livewire('jumpers.encuestar.encuestar4-index',key('4')) 
    
                        </div>
                    </div>
    
                    <div class="tab-pane" id="cuenta5">
                        <div class="container ">
                     
    
                            @livewire('jumpers.encuestar.encuestar5-index',key('5')) 
    
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

@section('js')
    <script> console.log('Hi!'); </script>
@stop