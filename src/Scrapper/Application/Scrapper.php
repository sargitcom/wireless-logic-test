<?php

namespace WirelessLogic\Scrapper\Application;

use WirelessLogic\Scrapper\Domain\SiteRepository;

class Scrapper
{
    private SiteRepository $siteRepository;

    public function __construct(SiteRepository $siteRepository)
    {
        $this->siteRepository = $siteRepository;

    }

    public function __invoke() : string
    {
        $response = $this->siteRepository->scrapPriceTables();

        return json_encode($response->toArray());
    }
}
