<?php
/**
 * @copyright   2017-2018 Raha. All rights reserved.
 * @license     GNU GPL version 3; see LICENSE.txt
 *
 * @see        https://euresiacoders.com
 */

// Define minimum supported PHP version
define('RAHA_PHP', '5.6.4');

// Check PHP version
if (version_compare(PHP_VERSION, RAHA_PHP, '<')) {
    die('Your host needs to use PHP '.RAHA_PHP.' or higher to run Raha');
}

// Register the auto-loader
require __DIR__.'/bootstrap/autoload.php';

// Load the app
$app = require_once __DIR__.'/bootstrap/app.php';

// Run the app
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
