<?php

namespace App\Business\Services;

use App\Business\Entities\Taxes;

class ProductService
{

    public function calculateIva(float $price): float
    {
        return $price * (1 + Taxes::IVA);
    }
}