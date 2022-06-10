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

    'title' => 'SAILE',
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

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
     */

    'logo' => '',
    'logo_img' => 'vendor/adminlte/dist/img/logo-saile.png',
    'logo_img_class' => 'brand-image img-square ml-0',
    'logo_img_xl' => 'vendor/adminlte/dist/img/logo-saile.png',
    'logo_img_xl_class' => 'brand-image img-square',

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
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
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

    'classes_auth_card' => '',
    'classes_auth_header' => 'bg-gradient-info',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-lg text-info',
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

    'classes_body' => '',
    'classes_brand' => 'bg-light',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-primary sidebar-gray elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-dark navbar-info elevation-1',
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
    'sidebar_scrollbar_theme' => 'os-theme-light',
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
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
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

    'use_route_url' => false,
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
        // Sidebar items:
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
            
        ],

        ['header' => 'DATOS EMPRESARIALES',
        'can' => 'isManager'
        ],
        [
            'text' => 'Perfil',
            'url' => 'misdatos',
            'icon' => 'fas fa-fw fa-warehouse',
            'can' => 'isManager'
        ],
        [
            'text' => 'Usuarios',
            'url' => 'usuarios',
            'icon' => 'fas fa-fw fa-users-gear',
            'can' => 'isManager'
        ],
        [
            'text' => 'Notificaciones',
            'url' => 'notificaciones',
            'icon' => 'fas fa-fw fa-bell',
            'can' => 'isManager'
        ],
        // [
        //     'text' => 'Ordenes de Trabajo',
        //     'url' => 'ordenes',
        //     'icon' => 'fas fa-fw fa-file-pen',
        //     'can' => 'isManager'
        // ],

        ['header' => 'DATOS CLIENTES',
        'can' => 'isManager'
        ],
        [
            'text' => 'Clientes',
            'url' => 'clientes',
            'icon' => 'fas fa-fw fa-users',
            'can' => 'isManager'
        ],
        [
            'text' => 'Registro clientes',
            'url' => 'clientes/registercli',
            'icon' => 'fas fa-fw fa-address-book',
            'can' => 'isAdmin'

        ],

        ['header' => 'VALLAS',
        'can' => 'isWorker'
        ],
        [
            'text' => 'Vallas',
            'url' => 'vallas',
            'icon' => 'fas fa-fw fa-sign-hanging',
            'can' => 'isWorker'

        ],
        [
            'text' => 'Estado Valla',
            'url' => 'estados',
            'icon' => 'fas fa-fw fa-bars',
            'can' => 'isWorker'
        ],
        [
            'text' => 'Materiales',
            'url' => 'materiales',
            'icon' => 'fas fa-fw fa-gavel',
            'can' => 'isWorker'
        ],
        
        [
            'text' => 'Promociones',
            'url' => 'promociones',
            'icon' => 'fas fa-fw fa-calendar-check',
            'can' => 'isWorker'
        ],

        [
            'text' => 'Ordenes de Trabajo',
            'url' => 'ordenes',
            'icon' => 'fas fa-fw fa-person-digging',
            'can' => 'isWorker'
        ],

        [
            'text' => 'Ordenes Finalizadas',
            'url' => 'ordenes/completas',
            'icon' => 'fas fa-fw fa-clipboard-check',
            'can' => 'isWorker'
        ],

        [ 'header' => 'MAPAS',
        'can' => 'isWorker'
        ],
        [
            'text' => 'Mapas',
            'url' => 'vallas/mapas',
            'icon' => 'fas fa-fw fa-map',
            'can' => 'isWorker'
        ],
        [
            'text' => 'Mapa Contratos',
            'url' => 'vallas/mapasContrato',
            'icon' => 'fas fa-fw fa-map',
            'can' => 'isWorker'

        ],
        [
            'text' => 'Mapa Promociones',
            'url' => 'vallas/mapasPromocion',
            'icon' => 'fas fa-fw fa-map',
            'can' => 'isWorker'

        ],

        ['header' => 'CONTRATOS',
        'can' => 'isManager'
        ],
        [
            'text' => 'Contratos',
            'url' => 'contratos',
            'icon' => 'fas fa-fw fa-file-contract',
            'can' => 'isManager'
        ],
        [
            'text' => 'Contratos en Baja',
            'url' => 'contratos/bajas',
            'icon' => 'fas fa-fw fa-file-circle-xmark',
            'can' => 'isManager'
        ],

        ['header' => 'OCUPADAS',
        'can' => 'isManager'
        ],
        [
            'text' => 'Ver ocupaciones',
            'url' => 'vallas/ocupacion',
            'icon' => 'fas fa-fw fa-table-list',
            'can' => 'isManager'
        ],
        [
            'text' => 'Ocupación por valla',
            'url' => 'contratos/ocupacionPorVallas',
            'icon' => 'fas fa-fw fa-table-columns',
            'can' => 'isManager'
        ],

        ['header' => 'DISPONIBLES',
        'can' => 'isManager'
        ],
        [
            'text' => 'Vallas Disponibles',
            'url' => 'contratos/vallasDisponibles',
            'icon' => 'fas fa-fw fa-circle-check',
            'can' => 'isClient'
        ],
        [
            'text' => 'Vallas Prox. Disponibles',
            'url' => 'vallas/finalizando',
            'icon' => 'fas fa-fw fa-circle-question',
            'can' => 'isManager'
        ],

        
        // dropdown

        ['header' => 'EXTRA',
        'can' => 'isManager'
        ],
        [
            'text' => 'Exportar',
            'url' => 'exportar',
            'icon' => 'fas fa-fw fa-wrench',
            'can' => 'isManager'
        ],
        [
            'text' => 'Logs',
            'url' => 'log-viewer',
            'icon' => 'fas fa-fw fa-receipt',
            'can' => 'isManager'
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
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
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
        'Lightbox' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css',
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

    'livewire' => false,
];
