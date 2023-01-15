<?php return array (
  'artesaos/seotools' => 
  array (
    'providers' => 
    array (
      0 => 'Artesaos\\SEOTools\\Providers\\SEOToolsServiceProvider',
    ),
    'aliases' => 
    array (
      'SEOMeta' => 'Artesaos\\SEOTools\\Facades\\SEOMeta',
      'OpenGraph' => 'Artesaos\\SEOTools\\Facades\\OpenGraph',
      'Twitter' => 'Artesaos\\SEOTools\\Facades\\TwitterCard',
      'SEO' => 'Artesaos\\SEOTools\\Facades\\SEOTools',
    ),
  ),
  'astrotomic/laravel-translatable' => 
  array (
    'providers' => 
    array (
      0 => 'Astrotomic\\Translatable\\TranslatableServiceProvider',
    ),
  ),
  'barryvdh/laravel-translation-manager' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\TranslationManager\\ManagerServiceProvider',
    ),
  ),
  'beyondcode/laravel-dump-server' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\DumpServer\\DumpServerServiceProvider',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'htmlmin/htmlmin' => 
  array (
    'providers' => 
    array (
      0 => 'HTMLMin\\HTMLMin\\HTMLMinServiceProvider',
    ),
    'aliases' => 
    array (
      'HTMLMin' => 'HTMLMin\\HTMLMin\\Facades\\HTMLMin',
    ),
  ),
  'intervention/httpauth' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\HttpAuth\\Laravel\\HttpAuthServiceProvider',
    ),
    'aliases' => 
    array (
      'HttpAuth' => 'Intervention\\HttpAuth\\Laravel\\Facades\\HttpAuth',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'laravel/socialite' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Socialite\\SocialiteServiceProvider',
    ),
    'aliases' => 
    array (
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'tanmuhittin/laravel-google-translate' => 
  array (
    'providers' => 
    array (
      0 => 'Tanmuhittin\\LaravelGoogleTranslate\\LaravelGoogleTranslateServiceProvider',
    ),
  ),
  'unisharp/laravel-filemanager' => 
  array (
    'providers' => 
    array (
      0 => 'UniSharp\\LaravelFilemanager\\LaravelFilemanagerServiceProvider',
    ),
    'aliases' => 
    array (
    ),
  ),
  'yajra/laravel-datatables-oracle' => 
  array (
    'providers' => 
    array (
      0 => 'Yajra\\DataTables\\DataTablesServiceProvider',
    ),
    'aliases' => 
    array (
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
    ),
  ),
);