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

    'title' => 'Assets Control Monitoring System',
    'title_prefix' => '',
    'title_postfix' => '| DCT Total Solution',

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

    // 'logo' => '<b>Admin</b>LTE',
    'logo' => 'Assets Control<br><b>Monitoring System</b>',
    'logo_img' => 'assets/img/LOGO_MASTER-GRADASI.png',
    // 'logo_img_class' => 'brand-image elevation-3',
    'logo_img_class' => 'img-fluid mx-auto my-auto d-block',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Logo DCT',

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
        'enabled' => true,
        'img' => [
            'path' => 'assets/img/LOGO_MASTER-GRADASI.png',
            'alt' => 'Auth Logo',
            'class' => 'mx-auto d-block',
            'width' => 50,
            'height' => 50,
        ],
        'title' => 'Assets Control<br><b>Monitoring System</b>',
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
        'enabled' => true,
        'img' => [
            'path' => 'assets/img/LOGO_MASTER-GRADASI.png',
            'alt' => 'DCT Total Solution',
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

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
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
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => null,
    'password_reset_url' => null,
    'password_email_url' => null,
    'profile_url' => 'profile',

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
        // Navbar items:
        // [
        //     'type'         => 'navbar-search',
        //     'text'         => 'search',
        //     'topnav_right' => true,
        // ],
        // [
        //     'type'         => 'fullscreen-widget',
        //     'topnav_right' => true,
        // ],

        // Sidebar items:
        // [
        //     'type' => 'sidebar-menu-search',
        //     'text' => 'search',
        // ],
        // [
        //     'text' => 'blog',
        //     'url'  => 'admin/blog',
        //     'can'  => 'manage-blog',
        // ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        // ['header' => 'Master data'],
        [
            'text'    => 'Transaksi Peminjaman Kendaraan',
            'icon'    => 'fas fa-fw fa-truck',
            'can'     => [
                'peminjamanBaruKendaraan.index', 'peminjamanBaruKendaraan.create', 'peminjamanBaruKendaraan.store', 'peminjamanBaruKendaraan.review', 'peminjamanBaruKendaraan.approval', 'peminjamanBaruKendaraan.del',
                'peminjamanAktifKendaraan.index', 'peminjamanAktifKendaraan.returning', 'peminjamanAktifKendaraan.update',
                'approvalPengembalianKendaraan.index', 'approvalPengembalianKendaraan.review', 'approvalPengembalianKendaraan.approval',
                'riwayatPeminjamanKendaraan.index', 'riwayatPeminjamanKendaraan.detail',
            ],
            'submenu' => [
                [
                    'text' => 'Peminjaman Baru',
                    'route' => 'peminjamanBaruKendaraan.index',
                    'icon' => 'fas fa-fw fa-plus',
                    'active' => ['peminjaman-baru-kendaraan', 'regex:@^peminjaman-baru-kendaraan/[0-9]+/review$@'],
                    'can' => ['peminjamanBaruKendaraan.index', 'peminjamanBaruKendaraan.create', 'peminjamanBaruKendaraan.store', 'peminjamanBaruKendaraan.review', 'peminjamanBaruKendaraan.approval', 'peminjamanBaruKendaraan.del'],
                ],
                [
                    'text' => 'Peminjaman Aktif',
                    'route' => 'peminjamanAktifKendaraan.index',
                    'icon' => 'fas fa-fw fa-route',
                    'active' => ['peminjaman-aktif-kendaraan', 'regex:@^peminjaman-aktif-kendaraan/[0-9]+$@'],
                    'can' => ['peminjamanAktifKendaraan.index', 'peminjamanAktifKendaraan.returning', 'peminjamanAktifKendaraan.update'],
                ],
                [
                    'text' => 'Approval Pengembalian',
                    'route' => 'approvalPengembalianKendaraan.index',
                    'icon' => 'fas fa-fw fa-check',
                    'active' => ['approval-pengembalian-kendaraan', 'regex:@^approval-pengembalian-kendaraan/[0-9]+$@'],
                    'can' => ['approvalPengembalianKendaraan.index', 'approvalPengembalianKendaraan.review', 'approvalPengembalianKendaraan.approval'],
                ],
                [
                    'text' => 'Riwayat Peminjaman',
                    'route' => 'riwayatPeminjamanKendaraan.index',
                    'icon' => 'fas fa-fw fa-file-contract',
                    'active' => ['riwayat-peminjaman-kendaraan', 'regex:@^riwayat-peminjaman-kendaraan/[0-9]+$@'],
                    'can' => ['riwayatPeminjamanKendaraan.index', 'riwayatPeminjamanKendaraan.detail'],
                ],
            ]
        ],
        [
            'text' => 'Transaksi Peminjaman Tools',
            'icon' => 'fas fa-fw fa-hammer',
            'can' => [
                'peminjamanBaruTools.index', 'peminjamanBaruTools.create', 'peminjamanBaruTools.store', 'peminjamanBaruTools.review', 'peminjamanBaruTools.approval', 'peminjamanBaruTools.del',
                'peminjamanAktifTools.index', 'peminjamanAktifTools.create', 'peminjamanAktifTools.store', 'peminjamanAktifTools.returning', 'peminjamanAktifTools.update',
                'approvalPengembalianTools.index', 'approvalPengembalianTools.review', 'approvalPengembalianTools.approval',
                'riwayatPeminjamanTools.index', 'riwayatPeminjamanTools.detail',
            ],
            'submenu' => [
                [
                    'text' => 'Peminjaman Baru',
                    'route' => 'peminjamanBaruTools.index',
                    'icon' => 'fas fa-fw fa-plus',
                    'active' => ['peminjaman-baru-tools', 'regex:@^peminjaman-baru-tools/[0-9]+/review$@'],
                    'can' => ['peminjamanBaruTools.index', 'peminjamanBaruTools.create', 'peminjamanBaruTools.store', 'peminjamanBaruTools.review', 'peminjamanBaruTools.approval', 'peminjamanBaruTools.del'],
                ],
                [
                    'text' => 'Peminjaman Aktif',
                    'route' => 'peminjamanAktifTools.index',
                    'icon' => 'fas fa-fw fa-route',
                    'active' => ['peminjaman-aktif-tools', 'regex:@^peminjaman-aktif-tools/[0-9]+$@'],
                    'can' => ['peminjamanAktifTools.index', 'peminjamanAktifTools.create', 'peminjamanAktifTools.store', 'peminjamanAktifTools.returning', 'peminjamanAktifTools.update'],
                ],
                [
                    'text' => 'Approval Pengembalian',
                    'route' => 'approvalPengembalianTools.index',
                    'icon' => 'fas fa-fw fa-check',
                    'active' => ['approval-pengembalian-tools', 'regex:@^approval-pengembalian-tools/[0-9]+$@'],
                    'can' => ['approvalPengembalianTools.index', 'approvalPengembalianTools.review', 'approvalPengembalianTools.approval'],
                ],
                [
                    'text' => 'Riwayat Peminjaman',
                    'route' => 'riwayatPeminjamanTools.index',
                    'icon' => 'fas fa-fw fa-file-contract',
                    'active' => ['riwayat-peminjaman-tools', 'regex:@^riwayat-peminjaman-tools/[0-9]+$@'],
                    'can' => ['riwayatPeminjamanTools.index', 'riwayatPeminjamanTools.detail'],
                ],
            ]
        ],
        [
            'text' => 'Servis Rutin Kendaraan',
            'route' => 'servisRutin.index',
            'icon' => 'fas fa-fw fa-wrench',
            'active' => ['servis-rutin', 'regex:@^servis-rutin/[0-9]+$@'],
            'can' => ['servisRutin.index', 'servisRutin.getKendaraan', 'servisRutin.store'],
        ],
        [
            'text' => 'Masa Berlaku Dokumen Kendaraan',
            'route' => 'masaAktifDokumen.index',
            'icon' => 'fas fa-fw fa-clock',
            'active' => ['masa-aktif-dokumen', 'regex:@^masa-aktif-dokumen/[0-9]+$@', 'regex:@^masa-aktif-dokumen/[0-9]+/[0-9]+$@'],
            'can' => ['masaAktifDokumen.index', 'masaAktifDokumen.getKendaraan', 'masaAktifDokumen.store', 'masaAktifDokumen.update', 'masaAktifDokumen.update', 'masaAktifDokumen.del'],
        ],
        [
            'text' => 'Reporting',
            'icon' => 'fas fa-fw fa-paperclip',
            'can' =>  [
                'reporting.statistikPeminjamanUser.index', 'reporting.statistikPeminjamanUser.kendaraan', 'reporting.statistikPeminjamanUser.tools',
                'reporting.statistikPenggunaanKendaraan.index', 'reporting.statistikPenggunaanKendaraan.detail',
                'reporting.statistikPenggunaanTools.index', 'reporting.statistikPenggunaanTools.detail',
            ],
            'submenu' => [
                [
                    'text' => 'Statistik Peminjaman User',
                    'route' => 'reporting.statistikPeminjamanUser.index',
                    'active' => ['reporting/statistik-peminjaman-user', 'regex:@^reporting/statistik-peminjaman-user/[0-9]+/kendaraan$@', 'regex:@^reporting/statistik-peminjaman-user/[0-9]+/tools$@'],
                    'can' => ['reporting.statistikPeminjamanUser.index', 'reporting.statistikPeminjamanUser.kendaraan', 'reporting.statistikPeminjamanUser.tools'],
                ],
                [
                    'text' => 'Statistik Penggunaan Kendaraan',
                    'route' => 'reporting.statistikPenggunaanKendaraan.index',
                    'active' => ['reporting/statistik-penggunaan-kendaraan', 'regex:@^reporting/statistik-penggunaan-kendaraan/[0-9]+$@'],
                    'can' => ['reporting.statistikPenggunaanKendaraan.index', 'reporting.statistikPenggunaanKendaraan.detail'],
                ],
                [
                    'text' => 'Statistik Penggunaan Tools',
                    'route' => 'reporting.statistikPenggunaanTools.index',
                    'active' => ['reporting/statistik-penggunaan-tools', 'regex:@^reporting/statistik-penggunaan-tools/[0-9]+$@'],
                    'can' => ['reporting.statistikPenggunaanTools.index', 'reporting.statistikPenggunaanTools.detail'],
                ],
            ]
        ],
        [
            'text'    => 'Master Data',
            'icon'    => 'fas fa-fw fa-share',
            'can'     => [
                'kepemilikanAset.index', 'kepemilikanAset.store', 'kepemilikan.update', 'kepemilikanAset.del',
                'aset.index', 'aset.detail',
                'jenisKendaraan.index', 'jenisKendaraan.store', 'jenisKendaraan.update', 'jenisKendaraan.del',
                'kendaraan.index', 'kendaraan.store', 'kendaraan.storeExist', 'kendaraan.show', 'kendaraan.update', 'kendaraan.del',
                'tipeDokumen.index', 'tipeDokumen.store', 'tipeDokumen.show', 'tipeDokumen.update', 'tipeDokumen.del',
                'gudang.index', 'gudang.store', 'gudang.update', 'gudang.del',
                'toolsGroup.index', 'toolsGroup.store', 'toolsGroup.update', 'toolsGroup.del',
                'tools.index', 'tools.store', 'tools.storeExist', 'tools.detail', 'tools.edit', 'tools.update', 'tools.del',
            ],
            'submenu' => [
                [
                    'text' => 'Kepemilikan Aset',
                    'route' => 'kepemilikanAset.index',
                    'icon' => 'fas fa-fw fa-building',
                    'active' => ['kepemilikan-aset'],
                    'can' => ['kepemilikanAset.index', 'kepemilikanAset.store', 'kepemilikan.update', 'kepemilikanAset.del']
                ],
                [
                    'text' => 'Aset',
                    'route' => 'aset.index',
                    'icon' => 'fas fa-fw fa-tag',
                    'active' => ['aset', 'regex:@^aset/[0-9]+$@'],
                    'can' => ['aset.index', 'aset.detail'],
                ],
                [
                    'text' => 'Jenis Kendaraan',
                    'route' => 'jenisKendaraan.index',
                    'icon' => 'fas fa-fw fa-paper-plane',
                    'active' => ['jenis-kendaraan'],
                    'can' => ['jenisKendaraan.index', 'jenisKendaraan.store', 'jenisKendaraan.update', 'jenisKendaraan.del'],
                ],
                [
                    'text' => 'Kendaraan',
                    'route' => 'kendaraan.index',
                    'icon' => 'fas fa-fw fa-car',
                    'active' => ['kendaraan', 'regex:@^kendaraan/[0-9]+$@'],
                    'can' => ['kendaraan.index', 'kendaraan.store', 'kendaraan.storeExist', 'kendaraan.show', 'kendaraan.update', 'kendaraan.del'],
                ],
                [
                    'text' => 'Jenis Dokumen Kendaraan',
                    'route' => 'tipeDokumen.index',
                    'icon' => 'fas fa-fw fa-file',
                    'active' => ['tipe-dokumen', 'regex:@^tipe-dokumen/[0-9]+$@'],
                    'can' => ['tipeDokumen.index', 'tipeDokumen.store', 'tipeDokumen.show', 'tipeDokumen.update', 'tipeDokumen.del'],
                ],
                [
                    'text' => 'Gudang',
                    'route' => 'gudang.index',
                    'icon' => 'fas fa-fw fa-warehouse',
                    'active' => ['gudang'],
                    'can' => ['gudang.index', 'gudang.store', 'gudang.update', 'gudang.del'],
                ],
                [
                    'text' => 'Tools Group',
                    'route' => 'toolsGroup.index',
                    'icon' => 'fas fa-fw fa-ruler',
                    'active' => ['tools-group'],
                    'can' => ['toolsGroup.index', 'toolsGroup.store', 'toolsGroup.update', 'toolsGroup.del'],
                ],
                [
                    'text' => 'Tools',
                    'route' => 'tools.index',
                    'icon' => 'fas fa-fw fa-screwdriver',
                    'active' => ['tools', 'regex:@^tools/[0-9]+$@', 'regex:@^tools/[0-9]+/edit$@'],
                    'can' => ['tools.index', 'tools.store', 'tools.storeExist', 'tools.detail', 'tools.edit', 'tools.update', 'tools.del'],
                ],
            ],
        ],
        [
            'text' => 'Manajemen Akun',
            'icon' => 'fas fa-fw fa-user',
            'can' => [
                'user.index', 'user.store', 'user.update', 'user.show', 'user.updateRole', 'user.del',
                'roles.index', 'roles.store', 'roles.update', 'roles.del',
                'permission.index.', 'permission.permissionSync',
                'rolePermission.index', 'rolePermission.detail', 'rolePermission.store', 'rolePermission.del',
                'telegramData.index', 'telegramData.update',
            ],
            'submenu' => [
                [
                    'text' => 'User',
                    'route' => 'user.index',
                    'active' => ['user', 'regex:@^user/[0-9]+$@'],
                    'can' => ['user.index', 'user.store', 'user.update', 'user.show', 'user.updateRole', 'user.del'],
                ],
                [
                    'text' => 'Roles',
                    'route' => 'roles.index',
                    'active' => ['roles'],
                    'can' => ['roles.index', 'roles.store', 'roles.update', 'roles.del'],
                ],
                [
                    'text' => 'Permission',
                    'route' => 'permission.index',
                    'active' => ['permission'],
                    'can' => ['permission.index.', 'permission.permissionSync'],
                ],
                [
                    'text' => 'Role Permission',
                    'route' => 'rolePermission.index',
                    'active' => ['role-permisison', 'regex:@^role-permission/[0-9]+$@'],
                    'can' => ['rolePermission.index', 'rolePermission.detail', 'rolePermission.store', 'rolePermission.del'],
                ],
                [
                    'text' => 'Telegram Data',
                    'route' => 'telegramData.index',
                    'active' => ['telegram-data'],
                    'can' => ['telegramData.index', 'telegramData.update'],
                ]
            ]
        ]
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        //     'url'        => '#',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'cyan',
        //     'url'        => '#',
        // ],
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
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    // 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                    'location' => 'vendor/select2/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    // 'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                    'location' => 'vendor/select2/css/select2.css',
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
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    // 'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
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
