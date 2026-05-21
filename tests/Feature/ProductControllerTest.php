<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

uses(RefreshDatabase::class);

test('Debe listar los productos', function () {

    Product::factory()->count(15)->create();

    $response = $this->getJson('api/product?per_page=5&page=0');

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonCount(5)
        ->assertJsonStructure([
            '*' => ['id', 'name', 'price', 'description', 'category_id']
        ]);

    // $data = $response->json();

    // expect(count($data))->toBe(5);
});


test('Crear producto de manera correcta', function () {

    $category = Category::factory()->create();

    $productData = [
        'name' => 'Producto 1',
        'description' => 'Descripción del producto',
        'price' => 100,
        'category_id' => $category->id
    ];

    $response = $this->postJson(route("product.store"), $productData);

    // $response->assertStatus(Response::HTTP_OK)
    //     ->assertJsonStructure(["id", "name", "price", "description", "category_id"]);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson($productData);


    $this->assertDatabaseHas('product', $productData);
});


test('Datos de producto invalidos al mandarse a crear', function () {
    $invalidProductData = [
        'name' => '',
        'price' => 'texto',
        'description' => str_repeat("A", 3000),
        'category_id' => 123123
    ];

    $response = $this->postJson(route("product.store"), $invalidProductData);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonValidationErrors(['name', 'price', 'description', 'category_id']);
});


test('Actualizar un producto', function () {

    $category = Category::factory()->create();

    $product = Product::factory()->create([
        "category_id" => $category->id
    ]);

    $newCategory = Category::factory()->create();

    $data = [
        'name' => 'Producto actualizado',
        'price' => 199.99,
        'description' => 'Una descripcion',
        'category_id' => $newCategory->id
    ];

    $response = $this->putJson(route("product.update", $product), $data);

    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'message' => 'Producto actualizado exitosamente',
            'product' => [
                'id' => $product->id,
                'name' => 'Producto actualizado',
                'price' => 199.99,
                'description' => 'Una descripcion',
                'category_id' => $newCategory->id
            ]
        ]);
});
