<?php

namespace WirelessLogic\Tests\Scrapper\Application;

use PHPUnit\Framework\TestCase;
use WirelessLogic\Scrapper\PriceTable\Domain\Price;
use WirelessLogic\Scrapper\PriceTable\Domain\PriceTable;
use WirelessLogic\Scrapper\PriceTable\Domain\PriceTableCollection;

final class PriceTableCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collection = new PriceTableCollection();

        $this->assertEquals(-1, $collection->key());

        $priceTable = PriceTable::fromArray(
            [
                'title' => "test",
                'description' => "test",
                'price' => 66,
                'discountKey' => "10% discount"
            ]
        );

        $collection->add($priceTable);
        $collection->add($priceTable);

        $this->assertEquals(1, $collection->key());
    }
}
