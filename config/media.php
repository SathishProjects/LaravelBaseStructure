<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Various Image Configuration by model
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many model based configuration such as supported_format
    | maximum_file_size in MB,image_resolution,thumb_image_resolution
    |
    */
    'AllowedMedias' => ['customer', 'driver', 'order', 'driver-document', 'admin'],
    'customer' => [
        'supported_format' => 'jpg,png,jpeg',
        'maximum_file_size' => 2,
        'image_resolution' => '250x250',
        'thumb_image_resolution' => '120x90'
     ],
    'driver' => [
      'supported_format' => 'jpg,png,jpeg',
      'maximum_file_size' => 2,
      'image_resolution' => '250x250',
      'thumb_image_resolution' => '120x90'
    ],
    'order' => [
        'supported_format' => 'jpg,png,jpeg',
        'maximum_file_size' => 2,
        'image_resolution' => '200x200',
        'thumb_image_resolution' => '120x90'
    ], 
    'driver-document' => [
        'supported_format' => 'jpg,png,jpeg,pdf',
        'image_resolution' => '200x200',
        'thumb_image_resolution' => '120x90',
        'maximum_file_size' => 4,
        'is_file' => 1
    ],
   'admin' => [
     'supported_format' => 'jpg,png,jpeg',
     'maximum_file_size' => 2,
     'image_resolution' => '250x250',
     'thumb_image_resolution' => '120x90'
    ]
];
