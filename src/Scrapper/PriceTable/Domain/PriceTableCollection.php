<?php

namespace WirelessLogic\Scrapper\PriceTable\Domain;

class PriceTableCollection // implements ... - use here proper php array interfaces - to be implemented
{
    private int $index = -1;
    private array $data;

    public function add(PriceTable $priceTable) : void
    {
        $this->data[] = $priceTable;
    }

    public function sortByPriceAscending() : self
    {
        usort($this->data, [$this, 'cmp']);
        $this->rewind();
        return $this;
    }

    private function cmp(PriceTable $a, PriceTable $b) : int
    {
        return $a->getPrice() < $b->getPrice() ? 1 : 0;
    }

    public function next()
    {
        $this->index++;
    }

    public function rewind() {
        $this->index = 0;
    }

    public function current() : PriceTable
    {
        return $this->data[$this->index];
    }

    public function key() : int
    {
        return $this->index;
    }

    public function valid() : bool
    {
        return array_key_exists($this->index, $this->data);
    }

    public function toArray()
    {
        $result = [];

        /**
         * @var PriceTable $pt
         */
        foreach($this->data as $pt) {
            $result[] = [
                'title' => $pt->getTitle(),
                'description' => $pt->getDescription(),
                'price' => $pt->getPrice(),
                'discountKey' => $pt->getDiscountKey()
            ];
        }

        return $result;
    }
}