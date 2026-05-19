<?php

use App\Business\Entities\Taxes;
use App\Business\Services\ProductService;

test('calcula el impuesto IVA', function () {
    $price = 100;

    $service = new ProductService();

    $result = $service->calculateIva($price);

    expect($result)->toBe($price * (1 + Taxes::IVA));
});
