<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JumpersController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PsidController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SobrenosotrosController;
use App\Http\Livewire\Chat\ChatComponent;
use App\Http\Livewire\Pid\Register;
use App\Models\Marketplace;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return view('auth.login');
})->name('login_guest');

Route::get('dates/{user}',[RegisterController::class,'date_index'])->name('register_dates.index');
Route::post('dates',[RegisterController::class,'date_create'])->name('register_dates.create');


/*
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::middleware(['active'])->group(function(){
        Route::get('/home', [HomeController::class,'index'])->name('home');
    });
});*/

Route::middleware(['auth','verified'])->group(function()
{
    Route::middleware(['home'])->group(function(){
        Route::get('/home', [HomeController::class,'index'])->name('home');
    });
});

Route::middleware(['auth','verified'])->group(function()
{
    Route::middleware(['active'])->group(function(){

        Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');

        //Jumpers
        Route::get('k1000-PS',[JumpersController::class,'kmil_poderosa1'])->name('kmil_poderosa1.index')->middleware('permission:menu.premium');
        Route::get('k1000-PM',[JumpersController::class,'kmil_poderosa2'])->name('kmil_poderosa2.index')->middleware('permission:menu.premium');
        Route::get('k23-P',[JumpersController::class,'k23_poderosa'])->name('k23_poderosa.index')->middleware('permission:menu.premium');
        Route::get('k1083',[JumpersController::class,'k1083'])->name('k1083.index')->middleware('permission:menu.premium');

        Route::get('k1093',[JumpersController::class,'k1093'])->name('k1093.index');
        Route::get('k1091',[JumpersController::class,'k1091'])->name('k1091.index');
        Route::get('k2028',[JumpersController::class,'k2028'])->name('k2028.index');
        Route::get('k5460',[JumpersController::class,'k5460'])->name('k5460.index');
        Route::get('k6057',[JumpersController::class,'k6057'])->name('k6057.index');
        Route::get('k2066',[JumpersController::class,'k2066'])->name('k2066.index');
        Route::get('k7341-P',[JumpersController::class,'k7341_poderosa'])->name('k7341_poderosa.index');
        Route::get('cint',[JumpersController::class,'cint'])->name('cint.index');
        Route::get('internals',[JumpersController::class,'internals'])->name('internals.index');
        Route::get('k1000',[JumpersController::class,'kmil'])->name('kmil.index');
        Route::get('k1092',[JumpersController::class,'kmilnoventaydos'])->name('kmilnoventaydos.index');
        Route::get('k2062',[JumpersController::class,'kdosmilsesentaydos'])->name('kdosmilsesentaydos.index');
        Route::get('k23',[JumpersController::class,'kveintitres'])->name('kveintitres.index');
        Route::get('k3203',[JumpersController::class,'k3203'])->name('k3203.index');
        Route::get('k2049',[JumpersController::class,'k2049'])->name('k2049.index');
        Route::get('k3906',[JumpersController::class,'k3906'])->name('k3906.index');
        Route::get('k11052',[JumpersController::class,'k11052'])->name('k11052.index');
        Route::get('k15293',[JumpersController::class,'k15293'])->name('k15293.index');
        Route::get('k10611',[JumpersController::class,'k10611'])->name('k10611.index');
        Route::get('k17564',[JumpersController::class,'k17564'])->name('k17564.index');
        Route::get('k1098',[JumpersController::class,'k1098'])->name('k1098.index');
        Route::get('k7341',[JumpersController::class,'ksietemilcuarentayuno'])->name('ksietemilcuarentayuno.index');
        Route::get('prodege',[JumpersController::class,'prodege'])->name('prodege.index');
        Route::get('samplicio',[JumpersController::class,'samplicio'])->name('samplicio.index');
        Route::get('scube',[JumpersController::class,'scube'])->name('scube.index');
        Route::get('spectrum',[JumpersController::class,'spectrum'])->name('spectrum.index');
        Route::get('toluna',[JumpersController::class,'toluna'])->name('toluna.index');
        Route::get('ssidkr',[JumpersController::class,'ssidkr'])->name('ssidkr.index');
        Route::get('k10634',[JumpersController::class,'k10634'])->name('k10634.index');
        Route::get('k11619',[JumpersController::class,'k11619'])->name('k11619.index');
        Route::get('k10659',[JumpersController::class,'k10659'])->name('k10659.index');

        Route::get('descalificador',[JumpersController::class,'descalificador'])->name('descalificador.index');
        Route::get('wix',[JumpersController::class,'wix'])->name('wix.index');
        //Route::get('k2001',[JumpersController::class,'k2001'])->name('k2001.index');
        Route::get('ktmr',[JumpersController::class,'ktmr'])->name('ktmr.index');
        Route::get('qt',[JumpersController::class,'qt'])->name('qt.index');
        Route::post('import_cint',[JumpersController::class,'import_cint'])->name('cint.import');

        //Marketplace
        Route::get('marketplace',[MarketplaceController::class,'index'])->name('marketplace.index');
        Route::get('marketplace_shop/{marketplace}',[MarketplaceController::class,'shop'])->name('marketplace.shop');
        Route::get('marketplace/{marketplace}',[MarketplaceController::class,'add_files'])->name('marketplace.add.files');
        Route::post('marketplace/{marketplace}/files',[MarketplaceController::class,'files'])->name('marketplace.files');

        //chat
        Route::get('chat-conver/{contact?}',[ChatController::class,'index'])->name('chat.index');
        Route::get('chat-conver/{user}',[ChatController::class,'chat_convers'])->name('chat.convers');

        //Contacts
        Route::get('contacts',[ContactController::class,'index'])->name('contacts.index');

        //Mis compras
        Route::get('my_shopping',[MarketplaceController::class,'compras'])->name('marketplace_compras.index');

        //PSID
        Route::get('register_psid',[PsidController::class,'index_psid'])->name('registro.psid');
        Route::get('limpiar_psid',[PsidController::class,'limpiar_psid'])->name('limpiar.psid');
       
        //PID
        Route::get('register_pid',[PsidController::class,'index_pid'])->name('registro.pid');
        Route::get('limpiar_pid',[PsidController::class,'limpiar_pid'])->name('limpiar.pid');
        //BLOC
        Route::get('bloc',[PsidController::class,'index_bloc'])->name('registro.bloc');

        //REPORTAR PAGO
        Route::get('reportar_pago',[PagoController::class,'index'])->name('reporte_pago');

        //Administración

        Route::get('admin_multilogin', [AdminController::class, 'multilogin'])->name('admin.multilogin.index')->middleware('permission:administracion_principal');
        Route::get('admin_comunidad', [AdminController::class, 'comunidad'])->name('admin.comunidad')->middleware('permission:otro.admin');
        Route::get('admin_modificaciones', [AdminController::class, 'modificaciones'])->name('admin.modificaciones')->middleware('permission:administracion_principal');
        Route::get('admin_tasa_cambio', [AdminController::class, 'tasa_cambio'])->name('admin.tasa_cambio')->middleware('permission:administracion_principal');
        Route::get('admin_jumper_dia', [AdminController::class, 'jumper_dia'])->name('admin.jumper_dia')->middleware('permission:otro.admi');
        Route::get('admin_users_paying', [AdminController::class, 'users_paying'])->name('admin.users_paying')->middleware('permission:administracion_principal');
        Route::get('admin_users_free', [AdminController::class, 'users_free'])->name('admin.users_free')->middleware('permission:administracion_principal');
        Route::get('admin_users', [AdminController::class, 'users'])->name('admin.users')->middleware('permission:administracion_principal');
        Route::get('admin_pagos', [AdminController::class, 'pagos'])->name('admin.pagos')->middleware('permission:administracion_principal');
        Route::get('admin_jumpers', [AdminController::class, 'jumpers'])->name('admin.jumpers')->middleware('permission:administracion_principal');
        Route::get('admin_links_gener', [AdminController::class, 'links_gener'])->name('admin.links_gener')->middleware('permission:otro.admin');
        Route::get('admin_ganancias', [AdminController::class, 'ganancias'])->name('admin.ganancias.index')->middleware('permission:administracion_principal');
        Route::get('sales', [AdminController::class, 'sales'])->name('admin.sales')->middleware('permission:admin.sales');
        Route::get('marketplace_venta', [AdminController::class, 'marketplace'])->name('admin.marketplace')->middleware('permission:admin.sales');
        Route::get('marketplace_compra', [AdminController::class, 'marketplace_compra'])->name('admin.marketplace.compra')->middleware('permission:admin.marketplace.compras');
        Route::resource('roles', RoleController::class)->only('index','edit','update','destroy','create','store')->names('admin.roles')->middleware('permission:admin.roles');
        Route::get('comentarios', [AdminController::class, 'comentarios'])->name('admin.comentarios.index')->middleware('permission:administracion_principal');
    });
});


