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

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'web_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/web_images'),
            'url' => env('APP_URL').':8000/storage/web_images',
            'visibility' => 'public',
        ],

        'introductions' => [
            'driver' => 'local',
            'root' => storage_path('app/public/introductions'),
            'url' => env('APP_URL').':8000/storage/introductions',
            'visibility' => 'public',
        ],

        'courses' => [
            'driver' => 'local',
            'root' => storage_path('app/public/courses'),
            'url' => env('APP_URL').':8000/storage/courses',
            'visibility' => 'public',
        ],

        'course_overviews' => [
            'driver' => 'local',
            'root' => storage_path('app/public/course_overviews'),
            'url' => env('APP_URL').':8000/storage/course_overviews',
            'visibility' => 'public',
        ],

        'activities' => [
            'driver' => 'local',
            'root' => storage_path('app/public/activities'),
            'url' => env('APP_URL').':8000/storage/activities',
            'visibility' => 'public',
        ],

        'slides' => [
            'driver' => 'local',
            'root' => storage_path('app/public/slides'),
            'url' => env('APP_URL').'/storage/slides',
            'visibility' => 'public',
        ],
        'course_file' => [
            'driver' => 'local',
            'root' => storage_path('app/public/course_file'),
            'url' => env('APP_URL').'/storage/course_file',
            'visibility' => 'public',
        ],
        'image_prints' => [
            'driver' => 'local',
            'root' => storage_path('app/public/image_prints'),
            'url' => env('APP_URL').'/storage/image_prints',
            'visibility' => 'public',
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
    ],

];
