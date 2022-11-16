<?php

namespace WirelessLogic\Scrapper\Infrastructure\Puphpeteer;

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;
use WirelessLogic\Scrapper\Domain\SiteRepository as SiteRepositoryAlias;
use WirelessLogic\Scrapper\PriceTable\Domain\PriceTable;
use WirelessLogic\Scrapper\PriceTable\Domain\PriceTableCollection;


class SiteRepository implements SiteRepositoryAlias
{
    public function scrapPriceTables() : PriceTableCollection
    {
        $puppeteer = new Puppeteer;

        $browser = $puppeteer->launch(['args' => ['--no-sandbox', '--disable-setuid-sandbox']]);
        $page = $browser->newPage();
        $page->goto('https://wltest.dns-systems.net');

        $elements = $page->evaluate(JsFunction::createWithBody("
            const elements = document.querySelectorAll('.package');
            
            const elementsArray =Array.from(elements);
            
            const data = [];
            
            for(index in elementsArray) {
                const title = elementsArray[index].querySelector('h3').textContent;
                const price = elementsArray[index].querySelector('.price-big').textContent;
                const description = elementsArray[index].querySelector('.package-name').textContent;
                const discount = elementsArray[index].querySelector('.package-price').querySelector('p');

                let discountKey = '';

                if (discount !== null) {
                    discountKey = discount.textContent;
                }

                data.push({
                   title: title,
                   price: price,
                   description: description,      
                   discountKey: discountKey,         
                });
            }
        
            return data;
        "));

        $browser->close();

        $data = new PriceTableCollection();

        foreach ($elements as $element) {
            $data->add(PriceTable::fromArray($element));
        }

        $data->sortByPriceAscending();

        return $data;
    }
}
