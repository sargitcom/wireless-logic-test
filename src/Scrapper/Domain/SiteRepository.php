<?php

namespace WirelessLogic\Scrapper\Domain;

use WirelessLogic\Scrapper\PriceTable\Domain\PriceTableCollection;

interface SiteRepository
{
    public function scrapPriceTables() : PriceTableCollection;
}