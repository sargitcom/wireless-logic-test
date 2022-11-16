<?php

namespace WirelessLogic\Scrapper\PriceTable\Domain;

class PriceTable
{
    private string $title; // here, can be in use Value Object; for example PriceTableTitle

    private string $description; // here, can be in use Value Object; for example PriceTableDescription

    private Price $price; // here, can be in use Value Object; for example PriceTablePrice

    private string $discountKey; // here, can be in use Value Object; for example PriceTableDiscountKey
                                 // also, we could use here null object if no discount key provided

    /**
     * @param string $title
     * @param string $description
     * @param string $price
     * @param string $discountKey
     */
    private function __construct(string $title, string $description, Price $price, string $discountKey)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->discountKey = $discountKey;
    }

    public static function fromArray(array $priceTable) : self
    {
        return new self(
            $priceTable['title'],
            $priceTable['description'],
            Price::fromScrappedValue($priceTable['price']),
            $priceTable['discountKey']
        );
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price->getAmount();
    }

    /**
     * @return string
     */
    public function getDiscountKey(): string
    {
        return $this->discountKey;
    }
}
