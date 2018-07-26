<?php

namespace Modules\Attribute\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\Attributename;

class AttributeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Attribute::insert([
        'attribute_human_id' => '10',
        'attribute_id' => "1",
        'attribute_short' => "K",
        'attribute_long' => "Kırmızı",
      ]);

      Attribute::insert([
        'attribute_human_id' => '11',
        'attribute_id' => "1",
        'attribute_short' => "S",
        'attribute_long' => "Siyah",
      ]);

      Attribute::insert([
        'attribute_human_id' => '12',
        'attribute_id' => "1",
        'attribute_short' => "Sa",
        'attribute_long' => "Sarı",
      ]);

      Attribute::insert([
        'attribute_human_id' => '13',
        'attribute_id' => "2",
        'attribute_short' => "XS",
        'attribute_long' => "XSmall",
      ]);

      Attribute::insert([
        'attribute_human_id' => '14',
        'attribute_id' => "2",
        'attribute_short' => "S",
        'attribute_long' => "Small",
      ]);

      Attribute::insert([
        'attribute_human_id' => '15',
        'attribute_id' => "2",
        'attribute_short' => "M",
        'attribute_long' => "Medium",
      ]);
      Attribute::insert([
        'attribute_human_id' => '16',
        'attribute_id' => "2",
        'attribute_short' => "L",
        'attribute_long' => "Large",
      ]);
      Attribute::insert([
        'attribute_human_id' => '17',
        'attribute_id' => "2",
        'attribute_short' => "XL",
        'attribute_long' => "XLarge",
      ]);


      Attributename::insert([
        'name' => 'Renk',
      ]);

      Attribute::insert([
        'name' => 'Beden',

      ]);

    }
}
