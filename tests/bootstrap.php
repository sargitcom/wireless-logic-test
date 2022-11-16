<?php

require_once dirname(__DIR__, 1) . "/vendor/autoload.php";

use Psr\Container\ContainerInterface;
use WirelessLogic\Scrapper\Application\Scrapper;
use WirelessLogic\Scrapper\Infrastructure\Puphpeteer\SiteRepository;

$containerBuilder = new DI\ContainerBuilder();

$containerBuilder->addDefinitions(
    [
        SiteRepository::class => new SiteRepository(),

        \WirelessLogic\Scrapper\Domain\SiteRepository::class => DI\factory(function (ContainerInterface $c) {
            return $c->get(SiteRepository::class);
        }),

        Scrapper::class => DI\factory(function (ContainerInterface $c) {
            return new Scrapper($c->get(SiteRepository::class));
        }),
    ]
);

$container = $containerBuilder->build();