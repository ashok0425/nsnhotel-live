<?php return array (
  'app' => 
  array (
    'version' => '1.1.6',
    'name' => 'NSN HOTELS',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://127.0.0.1',
    'asset_url' => NULL,
    'timezone' => 'Asia/Calcutta',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:HjiH5f8r/2Bgbigb1T3z/nOiV7mzEoWwwRfub9QYPVw=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'UniSharp\\LaravelFilemanager\\LaravelFilemanagerServiceProvider',
      23 => 'Intervention\\Image\\ImageServiceProvider',
      24 => 'Barryvdh\\TranslationManager\\ManagerServiceProvider',
      25 => 'Artesaos\\SEOTools\\Providers\\SEOToolsServiceProvider',
      26 => 'Laravel\\Socialite\\SocialiteServiceProvider',
      27 => 'App\\Providers\\AppServiceProvider',
      28 => 'App\\Providers\\AuthServiceProvider',
      29 => 'App\\Providers\\EventServiceProvider',
      30 => 'App\\Providers\\RouteServiceProvider',
      31 => 'HTMLMin\\HTMLMin\\HTMLMinServiceProvider',
      32 => 'Yajra\\Datatables\\DatatablesServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'SEO' => 'Artesaos\\SEOTools\\Facades\\SEOTools',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'HTMLMin' => 'HTMLMin\\HTMLMin\\Facades\\HTMLMin',
    ),
    'debug_blacklist' => 
    array (
      '_ENV' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_PASSWORD',
        4 => 'PUSHER_APP_KEY',
        5 => 'PUSHER_APP_SECRET',
      ),
      '_SERVER' => 
      array (
        0 => 'APP_KEY',
        1 => 'DB_PASSWORD',
        2 => 'REDIS_PASSWORD',
        3 => 'MAIL_PASSWORD',
        4 => 'PUSHER_APP_KEY',
        5 => 'PUSHER_APP_SECRET',
      ),
      '_POST' => 
      array (
        0 => 'password',
      ),
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\laravel\\hotelnsn\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => 'AKIAUXRNHCHVJGWZJDP2',
        'secret' => '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',
        'region' => 'ap-south-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'nsn_hotels_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'ashirqyy_nsn_com',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'nsnhotel.ckh09fh7ikpd.ap-south-1.rds.amazonaws.com',
        'port' => '3306',
        'database' => 'ashirqyy_nsn_com',
        'username' => 'nsnhotel',
        'password' => 'Momlove++1',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => 'nsnhotel.ckh09fh7ikpd.ap-south-1.rds.amazonaws.com',
        'port' => '3306',
        'database' => 'ashirqyy_nsn_com',
        'username' => 'nsnhotel',
        'password' => 'Momlove++1',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => 'nsnhotel.ckh09fh7ikpd.ap-south-1.rds.amazonaws.com',
        'port' => '3306',
        'database' => 'ashirqyy_nsn_com',
        'username' => 'nsnhotel',
        'password' => 'Momlove++1',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'options' => 
      array (
        'cluster' => 'predis',
        'prefix' => 'nsn_hotels_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'D:\\laravel\\hotelnsn\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
    ),
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => false,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'timeline' => false,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => true,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\laravel\\hotelnsn\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\laravel\\hotelnsn\\storage\\app/public',
        'url' => 'http://127.0.0.1/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'AKIAUXRNHCHVJGWZJDP2',
        'secret' => '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',
        'region' => 'ap-south-1',
        'bucket' => 'nsnhotels',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'htmlmin' => 
  array (
    'blade' => false,
    'force' => false,
    'ignore' => 
    array (
      0 => 'resources/views/emails',
      1 => 'resources/views/html',
      2 => 'resources/views/notifications',
      3 => 'resources/views/markdown',
      4 => 'resources/views/vendor/emails',
      5 => 'resources/views/vendor/html',
      6 => 'resources/views/vendor/notifications',
      7 => 'resources/views/vendor/markdown',
    ),
  ),
  'lfm' => 
  array (
    'use_package_routes' => false,
    'allow_private_folder' => true,
    'private_folder_name' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shares',
    'folder_categories' => 
    array (
      'file' => 
      array (
        'folder_name' => 'files',
        'startup_view' => 'grid',
        'max_size' => 50000,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
          4 => 'image/svg+xml',
        ),
      ),
      'image' => 
      array (
        'folder_name' => 'photos',
        'startup_view' => 'list',
        'max_size' => 50000,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
          4 => 'image/svg+xml',
          5 => 'application/pdf',
          6 => 'text/plain',
        ),
      ),
    ),
    'disk' => 'public_upload',
    'rename_file' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'should_validate_mime' => false,
    'over_write_on_duplicate' => false,
    'should_create_thumbnails' => true,
    'thumb_folder_name' => 'thumbs',
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'D:\\laravel\\hotelnsn\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'D:\\laravel\\hotelnsn\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.googlemail.com',
    'port' => '465',
    'from' => 
    array (
      'address' => 'noreply@nsnhotels.com',
      'name' => 'NSN HOTELS',
    ),
    'encryption' => 'SSL',
    'username' => 'noreply@nsnhotels.com',
    'password' => '14d381a36902b0',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\laravel\\hotelnsn\\resources\\views/vendor/mail',
      ),
    ),
    'stream' => 
    array (
      'ssl' => 
      array (
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
      ),
    ),
    'log_channel' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'AKIAUXRNHCHVJGWZJDP2',
        'secret' => 'tXJLGLrcJO83pwaxI/HCluHl+DONlWg8DuulE2WN',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'ap-south-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'seotools' => 
  array (
    'meta' => 
    array (
      'defaults' => 
      array (
        'title' => false,
        'titleBefore' => false,
        'description' => false,
        'separator' => ' - ',
        'keywords' => 
        array (
        ),
        'canonical' => false,
        'robots' => false,
      ),
      'webmaster_tags' => 
      array (
        'google' => NULL,
        'bing' => NULL,
        'alexa' => NULL,
        'pinterest' => NULL,
        'yandex' => NULL,
        'norton' => NULL,
      ),
      'add_notranslate_class' => false,
    ),
    'opengraph' => 
    array (
      'defaults' => 
      array (
        'title' => false,
        'description' => false,
        'url' => false,
        'type' => false,
        'site_name' => false,
        'images' => 
        array (
        ),
      ),
    ),
    'twitter' => 
    array (
      'defaults' => 
      array (
      ),
    ),
    'json-ld' => 
    array (
      'defaults' => 
      array (
        'title' => false,
        'description' => false,
        'url' => false,
        'type' => 'WebPage',
        'images' => 
        array (
        ),
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => 'AKIAUXRNHCHVJGWZJDP2',
      'secret' => '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',
      'region' => 'ap-south-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\laravel\\hotelnsn\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'nsn_hotels_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'setting_fields' => 
  array (
    'app' => 
    array (
      'title' => 'General',
      'desc' => 'All the general settings for application.',
      'icon' => 'fa fa-cog',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'app_name',
          'label' => 'Home title',
          'type' => 'text',
          'data' => 'string',
          'rules' => '',
          'value' => '',
        ),
        1 => 
        array (
          'name' => 'home_description',
          'label' => 'Home description',
          'type' => 'textarea',
          'data' => 'string',
          'rules' => '',
          'value' => '',
        ),
        2 => 
        array (
          'name' => 'logo',
          'label' => 'Logo',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
      ),
    ),
    'email' => 
    array (
      'title' => 'Email Settings',
      'desc' => 'Email received booking',
      'icon' => 'fa fa-envelope-o',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'email_system',
          'type' => 'email',
          'label' => 'Email',
          'rules' => 'email',
        ),
      ),
    ),
    'mail_driver' => 
    array (
      'title' => 'SMTP Settings',
      'desc' => '',
      'icon' => 'fa fa-envelope-o',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'mail_driver',
          'type' => 'text',
          'label' => 'Mail driver',
          'rules' => '',
          'value' => 'smtp',
        ),
        1 => 
        array (
          'name' => 'mail_host',
          'type' => 'text',
          'label' => 'Mail host',
          'rules' => '',
          'value' => 'smtp.googlemail.com',
        ),
        2 => 
        array (
          'name' => 'mail_port',
          'type' => 'text',
          'label' => 'Mail port',
          'rules' => '',
          'value' => '465',
        ),
        3 => 
        array (
          'name' => 'mail_username',
          'type' => 'text',
          'label' => 'Mail username',
          'rules' => '',
        ),
        4 => 
        array (
          'name' => 'mail_password',
          'type' => 'text',
          'label' => 'Mail password',
          'rules' => '',
        ),
        5 => 
        array (
          'name' => 'mail_encryption',
          'type' => 'text',
          'label' => 'Mail encryption',
          'rules' => '',
          'value' => 'ssl',
        ),
        6 => 
        array (
          'name' => 'mail_from_address',
          'type' => 'text',
          'label' => 'Mail from address',
          'rules' => '',
          'value' => 'hello@uxper.co',
        ),
        7 => 
        array (
          'name' => 'mail_from_name',
          'type' => 'text',
          'label' => 'Mail from name',
          'rules' => '',
          'value' => 'uxper',
        ),
      ),
    ),
    'social_auth_facebook' => 
    array (
      'title' => 'Social login setting',
      'desc' => '',
      'icon' => 'fa fa-envelope-o',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'facebook_app_id',
          'type' => 'text',
          'label' => 'Facebook App ID',
          'rules' => '',
        ),
        1 => 
        array (
          'name' => 'facebook_app_secret',
          'type' => 'text',
          'label' => 'Facebook App Secret',
          'rules' => '',
        ),
        2 => 
        array (
          'name' => 'google_app_id',
          'type' => 'text',
          'label' => 'Google App ID',
          'rules' => '',
        ),
        3 => 
        array (
          'name' => 'google_app_secret',
          'type' => 'text',
          'label' => 'Google App Secret',
          'rules' => '',
        ),
      ),
    ),
    'homepage' => 
    array (
      'title' => 'Homepage Settings',
      'desc' => '',
      'icon' => 'fa fa-external-link-square',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'home_banner',
          'label' => 'Home banner',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        1 => 
        array (
          'name' => 'home_banner_app',
          'label' => 'Home banner app',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        2 => 
        array (
          'name' => 'home_offer_percentage',
          'label' => 'Offer Percentage',
          'type' => 'number',
          'data' => 'int',
          'rules' => '',
        ),
        3 => 
        array (
          'name' => 'home_offer_text',
          'label' => 'Offer Text',
          'type' => 'text',
          'data' => 'string',
          'rules' => '',
        ),
        4 => 
        array (
          'name' => 'banquet_image',
          'label' => 'Banquet Image',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        5 => 
        array (
          'name' => 'offer_image2',
          'label' => 'offer Image 2',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        6 => 
        array (
          'name' => 'offer_image3',
          'label' => 'offer Image 3',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        7 => 
        array (
          'name' => 'offer_image4',
          'label' => 'offer Image 4',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
      ),
    ),
    'Offer' => 
    array (
      'title' => 'Offer settings',
      'desc' => '',
      'icon' => 'fa fa-external-link-square',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'pop_offer_image',
          'label' => 'Pop Offer Image',
          'type' => 'file',
          'data' => 'image',
          'rules' => '',
        ),
        1 => 
        array (
          'name' => 'pop_offer_text',
          'label' => 'Pop Offer Text',
          'type' => 'text',
          'data' => 'string',
          'rules' => '',
        ),
        2 => 
        array (
          'name' => 'pop_offer',
          'label' => 'Pop Offer',
          'type' => 'text',
          'data' => 'string',
          'rules' => '',
        ),
      ),
    ),
    'google' => 
    array (
      'title' => 'Google settings',
      'desc' => '',
      'icon' => 'fa fa-external-link-square',
      'elements' => 
      array (
        0 => 
        array (
          'name' => 'goolge_map_api_key',
          'label' => 'Google Map API Key',
          'type' => 'text',
          'data' => 'string',
          'rules' => '',
        ),
      ),
    ),
  ),
  'translatable' => 
  array (
    'locales' => 
    array (
      0 => 'en',
    ),
    'locale_separator' => '-',
    'locale' => NULL,
    'use_fallback' => true,
    'use_property_fallback' => true,
    'fallback_locale' => 'en',
    'translation_model_namespace' => NULL,
    'translation_suffix' => 'Translation',
    'locale_key' => 'locale',
    'to_array_always_loads_translations' => true,
    'rule_factory' => 
    array (
      'format' => 1,
      'prefix' => '%',
      'suffix' => '%',
    ),
  ),
  'translation-manager' => 
  array (
    'route' => 
    array (
      'prefix' => 'admincp/translations',
      'middleware' => 
      array (
        0 => 'web',
        1 => 'auth',
        2 => 'auth.admin',
      ),
    ),
    'delete_enabled' => false,
    'exclude_groups' => 
    array (
    ),
    'exclude_langs' => 
    array (
    ),
    'sort_keys' => false,
    'trans_functions' => 
    array (
      0 => 'trans',
      1 => 'trans_choice',
      2 => 'Lang::get',
      3 => 'Lang::choice',
      4 => 'Lang::trans',
      5 => 'Lang::transChoice',
      6 => '@lang',
      7 => '@choice',
      8 => '__',
      9 => '$trans.get',
    ),
    'sort_keys ' => false,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\laravel\\hotelnsn\\resources\\views',
    ),
    'compiled' => 'D:\\laravel\\hotelnsn\\storage\\framework\\views',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'httpauth' => 
  array (
    'type' => 'basic',
    'realm' => 'Secured',
    'username' => 'admin',
    'password' => '1234',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'lfm-config' => 
  array (
    'use_package_routes' => true,
    'allow_private_folder' => true,
    'private_folder_name' => 'UniSharp\\LaravelFilemanager\\Handlers\\ConfigHandler',
    'allow_shared_folder' => true,
    'shared_folder_name' => 'shares',
    'folder_categories' => 
    array (
      'file' => 
      array (
        'folder_name' => 'files',
        'startup_view' => 'list',
        'max_size' => 50000,
        'thumb' => true,
        'thumb_width' => 80,
        'thumb_height' => 80,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
          4 => 'application/pdf',
          5 => 'text/plain',
        ),
      ),
      'image' => 
      array (
        'folder_name' => 'photos',
        'startup_view' => 'grid',
        'max_size' => 50000,
        'thumb' => true,
        'thumb_width' => 80,
        'thumb_height' => 80,
        'valid_mime' => 
        array (
          0 => 'image/jpeg',
          1 => 'image/pjpeg',
          2 => 'image/png',
          3 => 'image/gif',
        ),
      ),
    ),
    'paginator' => 
    array (
      'perPage' => 30,
    ),
    'disk' => 'public',
    'rename_file' => false,
    'rename_duplicates' => false,
    'alphanumeric_filename' => false,
    'alphanumeric_directory' => false,
    'should_validate_size' => false,
    'should_validate_mime' => true,
    'over_write_on_duplicate' => false,
    'disallowed_mimetypes' => 
    array (
      0 => 'text/x-php',
      1 => 'text/html',
      2 => 'text/plain',
    ),
    'item_columns' => 
    array (
      0 => 'name',
      1 => 'url',
      2 => 'time',
      3 => 'icon',
      4 => 'is_file',
      5 => 'is_image',
      6 => 'thumb_url',
    ),
    'should_create_thumbnails' => true,
    'thumb_folder_name' => 'thumbs',
    'raster_mimetypes' => 
    array (
      0 => 'image/jpeg',
      1 => 'image/pjpeg',
      2 => 'image/png',
    ),
    'thumb_img_width' => 200,
    'thumb_img_height' => 200,
    'file_type_array' => 
    array (
      'pdf' => 'Adobe Acrobat',
      'doc' => 'Microsoft Word',
      'docx' => 'Microsoft Word',
      'xls' => 'Microsoft Excel',
      'xlsx' => 'Microsoft Excel',
      'zip' => 'Archive',
      'gif' => 'GIF Image',
      'jpg' => 'JPEG Image',
      'jpeg' => 'JPEG Image',
      'png' => 'PNG Image',
      'ppt' => 'Microsoft PowerPoint',
      'pptx' => 'Microsoft PowerPoint',
    ),
    'php_ini_overrides' => 
    array (
      'memory_limit' => '256M',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
