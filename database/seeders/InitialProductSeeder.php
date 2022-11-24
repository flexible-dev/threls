<?php

namespace Database\Seeders;

use App\Models\Product\Product;
use Illuminate\Database\Seeder;

class InitialProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        print_r("Loading a product csv file... \n");
        $csvFile = fopen(storage_path('app/product/products.csv'), 'r');
        print_r("Success ... \n");
        print_r("Start the data processing ... \n");

        $rowNum = 0;
        $products = [];

        while(($row = fgetcsv($csvFile, 1000, ',')) !== false) {
            if ($rowNum == 0) {
                $rowNum++;
                continue;
            }

            if ($row[0] && $row[1] && $row[2] )

                $time = now();
                array_push($products, [
                    'name' => $row['0'],
                    'brand' => $row['1'],
                    'price' => (float) ($row['2']),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);

            $rowNum++;
        }

        print_r("Done ... \n");
        if (count($products) > 0) {
            print_r("Inserting the products to database ... \n");
            try {
                foreach (array_chunk($products,1000) as $productChunk)
                {
                    Product::insert($productChunk);
                }

            } catch (\Throwable $th) {
                print_r($products[2]);
                print_r(substr($th->getMessage(), 0, 400));
            }
        }

        print_r("Imported ".count($products).'/'.($rowNum-1)." were imported successfully\n");
    }
}
