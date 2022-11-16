#!/bin/bash
docker-compose up --build -d
docker-compose exec wl-php-scrapper php scrapper.php
