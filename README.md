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

    

