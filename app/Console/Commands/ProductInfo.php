<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class ProductInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:product-info {id : Id del producto a consultar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Muestra la informacion de un producto pasando como argumento su id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument("id");

        if (!is_numeric($id) || $id <= 0) {
            $this->error("El id debe ser un numero positivo.");
            return Command::FAILURE;
        }

        $product = Product::select('name', 'description', 'price')->find($id);

        if (! $product) {
            $this->error("No se encontro ningun producto con el id {$id}");
            return Command::FAILURE;
        }

        $this->table(
            ["Nombre", "Descripcion", "Precio"],
            [[$product->name, $product->description, $product->price]]
        );

        return Command::SUCCESS;
    }
}
