<?php

/**
 * Configuration options for Salesforce Oath settings and REST API defaults.
 */
return [
    /*
     * Options include WebServer, UserPassword, and UserPasswordSoap
     */
    'authentication' => 'UserPassword',

    /*
     * Enter your credentials
     * Username and Password are only necessary for UserPassword & UserPasswordSoap flows.
     * Likewise, callbackURI is only necessary for WebServer flow.
     */
    'credentials'    => [
        //Required:
        'consumerKey'    => env('SF_CONSUMER_KEY'),
        'consumerSecret' => env('SF_CONSUMER_SECRET'),
        'callbackURI'    => env('SF_CALLBACK_URI'),
        'loginURL'       => env('SF_LOGIN_URL'),

        // Only required for UserPassword authentication:
        'username'       => env('SF_USERNAME'),
        // Security token might need to be ammended to password unless IP Address is whitelisted
        'password'       => env('SF_PASSWORD'),
    ],

    /*
     * These are optional authentication parameters that can be specified for the WebServer flow.
     * https://help.salesforce.com/apex/HTViewHelpDoc?id=remoteaccess_oauth_web_server_flow.htm&language=en_US
     */
    'parameters'     => [
        'display'   => '',
        'immediate' => false,
        'state'     => '',
        'scope'     => '',
        'prompt'    => '',
    ],

    /*
     * Default settings for resource requests.
     * Format can be 'json', 'xml' or 'none'
     * Compression can be set to 'gzip' or 'deflate'
     */
    'defaults'       => [
        'method'          => 'get',
        'format'          => 'json',
        'compression'     => false,
        'compressionType' => 'gzip',
    ],

    /*
     * Where do you want to store access tokens fetched from Salesforce
     */
    'storage'        => [
        'type'          => 'cache', // 'session' or 'cache' are the two options [Cache to cache]
        'path'          => 'forrest_', // unique storage path to avoid collisions
        'expire_in'     => 60, // number of minutes to expire cache/session
        'store_forever' => true, // never expire cache/session
    ],

    /*
     * If you'd like to specify an API version manually it can be done here.
     * Format looks like '32.0'
     */
    'version'        => '',

    /*
     * Optional (and not recommended) if you need to override the instance_url returned from Saleforce
     */
    'instanceURL'    => '',

    /*
     * Language
     */
    'language'       => 'en_US',
];
