<?php

namespace app\models;

use yii\base\BaseObject;

define('TYPE_PERCENTAGE', 'percentage_discount');
define('TYPE_ABSOLUTE', 'absolute_discount');

class Discount extends BaseObject
{
    private float $discountAmount;
    private string $discountType;

    public function __construct(float $discountAmount = 0.00, string $discountType = TYPE_PERCENTAGE)
    {
        parent::__construct();
        $this->discountAmount = $discountAmount;
        $this->discountType = $discountType;
    }

    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    public function setDiscountAmount(float $discountAmount): void
    {
        $this->discountAmount = $discountAmount;
    }

    public function getDiscountType(): string
    {
        return $this->discountType;
    }

    public function setDiscountType(string $discountType): void
    {
        $this->discountType = $discountType;
    }

    public function calculatePriceWithDiscount(float $amount)
    {
        $finalPrice = $amount;
        if ($this->discountAmount > 0)
        {
            switch ($this->discountType)
            {
                case TYPE_ABSOLUTE:
                    $finalPrice = $amount - $this->discountAmount;
                    break;
                case TYPE_PERCENTAGE:
                    $finalPrice -= ($finalPrice * ($this->discountAmount / 100));
                    break;
            }
        }
        return $finalPrice;
    }
}