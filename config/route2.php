<?php

use \Anax\Route\Router;

/**
 * Configuration file for routes.
 */
return [
    //"mode" => Router::DEVELOPMENT, // default, verbose execeptions
    //"mode" => Router::PRODUCTION,  // exceptions turn into 500

    // Load these routefiles in order specified and optionally mount them
    // onto a base route.
    "routeFiles" => [
        [
            "mount" => null,
            "file" => __DIR__ . "/route2/routes.php",
        ],
        [
            // These are for internal error handling and exceptions
            "mount" => null,
            "file" => __DIR__ . "/route2/internal.php",
        ],
        [
            // Add routes from userController and mount on profile/
            "mount" => null,
            "file" => __DIR__ . "/route2/userController.php",
        ],
        [
            // Add routes from adminController and mount on admin/
            "mount" => null,
            "file" => __DIR__ . "/route2/adminController.php",
        ],
        [
            // Add routes from shopController and mount on profile/
            "mount" => null,
            "file" => __DIR__ . "/route2/shopController.php",
        ],
        [
            // For debugging and development details on Anax
            "mount" => "debug",
            "file" => __DIR__ . "/route2/debug.php",
        ],
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route2/flat-file-content.php",
        ],
        [
            // Keep this last since its a catch all
            "mount" => null,
            "sort" => 999,
            "file" => __DIR__ . "/route2/404.php",
        ],
    ],

];
