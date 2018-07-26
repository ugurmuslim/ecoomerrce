<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Category::create([
        'name' => 'Pantolon',
        'slug' => 'Pantolon',
        'number_low' => "100000",
        'number_high' => "109999",
      ]);

      Category::create([
        'name' => 'Ceket',
        'slug' => 'Ceket',
        'number_low' => "110000",
        'number_high' => "119999",
      ]);

      Category::create([
        'name' => 'Gömlek',
        'slug' => 'Gomlek',
        'number_low' => "120000",
        'number_high' => "129999",
      ]);
      Category::create([
        'name' => 'T-shirt',
        'slug' => 'T-shirt',
        'number_low' => "130000",
        'number_high' => "139999",
      ]);
      Category::create([
        'name' => 'Elbise',
        'slug' => 'Elbise',
        'number_low' => "140000",
        'number_high' => "149999",
      ]);

      Category::create([
        'name' => 'Etek',
        'slug' => 'Etek',
        'number_low' => "150000",
        'number_high' => "159999",
      ]);

      Category::create([
        'name' => 'Tulum',
        'slug' => 'Tulum',
        'number_low' => "160000",
        'number_high' => "169999",
      ]);

      Category::create([
        'name' => 'Kazak',
        'slug' => 'Kazak',
        'number_low' => "170000",
        'number_high' => "179999",
      ]);

      Category::create([
        'name' => 'Büstiyer',
        'slug' => 'Bustiyer',
        'number_low' => "180000",
        'number_high' => "189999",
      ]);
      Category::create([
        'name' => 'Salopet',
        'slug' => 'Salopet',
        'number_low' => "190000",
        'number_high' => "199999",
      ]);
      Category::create([
        'name' => 'Tayt ',
        'slug' => 'Tayt',
        'number_low' => "200000",
        'number_high' => "209999",
      ]);
      Category::create([
        'name' => 'Hırka',
        'slug' => 'Hırka',
        'number_low' => "210000",
        'number_high' => "219999",
      ]);

      Category::create([
        'name' => 'Sweat-shirt',
        'slug' => 'Sweat-shirt',
        'number_low' => "220000",
        'number_high' => "229999",
      ]);
      Category::create([
        'name' => 'Bluz',
        'slug' => 'Bluz',
        'number_low' => "230000",
        'number_high' => "239999",
      ]);
      Category::create([
        'name' => 'Atlet',
        'slug' => 'Atlet',
        'number_low' => "240000",
        'number_high' => "249999",
      ]);
      Category::create([
        'name' => 'Şort',
        'slug' => 'Sort',
        'number_low' => "250000",
        'number_high' => "259999",
      ]);

    }
}
