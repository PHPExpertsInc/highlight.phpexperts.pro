## tempest/highlight API Server ##

This code is hosted at https://highlight.phpexperts.pro/

License: MIT

https://github.com/PHPExpertsInc/highlight.phpexperts.pro/

### API Routes ###

    POST: /highlight
    {
        "lang":  "language",
        "text":  "JSON-encoded text"
    }
            
    Output: text/html

### Installation Instructions

**Via Composer + Docker:**

    composer create-project phpexperts/tempest-highlight-api
    cd tempest-highlight-api
    # Edit the desired HTTP port in `docker-compose.yml`.
    docker compose up -d

**Via Git + Nginx:**

Running natively requires PHP v8.3 or higher with ext-json.

    sudo -s
    cd /var/www
    git clone https://github.com/PHPExpertsInc/highlight.phpexperts.pro
    cd highlight.phpexperts.pro/

    # Add a new virtualhost:
    cp docker/web/sites/001_default.conf  /etc/nginx/sites-available/999_my-highlighter.conf
    # Edit it and add a `server_name my.url;` directive.
    systemctl restart nginx

## Clients ##

### Pure JavaScript Client ###

```html
    <link rel="stylesheet" href="https://highlight.phpexperts.pro/css/highlight-tempest.css" />
    <code lang="JavaScript">
    console.log("Hello, World!");
    </code>
    <script src="https://highlight.phpexperts.pro/js/highlight.min.js" defer="defer"></script>
```

### PHP Client ###

First, `composer require phpexperts/rest-speaker`. Then:

Copy [src/client.php] or copy this code directly.

```php
    use PHPExperts\RESTSpeaker\NoAuth;
    use PHPExperts\RESTSpeaker\RESTSpeaker;

    $url = 'https://highlight.phpexperts.pro';
    $highlighter = new class(new NoAuth(), $url) extends RESTSpeaker {
        public function highlight(string $language, string $text): string
        {
            $result = $this->post('/highlight', [
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
```

