<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Stock\Entities\Stockmovementtype;

class StockDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Stockmovementtype::create([
        'name' => 'Satın Alma',
      ]);

      Stockmovementtype::create([
        'name' => 'Havadan Giriş',
      ]);

      Stockmovementtype::create([
        'name' => 'Ters Kayıt',
      ]);

      Stockmovementtype::create([
        'name' => 'Stok Düzeltme',
      ]);

      Stockmovementtype::create([
        'name' => 'İade',
      ]);
    }
}
