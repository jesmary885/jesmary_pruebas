<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JumpersController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\PsidController;
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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/home', [HomeController::class,'index'])->name('home');
});

Route::middleware(['auth'])->group(function()
{
    //Jumpers
    Route::get('cint/{jumper?}/{link_complete?}',[JumpersController::class,'cint'])->name('cint.index');
    Route::get('internals/{jumper?}/{link_complete?}',[JumpersController::class,'internals'])->name('internals.index');
    Route::get('k100/{jumper?}/{link_complete?}',[JumpersController::class,'kmil'])->name('kmil.index');
    Route::get('k1092/{jumper?}/{link_complete?}',[JumpersController::class,'kmilnoventaydos'])->name('kmilnoventaydos.index');
    Route::get('k2062/{jumper?}/{link_complete?}',[JumpersController::class,'kdosmilsesentaydos'])->name('kdosmilsesentaydos.index');
    Route::get('k23/{jumper?}/{link_complete?}',[JumpersController::class,'kveintitres'])->name('kveintitres.index');
    Route::get('k7341/{jumper?}/{link_complete?}',[JumpersController::class,'ksietemilcuarentayuno'])->name('ksietemilcuarentayuno.index');
    Route::get('prodege/{jumper?}/{link_complete?}',[JumpersController::class,'prodege'])->name('prodege.index');
    Route::get('samplicio/{jumper?}/{link_complete?}',[JumpersController::class,'samplicio'])->name('samplicio.index');
    Route::get('scube/{jumper?}/{link_complete?}',[JumpersController::class,'scube'])->name('scube.index');
    Route::get('spectrum/{jumper?}/{link_complete?}',[JumpersController::class,'spectrum'])->name('spectrum.index');
    Route::get('toluna/{jumper?}/{link_complete?}',[JumpersController::class,'toluna'])->name('toluna.index');
    Route::get('ssidkr/{jumper?}/{link_complete?}',[JumpersController::class,'ssidkr'])->name('ssidkr.index');

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
    //PID
    Route::get('register_pid',[PsidController::class,'index_pid'])->name('registro.pid');
    //BLOC
    Route::get('bloc',[PsidController::class,'index_bloc'])->name('registro.bloc');

    //Administración

    Route::get('admin_users', [AdminController::class, 'users'])->name('admin.users')->middleware('permission:administracion_principal');
    Route::get('admin_jumpers', [AdminController::class, 'jumpers'])->name('admin.jumpers')->middleware('permission:administracion_principal');
    Route::get('admin_ganancias', [AdminController::class, 'ganancias'])->name('admin.ganancias.index')->middleware('permission:administracion_principal');
    Route::get('sales', [AdminController::class, 'sales'])->name('admin.sales')->middleware('permission:admin.sales');
    Route::get('marketplace_venta', [AdminController::class, 'marketplace'])->name('admin.marketplace')->middleware('permission:admin.sales');
    Route::get('marketplace_compra', [AdminController::class, 'marketplace_compra'])->name('admin.marketplace.compra')->middleware('permission:admin.marketplace.compras');
    Route::resource('roles', RoleController::class)->only('index','edit','update','destroy','create','store')->names('admin.roles')->middleware('permission:admin.roles');
});


