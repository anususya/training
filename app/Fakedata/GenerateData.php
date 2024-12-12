<?php

namespace Fakedata;

use Faker\Factory;
use Faker\Generator;
use Iterator as Iterator;
class GenerateData
{
    public array $data = [];
    private ?Generator $faker = null;

    public function generateFakeData(int $from = 78, int $to = 79): Iterator
    {
        for ($i = $from; $i <= $to; $i++) {
            if (!$this->faker) {
                $this->faker = Factory::create();
            }

            $this->data['product_id'] = $i;
            $this->data['product_name'] = $this->faker->word();
            $this->data['supplier_id'] = $this->faker->numberBetween(1, 27);
            $this->data['category_id'] = $this->faker->numberBetween(1, 8);
            $this->data['quantity_per_unit'] = $this->faker->numberBetween(1, 999);
            $this->data['unit_price'] = $this->faker->randomFloat(null, 0, 999);
            $this->data['units_in_stock'] = $this->faker->numberBetween(1, 999);
            $this->data['units_on_order'] = $this->faker->numberBetween(1, 999);
            $this->data['reorder_level'] = $this->faker->numberBetween(0, 30);
            $this->data['discontinued'] = $this->faker->numberBetween(0, 1);

            yield $this->data;
        }
    }

    public function generateArray(int $count, int $from = 1, int $to = 999): array
    {
        if (!$this->faker) {
            $this->faker = Factory::create();
        }

        $array = [];

        for ($i = 0; $i < $count; $i++) {
            $array[$i] = $this->faker->numberBetween($from, $to);
        }

        return $array;
    }
}
