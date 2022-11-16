<?php

require_once __DIR__ . "/vendor/autoload.php";

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

$scrapper = $container->get(Scrapper::class);

$data = $scrapper();

echo $data;
