<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/profile'),
            'url' => env('APP_URL').'/storage/images/profile',
            'visibility' => 'public',
        ],

        'news' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/news'),
            'url' => env('APP_URL').'/storage/images/news',
            'visibility' => 'public',
        ],

        'official_diaries' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/official_diaries'),
            'url' => env('APP_URL').'/storage/images/official_diaries',
            'visibility' => 'public',
        ],

        'projects' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/projects'),
            'url' => env('APP_URL').'/storage/images/projects',
            'visibility' => 'public',
        ],

        'project_progresses' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/projects/progresses'),
            'url' => env('APP_URL').'/storage/images/projects/progresses',
            'visibility' => 'public',
        ],

        'project_responsibles' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/projects/responsibles'),
            'url' => env('APP_URL').'/storage/images/projects/responsibles',
            'visibility' => 'public',
        ],

        'sensitive_information' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files/sensitive_informations'),
            'url' => env('APP_URL').'/storage/files/sensitive_informations',
            'visibility' => 'public',
        ],

        'units' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/units'),
            'url' => env('APP_URL').'/storage/images/units',
            'visibility' => 'public',
        ],

        'gallery' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/gallery'),
            'url' => env('APP_URL').'/storage/images/gallery',
            'visibility' => 'public',
        ],

        'shortcutweb' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/shortcutweb'),
            'url' => env('APP_URL').'/storage/images/shortcutweb',
            'visibility' => 'public',
        ],

        'leadership' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/leadership'),
            'url' => env('APP_URL').'/storage/images/leadership',
            'visibility' => 'public',
        ],

        'about' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/about'),
            'url' => env('APP_URL').'/storage/images/about',
            'visibility' => 'public',
        ],

        'banners' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/banners'),
            'url' => env('APP_URL').'/storage/images/banners',
            'visibility' => 'public',
        ],

        'copyrights' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/copyrights'),
            'url' => env('APP_URL').'/storage/images/copyrights',
            'visibility' => 'public',
        ],

        'webfooters' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/webfooters'),
            'url' => env('APP_URL').'/storage/images/webfooters',
            'visibility' => 'public',
        ],

        'blankpages' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/blankpages'),
            'url' => env('APP_URL').'/storage/images/blankpages',
            'visibility' => 'public',
        ],

        'posts' => [
            'driver' => 'local',
            'root' => storage_path('app/public/images/posts'),
            'url' => env('APP_URL').'/storage/images/posts',
            'visibility' => 'public',
        ],

        'files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/files'),
            'url' => env('APP_URL').'/storage/files',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('files') => storage_path('app/public/files'),
    ],

];
