<?php

namespace WirelessLogic\Tests\Scrapper\Application;

use PHPUnit\Framework\TestCase;
use WirelessLogic\Scrapper\PriceTable\Domain\Price;
use WirelessLogic\Scrapper\PriceTable\Domain\PriceTable;


final class PriceTableTest extends TestCase
{
    public function testCommandReturnsOutput(): void
    {
        $priceTable = PriceTable::fromArray(
            [
                'title' => "test",
                'description' => "test",
                'price' => 66,
                'discountKey' => "10% discount"
            ]
        );

        $this->assertEquals("test", $priceTable->getTitle());
        $this->assertEquals("test", $priceTable->getDescription());
        $this->assertEquals(66, $priceTable->getPrice());
        $this->assertEquals("10% discount", $priceTable->getDiscountKey());
    }
}
