<?php

namespace app\models;

class ClientGroup
{
    private string $name;
    private Discount $discount;

    public function __construct(string $name, Discount $discount = NULL)
    {
        $this->name = $name;
        $this->discount = $discount != NULL ? $discount : new Discount();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDiscount(): Discount
    {
        return $this->discount;
    }

    public function setDiscount(Discount $discount): void
    {
        $this->discount = $discount;
    }
}