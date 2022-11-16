<?php

namespace WirelessLogic\Tests\Scrapper\Application;

use PHPUnit\Framework\TestCase;
use WirelessLogic\Scrapper\PriceTable\Domain\Price;

final class PriceTest extends TestCase
{
    public function testCreate(): void
    {
        $price = Price::fromScrappedValue("$66.58");

        $this->assertEquals(66.58, $price->getAmount());
        $this->assertEquals("$", $price->getCurrency());
    }
}
