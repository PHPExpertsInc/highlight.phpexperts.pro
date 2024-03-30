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
use Pecee\SimpleRouter\SimpleRouter as Router;
use Tempest\Highlight\Highlighter;

SimpleRouter::get('/', function () {
    $postJSON = <<<JSON
        {
            "lang":  "language",
            "text":  "JSON-encoded text"
        }
    JSON;

    $highlighter = new Highlighter();
    $postJSON = $highlighter->parse($postJSON, 'json');

    return <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="/css/highlight-tempest.css" />
            <style>
            code { display: block; white-space: pre; font-family: 'Fira Code', monospace; } 
            </style>
        </head>
        <body style="background: #DFDFFF">
            <h1>An API Server for tempest/highlight</h1>
            <p>Welcome to the API server for <span style="font-family: 'Fira Code', monospace;"><a target="_blank" href="https://github.com/tempestphp/highlight/">tempest/highlight</a></span>.</p>
            <p>The API route is pretty simple:</p>
            <code>
        POST: /highlight
    $postJSON
                
        Output: text/html
            </code>
            <p>Don't forget to include the Tempest Highlight CSS links in your HTML:</p>
            <code>    wget <a href="https://gitcdn.link/repo//tempestphp/highlight/main/src/Themes/highlight-tempest.css" target="_blank">https://gitcdn.link/repo//tempestphp/highlight/main/src/Themes/highlight-tempest.css</a></code>
        </body>
    </html>
    HTML;
});

SimpleRouter::post('/highlight', function () {
    $response = Router::response();
    $data = json_decode(file_get_contents('php://input'), true);

    $errors = '';
    $lang = $data['lang'] ?? null;
    if (!$lang) {
        $errors .= '<h3 style="color: red">[HIGHLIGHTER ERROR] No "lang" provided.</h3>' . "\n";
    }

    $text = $data['text'] ?? null;
    if (!$text) {
        $errors .= '<h3 style="color: red">[HIGHLIGHTER ERROR] No "text" provided.</h3>' . "\n";
    }
    if ($errors !== '') {
        $response->httpCode(400);

        return $errors;
    }

    $highlighter = new Tempest\Highlight\Highlighter();

    return $highlighter->parse($text, strtolower($lang));
});
