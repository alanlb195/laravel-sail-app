<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $req)
    {
        // $limit = $req->query("limit", 10);
        // $offset = $req->query("offset", 0);

        $per_page = $req->query("per_page", 10);
        $page = $req->query("page", 1);
        $offset = $per_page * ($page - 1);


        $products = Product::skip($offset)->take($per_page)->get();

        return response()->json($products, Response::HTTP_OK);
    }


    public function store(Request $req)
    {
        try {

            $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:2000',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:category,id'
            ], [
                'name.required' => 'Name requerido',
                'name.string' => 'Name debe ser string',
                'name.max' => 'Name debe tener un max de 255 caracteres'
            ]);

            $product = Product::create($validatedData);

            return response()->json($product);
        } catch (ValidationException $e) {
            return response()->json(["error" => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    public function update(UpdateProductRequest $req, Product $product)
    {
        try {
            // dd($product->id);
            $validatedData = $req->validated();

            $product->update($validatedData);

            return response()->json(["message" => "Producto actualizado exitosamente", "product" => $product], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(["error: " => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(["message" => "producto eliminado"], Response::HTTP_OK);
    }
}
