<?php

namespace app\models;

use yii\base\BaseObject;

class Cart extends BaseObject
{
    private User $customer;
    private array $productList;
    private Discount $discount;

    public function __construct(User $customer, Discount $discount = NULL)
    {
        parent::__construct();
        $this->customer = $customer;
        $this->productList = [];
        $this->discount = $discount;
    }

    public function addProduct(Product $product)
    {
        $this->productList[$product->getId()] = $product;
    }

    public function totalCalculation() : float
    {
        $total = 0.00;
        foreach ($this->productList as $id => $product)
        {
            $total += $product->getPriceWithAllDiscountsApplied();
        }
        $total = $this->applyCartDiscount($total);
        return $this->applyGroupClientDiscount($total);
    }

    private function applyCartDiscount($total) : float
    {
        return $this->discount->calculatePriceWithDiscount($total);
    }

    private function applyGroupClientDiscount($total) : float
    {
        return $this->customer->getClientGroup()->getDiscount()->calculatePriceWithDiscount($total);
    }

    public function setDiscount(Discount $discount): void
    {
        $this->discount = $discount;
    }
}