<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;

class ProductDatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $y = 1000;
    for ($i=1; $i <= 30; $i++) {

      Product::create([
        'name' => 'Elbise '.$i,
        'product_id' => $i,
        'slug' => 'Elbise-'.$i,
        'price' => rand(1, 100),
        'details' =>'Lorem '. $i . ' ipsum dolor sit amet, consectetur adipisicing elit. Ipsum temporibus iusto ipsa, asperiores voluptas unde aspernatur praesentium in? Aliquam, dolore!',
        'category_id' => 1,
        'unit_id' => 1,
      ]);
      $y = $y + 1;
    }
  }
}
