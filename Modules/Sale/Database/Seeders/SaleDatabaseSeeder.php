<?php

namespace Modules\Sale\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Entities\Sale;

class SaleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Sale::create([
        'name' => 'Satış',
      ]);

      Sale::create([
        'name' => 'İade',
      ]);
      Sale::create([
        'name' => 'Kampanya',
      ]);

      Sale::create([
        'name' => 'Kapanış Düzeltme',
      ]);

      Sale::create([
        'name' => 'Online',
      ]);


    }
}
