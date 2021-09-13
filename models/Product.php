<?php

namespace app\models;

use yii\base\BaseObject;

class Product extends BaseObject
{
    private int $id;
    private string $name;
    private float $price;
    private ProductCategory $category;
    private Discount $discount;

    public function __construct(int $id, string $name, float $price, ProductCategory $category, Discount $discount = NULL)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->discount = $discount != NULL ? $discount : new Discount();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceWithAllDiscountsApplied() : float
    {
        return $this->price -
            $this->getPriceWithProductDiscount() -
            $this->getPriceWithCategoryDiscount();
    }

    public function getPriceWithProductDiscount() : float
    {
        return $this->discount->calculatePriceWithDiscount($this->price);
    }

    public function getPriceWithCategoryDiscount() : float
    {
        return $this->getCategory()->getDiscount()->calculatePriceWithDiscount($this->price);
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCategory(): ProductCategory
    {
        return $this->category;
    }

    public function setCategory(ProductCategory $category): void
    {
        $this->category = $category;
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