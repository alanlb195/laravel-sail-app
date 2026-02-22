<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\MessageServiceInterface;
use App\Business\Services\EncryptService;
use App\Business\Services\ProductService;
use App\Models\Product;

class InfoController extends Controller
{

    public function __construct(
        protected ProductService $productService,
        protected EncryptService $encryptService,
    )
    { }

    public function message(MessageServiceInterface $hiService)
    {
        return response()->json($hiService->hi());
    }

    public function iva(int $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $iva = $this->productService->calculateIva($product->price);

        return response()->json([
            'product' => $product,
            'iva' => $iva,
        ]);
    }


    public function encrypt(string $data)
    {
        return response()->json([
            'data' => $this->encryptService->encrypt($data),
        ]);
    }

    public function decrypt(string $data)
    {
        return response()->json([
            'data' => $this->encryptService->decrypt($data),
        ]);
    }

}
