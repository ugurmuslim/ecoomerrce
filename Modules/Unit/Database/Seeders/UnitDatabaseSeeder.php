<?php

namespace Modules\Unit\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Unit\Entities\Unit;

class UnitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Unit::create([
        'name' => 'Adet',
      ]);
    }
}
