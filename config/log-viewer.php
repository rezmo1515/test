<?php

use Opcodes\LogViewer\Enums\SortingMethod;
use Opcodes\LogViewer\Enums\SortingOrder;
use Opcodes\LogViewer\Enums\Theme;

return [

    'enabled' => env('LOG_VIEWER_ENABLED', true),
    'api_only' => env('LOG_VIEWER_API_ONLY', false),
    'require_auth_in_production' => true,
    'route_domain' => null,
    'route_path' => 'log-viewer',
    'assets_path' => 'vendor/log-viewer',

    'include_files' => [
        storage_path('logs/*.log'),
    ],

    'exclude_files' => [

    ],

    'hide_unknown_files' => true,

    'cache_driver' => env('LOG_VIEWER_CACHE_DRIVER', null),
    'cache_key_prefix' => 'lv',
    'lazy_scan_chunk_size_in_mb' => 50,
    'strip_extracted_context' => true,
    'timezone' => null,
    'datetime_format' => 'Y-m-d H:i:s',

    'middleware' => [
        'api',
        \App\Infrastructure\Http\Middleware\AuthorizeLogViewerAccess::class,
    ],

    'api_middleware' => [
        'api',
        \App\Infrastructure\Http\Middleware\AuthorizeLogViewerAccess::class,
    ],

    'defaults' => [
        'use_local_storage' => true,
        'folder_sorting_method' => SortingMethod::ModifiedTime,
        'folder_sorting_order' => SortingOrder::Descending,
        'file_sorting_method' => SortingMethod::ModifiedTime,
        'log_sorting_order' => SortingOrder::Descending,
        'per_page' => 25,
        'theme' => Theme::System,
        'shorter_stack_traces' => false,
    ],

    'root_folder_prefix' => 'root',
];
