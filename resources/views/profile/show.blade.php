@extends('adminlte::page')

@section('content')
    <div>
        <div class="max-w-7xl mx-auto py-2 sm:px-2 lg:px-2">

            @livewire('profile.info')

            <x-jet-section-border />

            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
            
            @livewire('profile.update-password-form')

            <x-jet-section-border />

        </div>
    </div>
@stop
