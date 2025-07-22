<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JumpersController;
use App\Http\Controllers\KtmrController;
use App\Http\Controllers\LinksGenradosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PsidController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SobrenosotrosController;
use App\Http\Controllers\SpotifyController;
use App\Http\Livewire\Chat\ChatComponent;
use App\Http\Livewire\Pid\Register;
use App\Models\Marketplace;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

use function Ramsey\Uuid\v1;

Route::get('/', function () {
    return view('auth.login');
})->name('login_guest');

Route::post('log', [LoginController::class, 'authenticate'])->name('log');

Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

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
     //REPORTAR PAGO
     Route::get('reportar_pago',[PagoController::class,'index'])->name('reporte_pago');
     Route::get('informacion',[LinksGenradosController::class,'index_informacion'])->name('informacion');
     
    Route::middleware(['active'])->group(function(){

        Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');

        Route::get('/pva-debug', function() {
    $service = app(\App\Services\PvaDealsService::class);
    $response = $service->getServiceRequests();
    
    return response()->json([
        'response' => $response,
        'php_version' => phpversion(),
        'memory' => memory_get_usage(true)
    ]);
});


Route::get('/test-pva-auth', function() {
    $methods = [
        ['X-API-KEY' => config('services.pvadeals.api_key')],
        ['Authorization' => 'Bearer '.config('services.pvadeals.api_key')],
        ['x-api-key' => config('services.pvadeals.api_key')],
        ['api-key' => config('services.pvadeals.api_key')]
    ];
    
    $results = [];
    $client = new \GuzzleHttp\Client(['base_uri' => 'https://prod-v3.pvadeals.com/v3']);
    
    foreach ($methods as $method) {
        try {
            $response = $client->get('/getServiceRequests', [
                'headers' => $method + ['Accept' => 'application/json'],
                'http_errors' => false
            ]);
            
            $results[] = [
                'method' => array_keys($method)[0],
                'status' => $response->getStatusCode(),
                'response' => substr($response->getBody()->getContents(), 0, 200)
            ];
        } catch (\Exception $e) {
            $results[] = [
                'method' => array_keys($method)[0],
                'error' => $e->getMessage()
            ];
        }
    }
    
    return response()->json($results);
});

        //Jumpers
        Route::get('k1000-PS',[JumpersController::class,'kmil_poderosa1'])->name('kmil_poderosa1.index')->middleware('permission:menu.premium');
        Route::get('k1000-PM',[JumpersController::class,'kmil_poderosa2'])->name('kmil_poderosa2.index')->middleware('permission:menu.premium');
        Route::get('k23-P-K2',[JumpersController::class,'k23_poderosa'])->name('k23_poderosa.index')->middleware('permission:menu.premium');
        Route::get('k23-P',[JumpersController::class,'k23_poderosa_SK2'])->name('k23_poderosa_SK2.index')->middleware('permission:menu.premium');
        Route::get('k1083',[JumpersController::class,'k1083'])->name('k1083.index')->middleware('permission:menu.premium');
        Route::get('ktmr_ssi',[JumpersController::class,'ktmr_ssi'])->name('ktmr_ssi.index')->middleware('permission:menu.premium');
        Route::get('ipso',[JumpersController::class,'ipso'])->name('ipso.index')->middleware('permission:menu.premium');

        Route::get('k23-P-K2v2',[JumpersController::class,'k23_poderosa_v2'])->name('k23_poderosav2.index')->middleware('permission:menu.premium.v2');
        Route::get('k1083v2',[JumpersController::class,'k1083_v2'])->name('k1083v2.index')->middleware('permission:menu.premium.v2');
        Route::get('detector',[JumpersController::class,'detector'])->name('version.index')->middleware('permission:menu.premium.v2');

        Route::get('k1093',[JumpersController::class,'k1093'])->name('k1093.index');
        Route::get('k1093_easurveytaker',[JumpersController::class,'k1093_bea'])->name('k1093_bea.index')->middleware('permission:menu.premium');
        Route::get('k7107',[JumpersController::class,'k7107'])->name('k7107.index');
        Route::get('k5541',[JumpersController::class,'k5541'])->name('k5541.index');
        Route::get('k2000',[JumpersController::class,'k2000'])->name('k2000.index');
        Route::get('k1091',[JumpersController::class,'k1091'])->name('k1091.index');
        Route::get('k2028',[JumpersController::class,'k2028'])->name('k2028.index');
        Route::get('k5460',[JumpersController::class,'k5460'])->name('k5460.index');
        Route::get('k6057',[JumpersController::class,'k6057'])->name('k6057.index');
        Route::get('k2066',[JumpersController::class,'k2066'])->name('k2066.index');
        Route::get('k7341-P',[JumpersController::class,'k7341_poderosa'])->name('k7341_poderosa.index');
        Route::get('k2066-P',[JumpersController::class,'k2066_poderosa'])->name('k2066_poderosa.index');
        Route::get('cint',[JumpersController::class,'cint'])->name('cint.index');
        Route::get('cint_2',[JumpersController::class,'cint2'])->name('cint2.index');
        Route::get('internals',[JumpersController::class,'internals'])->name('internals.index');
        Route::get('k1000',[JumpersController::class,'kmil'])->name('kmil.index');
        Route::get('k1092',[JumpersController::class,'kmilnoventaydos'])->name('kmilnoventaydos.index');
        Route::get('k2062',[JumpersController::class,'kdosmilsesentaydos'])->name('kdosmilsesentaydos.index');
        Route::get('k23',[JumpersController::class,'kveintitres'])->name('kveintitres.index');
        Route::get('k3203',[JumpersController::class,'k3203'])->name('k3203.index');
        Route::get('k2049',[JumpersController::class,'k2049'])->name('k2049.index');
        Route::get('k3906',[JumpersController::class,'k3906'])->name('k3906.index');
        Route::get('k11052',[JumpersController::class,'k11052'])->name('k11052.index');
        Route::get('k10125',[JumpersController::class,'k10125'])->name('k10125.index');
        Route::get('k15293',[JumpersController::class,'k15293'])->name('k15293.index');
        Route::get('k10611',[JumpersController::class,'k10611'])->name('k10611.index');
        Route::get('k4453',[JumpersController::class,'k4453'])->name('k4453.index');
        Route::get('k17564',[JumpersController::class,'k17564'])->name('k17564.index');
        Route::get('k3889',[JumpersController::class,'k3889'])->name('k3889.index');
        Route::get('k11483',[JumpersController::class,'k11483'])->name('k11483.index');
        Route::get('k1098',[JumpersController::class,'k1098'])->name('k1098.index');
        Route::get('k7341',[JumpersController::class,'ksietemilcuarentayuno'])->name('ksietemilcuarentayuno.index');
        //Route::get('prodege',[JumpersController::class,'prodege'])->name('prodege.index');

        Route::get('samplicio_centiment',[JumpersController::class,'samplicio'])->name('samplicio.index');
        Route::get('samplicio_index',[JumpersController::class,'samplicio_index'])->name('samplicio2.index');
        Route::get('samplicio_p',[JumpersController::class,'samplicio_p'])->name('samplicio_p.index');
        Route::get('samplicio_bz',[JumpersController::class,'samplicio_bz'])->name('samplicio_bz.index');
        Route::get('samplicio_tw',[JumpersController::class,'samplicio_tw'])->name('samplicio_tw.index');
        Route::get('samplicio_cash',[JumpersController::class,'samplicio_cash'])->name('samplicio_cash.index');
        Route::get('prodege_index',[JumpersController::class,'prodege_index'])->name('prodege.index');
        Route::get('prodege_generador',[JumpersController::class,'prodege_generador'])->name('prodege.generador');
        
        Route::get('scube',[JumpersController::class,'scube'])->name('scube.index');

        Route::get('spectrum',[JumpersController::class,'spectrum_principal'])->name('spectrum_principal.index');
        Route::get('spectrum_1',[JumpersController::class,'spectrum'])->name('spectrum.index');
        Route::get('spectrum_2',[JumpersController::class,'spectrum2'])->name('spectrum2.index');
        Route::get('spectrum_3',[JumpersController::class,'spectrum3'])->name('spectrum3.index');
        Route::get('spectrum_4',[JumpersController::class,'spectrum4'])->name('spectrum4.index');

        Route::get('internal',[JumpersController::class,'interno'])->name('interno.index');

        Route::get('toluna',[JumpersController::class,'toluna'])->name('toluna.index');
        Route::get('toluna_2',[JumpersController::class,'toluna2'])->name('toluna2.index');

        Route::get('paradigsample',[JumpersController::class,'paradigsample'])->name('paradigsample.index');
        Route::get('invite.mindsharesurvey',[JumpersController::class,'invite'])->name('invite.index');
        Route::get('edgeapi',[JumpersController::class,'edgeapi'])->name('edgeapi.index');
        Route::get('research.roirocket',[JumpersController::class,'research'])->name('research.index');
        Route::get('samplecube',[JumpersController::class,'samplecube'])->name('samplecube.index');
        Route::get('samplicity',[JumpersController::class,'samplicity'])->name('samplicity.index');
        Route::get('sayso',[JumpersController::class,'sayso'])->name('sayso.index');
        Route::get('opinion',[JumpersController::class,'opinion'])->name('opinion.index');
        Route::get('survey_emirs',[JumpersController::class,'survey_emirs'])->name('survey_emirs.index');

        Route::get('ssidkr',[JumpersController::class,'ssidkr'])->name('ssidkr.index');
        Route::get('k10634',[JumpersController::class,'k10634'])->name('k10634.index');
        Route::get('k11619',[JumpersController::class,'k11619'])->name('k11619.index');
        Route::get('k10659',[JumpersController::class,'k10659'])->name('k10659.index');

        Route::get('descalificador',[JumpersController::class,'descalificador'])->name('descalificador.index');
        Route::get('wix',[JumpersController::class,'wix'])->name('wix.index');

        Route::get('bitlab',[JumpersController::class,'bitlab'])->name('bitlab.index');
        Route::get('pollfish',[JumpersController::class,'pollfish'])->name('pollfish.index');
        Route::get('swagbucks',[JumpersController::class,'swagbucks'])->name('swagbucks.index');
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

        //VER LINKS GENERADOS E INFORMACIOND E INTERES

        Route::get('links_generados',[LinksGenradosController::class,'index'])->name('ver_links_generados');
        

        Route::get('info',[LinksGenradosController::class,'info'])->name('info');
       
        //PID
        Route::get('register_pid',[PsidController::class,'index_pid'])->name('registro.pid');
        Route::get('limpiar_pid',[PsidController::class,'limpiar_pid'])->name('limpiar.pid');
        //BLOC
        Route::get('bloc',[PsidController::class,'index_bloc'])->name('registro.bloc');



        ///////////////GENERADORES NUEVOS

        Route::get('generador_pstart',[JumpersController::class,'generador_new_qt'])->name('generador_qt.index')->middleware('permission:menu.premium');
        Route::get('generador_p_qt_2',[JumpersController::class,'generador_new_qt_2'])->name('generador_qt_2.index')->middleware('permission:menu.premium');
         Route::get('numero',[JumpersController::class,'numero'])->name('numero.index')->middleware('permission:numeros.pva');
      //  Route::get('generador_p_vo',[JumpersController::class,'generador_new_vo'])->name('generador_vo.index')->middleware('permission:menu.premium');

        Route::get('Polltastic',[JumpersController::class,'pollsaltador'])->name('poll.saltador')->middleware('permission:menu.premium');
        Route::get('Polltastic_preguntas',[JumpersController::class,'pollpreguntas'])->name('poll.preguntas')->middleware('permission:menu.premium');
        Route::get('Polltastic_edad_preguntas',[JumpersController::class,'polledad'])->name('poll.edad')->middleware('permission:menu.premium');


        Route::get('Panel1',[JumpersController::class,'panel1Login'])->name('panel1.login')->middleware('permission:menu.premium');
        Route::get('Panel1_Start',[JumpersController::class,'panel1Start'])->name('panel1.start')->middleware('permission:menu.premium');
        Route::get('Panel1_Jumper',[JumpersController::class,'panel1Jumper'])->name('panel1.jumper')->middleware('permission:menu.premium');

        Route::get('Panel2',[JumpersController::class,'panel2Login'])->name('panel2.login')->middleware('permission:menu.premium');
        Route::get('Panel2_Start',[JumpersController::class,'panel2Start'])->name('panel2.start')->middleware('permission:menu.premium');
        Route::get('Panel2_Jumper',[JumpersController::class,'panel2Jumper'])->name('panel2.jumper')->middleware('permission:menu.premium');

        Route::get('Panel3',[JumpersController::class,'panel3Login'])->name('panel3.login')->middleware('permission:premium.admin');

        Route::get('Inbrain_rex',[JumpersController::class,'inbrainrex'])->name('inbrain.rex')->middleware('permission:menu.premium');
        Route::get('Inbrain_profiled',[JumpersController::class,'inbrainprofiled'])->name('inbrain.profiled')->middleware('permission:menu.premium');
        Route::get('Inbrain_wix',[JumpersController::class,'inbrainwix'])->name('inbrain.wix')->middleware('permission:menu.premium');
        Route::get('Inbrain_start',[JumpersController::class,'inbrainstart'])->name('inbrain.start')->middleware('permission:menu.premium');

        Route::get('Cpx_listar',[JumpersController::class,'cpxListar'])->name('cpxListar')->middleware('permission:premium.vip');
        Route::get('Cpx_listar_2',[JumpersController::class,'cpxListar_2'])->name('cpxListar_2')->middleware('permission:premium.vip');
        Route::get('Cpx_generar',[JumpersController::class,'cpxGenerar'])->name('cpxGenerar')->middleware('permission:premium.vip');
        Route::get('Cpx_calificador',[JumpersController::class,'cpxCalificador'])->name('cpxCalificador')->middleware('permission:premium.vip');
        Route::get('Cpx_jumper',[JumpersController::class,'cpxJumper'])->name('cpxJumper')->middleware('permission:premium.vip');

         Route::get('Adscenmecia_listar',[JumpersController::class,'AdscenmeciaListar'])->name('AdscenmeciaListar')->middleware('permission:premium.vip');
          Route::get('Adscenmecia_saltador',[JumpersController::class,'Adscenmecia_saltador'])->name('AdscenmeciaSaltador')->middleware('permission:premium.vip');

        //COMUNIDAD

        Route::get('admin_links_gener', [AdminController::class, 'links_gener'])->name('admin.links_gener')->middleware('permission:administracion_principal');
        Route::get('admin_k_nuevas', [AdminController::class, 'k_nuevas'])->name('admin.k_nuevas')->middleware('permission:administracion_principal');
        Route::get('admin_comunidad', [AdminController::class, 'comunidad'])->name('admin.comunidad')->middleware('permission:administracion_principal');
        Route::get('admin_jumper_dia', [AdminController::class, 'jumper_dia'])->name('admin.jumper_dia')->middleware('permission:administracion_principal');
        Route::get('admin_canje', [AdminController::class, 'canje'])->name('admin.canje')->middleware('permission:administracion_principal');
        Route::get('k1020', [JumpersController::class, 'k1020'])->name('k1020.index')->middleware('permission:administracion_principal');

        //Administración

        Route::get('yoursurveynow',[JumpersController::class,'yoursurveynow'])->name('admin.yoursurveynow')->middleware('permission:menu.premium');
        Route::get('login_spotify', [SpotifyController::class, 'login'])->name('login_spotify');
        Route::get('profile_spotify', [SpotifyController::class, 'getUser'])->name('profile_spotify');
        Route::get('music_spotify', [SpotifyController::class, 'getMusic'])->name('music_sp');

        Route::get('admin_users_jumper', [AdminController::class, 'users_jump'])->name('admin.users_jump.index')->middleware('permission:administracion_principal');
        Route::get('admin_multilogin', [AdminController::class, 'multilogin'])->name('admin.multilogin.index')->middleware('permission:administracion_principal');
        Route::get('admin_modificaciones', [AdminController::class, 'modificaciones'])->name('admin.modificaciones')->middleware('permission:administracion_principal');
        Route::get('admin_tasa_cambio', [AdminController::class, 'tasa_cambio'])->name('admin.tasa_cambio')->middleware('permission:administracion_principal');
        Route::get('admin_cuentas_usuarios', [AdminController::class, 'cuentas_psid'])->name('admin.cuentas_psid')->middleware('permission:administracion_principal');

        Route::get('admin_users_paying', [AdminController::class, 'users_paying'])->name('admin.users_paying')->middleware('permission:administracion_principal');
        Route::get('admin_users_free', [AdminController::class, 'users_free'])->name('admin.users_free')->middleware('permission:administracion_principal');
        Route::get('admin_users', [AdminController::class, 'users'])->name('admin.users')->middleware('permission:administracion_principal');
        Route::get('admin_pagos', [AdminController::class, 'pagos'])->name('admin.pagos')->middleware('permission:administracion_principal');
        Route::get('admin_jumpers', [AdminController::class, 'jumpers'])->name('admin.jumpers')->middleware('permission:administracion_principal');

        Route::get('admin_ganancias', [AdminController::class, 'ganancias'])->name('admin.ganancias.index')->middleware('permission:administracion_principal');
        Route::get('sales', [AdminController::class, 'sales'])->name('admin.sales')->middleware('permission:admin.sales');
        Route::get('marketplace_venta', [AdminController::class, 'marketplace'])->name('admin.marketplace')->middleware('permission:admin.sales');
        Route::get('marketplace_compra', [AdminController::class, 'marketplace_compra'])->name('admin.marketplace.compra')->middleware('permission:admin.marketplace.compras');
        Route::resource('roles', RoleController::class)->only('index','edit','update','destroy','create','store')->names('admin.roles')->middleware('permission:admin.roles');
        Route::get('comentarios', [AdminController::class, 'comentarios'])->name('admin.comentarios.index')->middleware('permission:administracion_principal');
    
        //KTMR
        Route::get('generador_ktmr', [KtmrController::class, 'generador'])->name('ktmr.generador.index')->middleware('permission:menu.ktmr');
        Route::get('cuentas_registradas_ktmr', [KtmrController::class, 'cuentas'])->name('ktmr.cuentas.index')->middleware('permission:menu.ktmr');

        Route::get('administracion_usuarios_ktmr', [KtmrController::class, 'administracion'])->name('ktrm.administracion.index')->middleware('permission:administracion.ktmr');
        Route::get('administracion_cuentas_ktmr', [KtmrController::class, 'administracion_cuentas'])->name('ktrm.administracion_cuentas.index')->middleware('permission:administracion.ktmr');
    

        //ENCUESTAR

        Route::get('encuestar',[JumpersController::class,'encuestar'])->name('encuestar.index')->middleware('permission:menu.encuestar');
    });
});


