<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'QuerySet',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => null,
    'logo_img' => 'storage/logo/LOGO_DEFINITIVO.jpg',
    'logo_img_class' => 'w-full h-full mx-auto my-0 d-block',
    'logo_img_xl' => null,
    'logo_img_xl_class' => null,
    'logo_img_alt' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => 'dark-mode',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-dark',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-dark',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => true,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        [
            'text'    => 'ADMINISTRACIÓN',
            'icon'    => 'fas fa-file-invoice-dollar fa-fw',
            'can' => 'administracion_principal',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'route'  => 'admin.users',
                    'icon'    => 'fas fa-users',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],
                [
                    'text' => 'Usuarios pagos',
                    'route'  => 'admin.users_paying',
                    'icon'    => 'fas fa-users',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],
                [
                    'text' => 'Usuarios Gratis',
                    'route'  => 'admin.users_free',
                    'icon'    => 'fas fa-users',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Cuentas de usuarios',
                    'route'  => 'admin.cuentas_psid',
                    'icon'    => 'fas fa-users',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

               

                [
                    'text' => 'Tasa de cambio',
                    'route'  => 'admin.tasa_cambio',
                    'icon'    => 'far fa-credit-card',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Jumpers',
                    'route'  => 'admin.jumpers',
                    'icon'    => 'fas fa-server',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],
                
                [
                    'text' => 'Pagos',
                    'route'  => 'admin.pagos',
                    'icon_color' => 'red',
                    'icon'    => 'far fa-credit-card',
                    'can' => 'administracion_principal'
                ],

                // [
                //     'text' => 'Ganancias',
                //     'route'  => 'admin.ganancias.index',
                //     'icon_color' => 'red',
                //     'icon'    => 'fas fa-heart',
                //     'can' => 'administracion_principal'
                // ],
                [
                    'text' => 'Comentarios',
                    'route'  => 'admin.comentarios.index',
                    'icon_color' => 'red',
                    'icon'    => 'fab fa-facebook-messenger',
                    'can' => 'administracion_principal'
                ],
                [
                    'text' => 'Usuarios Multilogin',
                    'route'  => 'admin.multilogin.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-exclamation-triangle',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Cant de Jump por usuarios',
                    'route'  => 'admin.users_jump.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-users',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Modificaciones en usuarios',
                    'route'  => 'admin.modificaciones',
                    'icon_color' => 'red',
                    'icon'    => 'fab fa-facebook-messenger',
                    'can' => 'administracion_principal'
                ],

                

            ],
            
        ],

        // [
        //     'text'    => 'SALE MARKET',
        //     'icon'    => 'fas fa-cart-arrow-down',
        //     'can' => 'admin.sales',
        //     'icon_color' => 'cyan',
        //     'submenu' => [
        //         [
        //             'text' => 'Mi marketplace',
        //             'route'  => 'admin.marketplace',
        //             'icon'    => 'fas fa-box-open',
        //             'can' => 'admin.sales',
        //             'icon_color' => 'red',
        //         ],
        //         [
        //             'text' => 'Mis ventas',
        //             'route'  => 'admin.sales',
        //             'icon'    => 'fas fa-hand-holding-heart',
        //             'can' => 'admin.sales',
        //             'icon_color' => 'red',
        //         ],
        //     ],
        // ],

        // [
        //     'text'    => 'SHOPPING MARKET',
        //     'icon'    => 'fab fa-cc-amazon-pay',
        //     'can' => 'admin.marketplace.compras',
        //     'icon_color' => 'cyan',
        //     'submenu' => [
        //         [
        //             'text' => 'Mi marketplace',
        //             'route'  => 'admin.marketplace.compra',
        //             'icon'    => 'fas fa-box-open',
        //             'icon_color' => 'red',
        //             'can' => 'admin.marketplace.compras'
        //         ],
        //     ],
        // ],

        [
            'text'    => 'COMUNIDAD',
            'icon'    => 'fas fa-users',
            'can' => 'administracion_principal',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Dashboard',
                    'route'  => 'admin.comunidad',
                    'icon'    => 'fas fa-clone',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],
                [
                    'text' => 'Links generados',
                    'route'  => 'admin.links_gener',
                    'icon'    => 'fas fa-server',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Cant de jumpers generados',
                    'route'  => 'admin.jumper_dia',
                    'icon'    => 'fas fa-server',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Links de nuevas K',
                    'route'  => 'admin.k_nuevas',
                    'icon'    => 'fas fa-server',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],

                [
                    'text' => 'Canjes',
                    'route'  => 'admin.canje',
                    'icon'    => 'fas fa-cash-register',
                    'icon_color' => 'red',
                    'can' => 'administracion_principal'
                ],


                // [
                //     'text' => 'K1020',
                //     'route'  => 'k1020.index',
                //     'can' => 'administracion_principal',
                //     'icon_color' => 'cyan',
                //     'icon'    => 'fas fa-search',
                // ],

            ],
        ],


         [
             'type'         => 'fullscreen-widget',
             'topnav_right' => true,
         ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'search',
        // ],
      
        ['header' => 'JUMPERS'],

        [
            'text' => 'Su cuenta esta inactiva',
            'can' => 'cuenta.inactiva',
            'icon_color' => 'cyan',
            'icon'    => '	fas fa-sad-cry',
        ],






      /*  [
            'text' => 'YOURSURVEYNOW',
            'route'  => 'admin.yoursurveynow',
            'icon_color' => 'red',
            'icon'    => 'fas fa-crown',
            'can' => 'menu.premium',
        ],
*/
        [
            'text' => 'ENCUESTAR',
            'route'  => 'encuestar.index',
            'icon_color' => 'red',
            'icon'    => '	fab fa-elementor',
            'can' => 'menu.encuestar',
        ],

         [
            'text'    => 'numeros',
            'icon'    => 'fas fa-search',
            'can' => 'numeros.pva',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'numero.index',
                    'can' => 'numeros.pva',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'GENERADORES SSI',
            'icon'    => 'fas fa-search',
            'can' => 'menu.premium',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Pstart_web_QT',
                    'route'  => 'generador_qt.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                // [
                //     'text' => 'Generador VO & OO',
                //     'route'  => 'generador_vo.index',
                //     'can' => 'menu.premium',
                //     'icon_color' => 'red',
                //     'icon'    => 'fas fa-angle-right',
                // ],

                [
                    'text' => 'Premium',
                    'route'  => 'generador_qt_2.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

      


        [
            'text'    => 'SSI',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'SSI DKR',
                    'route'  => 'ssidkr.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
                [
                    'text' => 'SALTADOR WIX',
                    'route'  => 'wix.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'KTRMR',
                    'route'  => 'ktmr.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                
                [
                    'text' => 'K1000',
                    'route'  => 'kmil.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K1091',
                    'route'  => 'k1091.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K1092',
                    'route'  => 'kmilnoventaydos.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
               [
                    'text' => 'K1093 nielsen',
                    'route'  => 'k1093.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
               
                [
                    'text' => 'K1098',
                    'route'  => 'k1098.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K2000',
                    'route'  => 'k2000.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],


                [
                    'text' => 'K2028',
                    'route'  => 'k2028.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
               /*[
                    'text' => 'K2001',
                    'route'  => 'k2001.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],*/
                [
                    'text' => 'K2049',
                    'route'  => 'k2049.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K2062',
                    'route'  => 'kdosmilsesentaydos.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K2066',
                    'route'  => 'k2066.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                    
                ],
                [
                    'text' => 'K2066',
                    'route'  => 'k2066_poderosa.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                    'label'       => 'New security',
                    'label_color' => 'danger',
                ],
                [
                     'text' => 'K23',
                     'route'  => 'kveintitres.index',
                     'can' => 'ssidkr.index',
                     'icon_color' => 'red',
                     'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K3203',
                    'route'  => 'k3203.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                // [
                //     'text' => 'K3906',
                //     'route'  => 'k3906.index',
                //     'can' => 'ssidkr.index',
                //     'icon_color' => 'red',
                //     'icon'    => '	fas fa-angle-right',
                // ],

                [
                    'text' => 'k3889',
                    'route'  => 'k3889.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'k4453',
                    'route'  => 'k4453.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                

                [
                    'text' => 'K5460',
                    'route'  => 'k5460.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K5541',
                    'route'  => 'k5541.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K6057',
                    'route'  => 'k6057.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K7107',
                    'route'  => 'k7107.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K7341 New',
                    'route'  => 'k7341_poderosa.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K7341',
                    'route'  => 'ksietemilcuarentayuno.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K10125',
                    'route'  => 'k10125.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K10611',
                    'route'  => 'k10611.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K10634',
                    'route'  => 'k10634.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K10659',
                    'route'  => 'k10659.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K11052',
                    'route'  => 'k11052.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K11483',
                    'route'  => 'k11483.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K11619',
                    'route'  => 'k11619.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K15293',
                    'route'  => 'k15293.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
                [
                    'text' => 'K17564',
                    'route'  => 'k17564.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],
            ],
            
        ],

         [
            'text'    => 'SSI PREMIUM',
            'icon'    => 'fas fa-crown',
            'can' => 'menu.premium',
            'icon_color' => 'red',
            'submenu' => [
                [
                    'text' => 'Identificador de versión',
                    'route'  => 'version.index',
                    'can' => 'menu.premium.v2',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
                [
                    'text' => 'K1000 Selfserve',
                    'route'  => 'kmil_poderosa1.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
               /* [
                    'text' => 'K1000 MCG',
                    'route'  => 'kmil_poderosa2.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],*/
              /*  [
                    'text' => 'K1083 V1',
                    'route'  => 'k1083.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'K1083 V2',
                    'route'  => 'k1083v2.index',
                    'can' => 'menu.premium.v2',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],

                [
                    'text' => 'k1093 beasurveytaker',
                    'route'  => 'k1093_bea.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],*/
               
                [
                    'text' => 'K23 V1',
                    'route'  => 'k23_poderosa.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                    'label'       => 'With K2',
                    'label_color' => 'danger',
                ],

                [
                    'text' => 'K23 V2',
                    'route'  => 'k23_poderosav2.index',
                    'can' => 'menu.premium.v2',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                    'label'       => 'With K2',
                    'label_color' => 'danger',
                ],

                [
                    'text' => 'K23',
                    'route'  => 'k23_poderosa_SK2.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',

                ],

                [
                    'text' => 'IPSO INTERACTIVE',
                    'route'  => 'ipso.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',

                ],

               /* [
                    'text' => 'KTRMR SSI',
                    'route'  => 'ktmr_ssi.index',
                    'can' => 'menu.premium',
                    'icon_color' => 'red',
                    'icon'    => '	fas fa-angle-right',
                ],*/
                
            ],            
        ],

         [
            'text'    => 'ADSCENMEDIA',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Listar encuestas',
                    'route'  => 'AdscenmeciaListar',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                 [
                    'text' => 'Saltador',
                    'route'  => 'AdscenmeciaSaltador',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

        
            ],
        ],


         [
            'text'    => 'CPX',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Listar encuestas',
                    'route'  => 'cpxListar',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'label'       => '1',
                    'icon'    => 'fas fa-angle-right',
                ],

                  [
                    'text' => 'Listar encuestas',
                    'label'       => '2',
                    'route'  => 'cpxListar_2',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                 [
                    'text' => 'Calificador de encuesta',
                    'route'  => 'cpxCalificador',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Generador de encuesta',
                    'route'  => 'cpxGenerar',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Jumper',
                    'route'  => 'cpxJumper',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],


        [
            'text'    => 'CINT',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador Nº 1',
                    'route'  => 'cint.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Buscador Nº 2',
                    'route'  => 'cint2.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

        [
            'text'    => 'EDGEAPI',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'edgeapi.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'INTERNOS',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'interno.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

   

        [
            'text'    => 'INBRAIN',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'InBrain Rex',
                    'route'  => 'inbrain.rex',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'InBrain saltador profiled',
                    'route'  => 'inbrain.profiled',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'InBrain saltador wix',
                    'route'  => 'inbrain.wix',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'InBrain saltador start',
                    'route'  => 'inbrain.start',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

             [
            'text'    => 'MINDSHARESURVEY',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'invite.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'OPINION NETWORK',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'opinion.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

         [
            'text'    => 'PANEL 1',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'login',
                    'route'  => 'panel1.login',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Start',
                    'route'  => 'panel1.start',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Jumper',
                    'route'  => 'panel1.jumper',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

        [
            'text'    => 'PANEL 2',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'login',
                    'route'  => 'panel2.login',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Start',
                    'route'  => 'panel2.start',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Jumper',
                    'route'  => 'panel2.jumper',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

        [
            'text'    => 'PANEL 3',
            'icon'    => 'fas fa-search',
            'can' => 'premium.admin',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'login',
                    'route'  => 'panel3.login',
                    'can' => 'premium.admin',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

             
            ],
        ],

        [
            'text'    => 'PARADIGSAMPLE',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'paradigsample.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

           [
            'text'    => 'POLLTASTIC',
            'icon'    => 'fas fa-search',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Saltador de seguridad',
                    'route'  => 'poll.saltador',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Saltador de preguntas de seguridad',
                    'route'  => 'poll.preguntas',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Saltador de preguntas, edad.',
                    'route'  => 'poll.edad',
                    'can' => 'premium.vip',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],

     



        

    

       

        [
            'text'    => 'PRODEGE',
            'icon'    => 'fas fa-search',
            'can' => ['ssidkr.index'],
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'prodege.index',
                    'can' => ['ssidkr.index'],
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Generador',
                    'route'  => 'prodege.generador',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

            ],
        ],

           [
            'text'    => 'RESEARCH.ROIROCKET',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'research.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'SAMPLECUBE',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'samplecube.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'SAMPLICITY',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'samplicity.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'SAMPLICIO',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'samplicio2.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                /*[
                    'text' => 'Generador Premium',
                    'route'  => 'samplicio_p.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],*/

                [
                    'text' => 'Generador BZ',
                    'route'  => 'samplicio_bz.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Generador Cash Your Opinions',
                    'route'  => 'samplicio_cash.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Generador Centiment',
                    'route'  => 'samplicio.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                

                [
                    'text' => 'Generador Torfacts o Wisesample',
                    'route'  => 'samplicio_tw.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

            ],
        ],

        
        [
            'text'    => 'SALTADORES',
            'icon'    => 'fas fa-crown',
            'can' => 'premium.vip',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'BITLAB',
                    'route'  => 'bitlab.index',
                    'can' => 'premium.vip',
                    'icon_color' => 'cyan',
                    'icon'    => 'fas fa-search',
                ],
                [
                    'text' => 'POLLFISH',
                    'route'  => 'pollfish.index',
                    'can' => 'premium.vip',
                    'icon_color' => 'cyan',
                    'icon'    => 'fas fa-search',
                ],
                [
                    'text' => 'SWAGBUCKS',
                    'route'  => 'swagbucks.index',
                    'can' => 'premium.vip',
                    'icon_color' => 'cyan',
                    'icon'    => 'fas fa-search',
                ],

                
            ],
        ],

        [
            'text'    => 'SAYSO',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'sayso.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],

        [
            'text'    => 'SPECTRUM',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'spectrum_principal.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
                [
                    'text' => 'Generador Jdpoweronline',
                    'can' => 'ssidkr.index',
                    'route'  => 'spectrum4.index',
                    'icon'    => '	fas fa-angle-right',
                    'icon_color' => 'red',
                ],

                [
                    'text' => 'Generador Qualtrics',
                    'route'  => 'spectrum.index',
                    'icon'    => '	fas fa-angle-right',
                    'icon_color' => 'red',
                    'can' => 'ssidkr.index',
                ],

                [
                    'text' => 'Generador Selfserve',
                    'can' => 'ssidkr.index',
                    'route'  => 'spectrum3.index',
                    'icon'    => '	fas fa-angle-right',
                    'icon_color' => 'red',
                ],
                
                [
                    'text' => 'Generador Voicefive',
                    'icon'    => '	fas fa-angle-right',
                    'route'  => 'spectrum2.index',
                    'icon_color' => 'red',
                    'can' => 'ssidkr.index',
                ],

            ],
        ],

         [
            'text'    => 'SURVEY EMI-RS',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Buscador principal',
                    'route'  => 'survey_emirs.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                
            ],
        ],


        [
            'text'    => 'TOLUNA',
            'icon'    => 'fas fa-search',
            'can' => 'ssidkr.index',
            'icon_color' => 'cyan',
            'submenu' => [
                [
                    'text' => 'Generador Qualtric 1',
                    'route'  => 'toluna.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],

                [
                    'text' => 'Generador Qualtric 2',
                    'route'  => 'toluna2.index',
                    'can' => 'ssidkr.index',
                    'icon_color' => 'red',
                    'icon'    => 'fas fa-angle-right',
                ],
            ],
        ],


     



     


        


    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];