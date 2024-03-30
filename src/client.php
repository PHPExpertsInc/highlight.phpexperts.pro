<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use PHPExperts\RESTSpeaker\NoAuth;
use PHPExperts\RESTSpeaker\RESTSpeaker;

$url = 'https://highlight.phpexperts.pro';
$highlighter = new class(new NoAuth(), $url) extends RESTSpeaker {
    public function highlight(string $language, string $text): string
    {
        $url = 'https://highlight.phpexperts.pro';
        $result = $this->post($url . '/highlight', [
            'lang' => $language,
            'text' => $text
        ]);

        if ($this->getLastStatusCode() === 400) {
            throw new \RuntimeException($result);
        }

        return $result;
    }
};

echo $highlighter->highlight('PHP', 'echo "Hello, World!\n";');
