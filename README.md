<h1>Subject</h1>

Test application for scrapping price tables from site: https://wltest.dns-systems.net/

<h2>How to run application?</h2># wireless-logic-test

start command ./scrap-data.sh
command will run command `php scrapper.php` in docker env

it's also possible to start docker-compose and run command 'php scrapper.php' in the container

docker-compose up --build -d
docker-compose exec wl-php-scrapper php scrapper.php

<h2>Dependencies</h2>

Described in dockerfile in ./docker/php/Dockerfile 