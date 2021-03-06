<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Documentation Output
    |--------------------------------------------------------------------------
    |
    | This value is the file path naming convention used when saving.
    | generated documentation. You can use ':version' for the current API
    | version being used, and ':name' for the "slug" of the route group.
    |
    */

    'output' => 'docs/:version/:name.md',

    /*
    |--------------------------------------------------------------------------
    | Route Matching
    |--------------------------------------------------------------------------
    |
    | This option controls which routes should be used for the documentation
    | generation based on their URI - using regular expressions. Use 'matches'
    | for routes to whitelist, and 'hides' to blacklist (NB: hiding takes
    | priority over matching).
    |
    */

    'routes' => [
        'matches' => [],
        'hides'   => []
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Group By
    |--------------------------------------------------------------------------
    |
    | This value determines how routes will be grouped into renders. This
    | allows for flexibility in grouping routes based on your own properties.
    |
    */

    'groupBy' => 'meta.groups.*.title',

    /*
    |--------------------------------------------------------------------------
    | DocBlock Tags
    |--------------------------------------------------------------------------
    |
    | These key-value pairs are custom DocBlock tags to be loaded and
    | processed. The key denotes the tag name (e.g. '@param') and its
    | value should be an implementation of a phpDocumentor Tag.
    |
    */

    'tags' => [
        'query'    => \Axieum\ApiDocs\tags\QueryTag::class,
        'url'      => \Axieum\ApiDocs\tags\UrlTag::class,
        'body'     => \Axieum\ApiDocs\tags\BodyTag::class,
        'response' => \Axieum\ApiDocs\tags\ResponseTag::class,
        'group'    => \Axieum\ApiDocs\tags\GroupTag::class,
        'hidden'   => \Axieum\ApiDocs\tags\HiddenTag::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Preflight Checks
    |--------------------------------------------------------------------------
    |
    | This option allows registering documentation generation "middleware",
    | to have the final say on whether a route should be processed or not.
    | NB: These can be leveraged to inspect DocBlock conventions, check
    | conflicts, raise exceptions to terminate the entire generation etc.
    |
    */

    'preflight' => [
        \Axieum\ApiDocs\preflight\InvalidActionRoutePreflight::class,
        \Axieum\ApiDocs\preflight\HiddenRoutePreflight::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Mutators
    |--------------------------------------------------------------------------
    |
    | This option allows registering documented route mutators.
    | NB: These can be leveraged to inject metadata into a route for access
    | in rendering.
    |
    */

    'mutators' => [
        \Axieum\ApiDocs\mutators\GroupMutator::class,
        \Axieum\ApiDocs\mutators\AuthMutator::class,
        \Axieum\ApiDocs\mutators\ResponseMutator::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Content Formatter
    |--------------------------------------------------------------------------
    |
    | This value references the documentation formatter responsible for
    | formatting the rendered content before it is persisted to the disk.
    | NB: This could be used to handle any regex replacements, etc.
    |
    */

    'formatter' => \Axieum\ApiDocs\formatter\MarkdownFormatter::class,

    /*
    |--------------------------------------------------------------------------
    | Documentation Versions
    |--------------------------------------------------------------------------
    |
    | This option allows version specific configurations.
    | NB: At least one registered version is required!
    |
    */

    'versions' => [

        'v1' => [
            'routes' => [
                'matches' => [
                    'api/*'
                ]
            ]
        ]

    ]

];
