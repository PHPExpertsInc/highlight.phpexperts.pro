<?php declare(strict_types=1);

/**
 * This file is part of highlight.phpexperts.pro, a PHP Experts, Inc., Project.
 *
 * Copyright © 2024 PHP Experts, Inc.
 * Author: Theodore R. Smith <theodore@phpexperts.pro>
 *   GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690
 *   https://highlight.phpexperts.pro/
 *   https://github.com/PHPExpertsInc/highlight.phpexperts.pro/
 *
 * This file is licensed under the Read-Only License.
 * Most rights are reserved.
 */

use Pecee\SimpleRouter\SimpleRouter;

require_once __DIR__ . '/../vendor/autoload.php';

/* Load external routes file */
require_once __DIR__ . '/../src/routes.php';

// I *HATE* CORS!!!
// Check if the request is a preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight requests
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}

// Handle the actual request
header('Access-Control-Allow-Origin: *');


/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\Demo\Controllers');

// Start the routing
SimpleRouter::start();
