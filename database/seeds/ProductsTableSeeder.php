<?php

use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $products = [
        0 => [
            'relatedTo' => null,
            'articul' => 'a1b1c1',
            'name' => 'Super Bag',
            'price' => 10,
            'attributes' => [
                'color' => 'white',
            ],
        ],
        1 => [
            'relatedTo' => 0,
            'articul' => 'a1b1c2',
            'name' => 'Super Bag',
            'price' => 10,
            'attributes' => [
                'color' => 'yellow',
            ],
        ],
        2 => [
            'relatedTo' => 0,
            'articul' => 'a1b1c3',
            'name' => 'Super Bag',
            'price' => 9,
            'attributes' => [
                'color' => 'black',
            ],
        ],
        3 => [
            'relatedTo' => null,
            'articul' => 'a1b2c1',
            'name' => 'Regular Bag',
            'price' => 5,
            'attributes' => [
                'color' => 'white',
            ],
        ],
        4 => [
            'relatedTo' => null,
            'articul' => 'a1b3c1',
            'name' => 'Universal Bag',
            'price' => 15,
            'attributes' => [
                'color' => 'blue',
                'size' => 'm',
            ],
        ],
        5 => [
            'relatedTo' => 4,
            'articul' => 'a1b3c2',
            'name' => 'Universal Bag',
            'price' => 15,
            'attributes' => [
                'color' => 'red',
                'size' => 'm',
            ],
        ],
        6 => [
            'relatedTo' => 4,
            'articul' => 'a1b3c3',
            'name' => 'Universal Bag',
            'price' => 14,
            'attributes' => [
                'color' => 'black',
                'size' => 's',
            ],
        ],
        7 => [
            'relatedTo' => 4,
            'articul' => 'a1b3c4',
            'name' => 'Universal Bag',
            'price' => 12,
            'attributes' => [
                'color' => 'white',
                'size' => 'xs',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->products as $id => $rawProduct) {
            $product = Product::firstOrCreate([
                'articul' => $rawProduct['articul'],
            ], [
                'name' => $rawProduct['name'],
                'price' => $rawProduct['price'],
            ]);

            foreach ($rawProduct['attributes'] as $key => $value) {
                ProductAttribute::firstOrCreate([
                    'product_id' => $product->id,
                    'name' => $key,
                ], [
                    'value' => $value,
                ]);
            }

            $this->products[$id]['product'] = $product;

            if ($rawProduct['relatedTo'] !== null &&
                ($this->products[$rawProduct['relatedTo']]['product'] ?? null) !== null
            ) {
                $product->relatedTo()->associate($this->products[$rawProduct['relatedTo']]['product']);

                try {
                    $product->save();
                } catch (Exception $exception) {
                    //
                }
            }
        }
    }
}
