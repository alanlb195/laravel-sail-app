<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class QueriesController extends Controller
{
    public function get()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getById($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'producto no encontrado',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }

    public function getNames()
    {
        $products = Product::select("name")
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($products);
    }

    public function searchName($name, $price)
    {
        $product = Product::where("name", $name)
            ->where('price', '>', $price)
            ->orderBy('name', 'asc')
            ->select('name', 'description', 'price')
            ->get();

        return response()->json($product, Response::HTTP_OK);
    }

    public function searchString(string $value)
    {
        $products = Product::where('name', 'like', "%{$value}%")
            ->orWhere('description', 'like', "%{$value}%")
            ->get();
        return response()->json($products, Response::HTTP_OK);
    }

    public function advanceSearch(Request $req)
    {
        $products = Product::where(function ($query) use ($req) {
            if ($req->input("name")) {
                $query->where("name", 'like', "%{$req->input("name")}%");
            }
        })
            ->where(function ($query) use ($req) {
                if ($req->input("description")) {
                    $query->where("description", 'like', "%{$req->input("description")}%");
                }
            })
            ->where(function ($query) use ($req) {
                if ($req->input("price")) {
                    $query->where("price", '>', $req->input("price"));
                }
            })
            ->get();

        return response()->json($products, Response::HTTP_OK);
    }

    public function join()
    {
        $products = Product::join('category', 'product.category_id', '=', 'category.id')
            ->select('product.*', "category.name as category")
            ->get();

        return response()->json($products, Response::HTTP_OK);
    }

    public function groupBy()
    {
        $result = Product::join('category', 'product.category_id', '=', 'category.id')
            ->select('category.id', 'category.name', DB::raw('COUNT(product.id) as total'))
            ->groupBy('category.id', 'category.name')
            ->get();

        return response()->json($result, Response::HTTP_OK);
    }
}
