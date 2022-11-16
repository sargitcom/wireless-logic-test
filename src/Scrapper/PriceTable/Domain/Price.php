<?php

namespace WirelessLogic\Scrapper\PriceTable\Domain;

class Price
{
    private string $currency;

    private float $amount;

    /**
     * @param string $currency
     * @param float $amount
     */
    public function __construct(string $currency, float $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public static function fromScrappedValue(string $scrappedValue) : self
    {
        $currency = $scrappedValue[0]; // simplified, another value object should be provided here with propper logic
                                       // to read currency from string

        $amount = floatval(preg_replace("/[^0-9.]/", "", $scrappedValue));

        return new self(
            $currency,
            $amount
        );
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}