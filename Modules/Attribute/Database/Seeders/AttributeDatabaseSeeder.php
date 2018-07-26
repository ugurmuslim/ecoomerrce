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
      Attribute::create([
        'attribute_human_id' => '10',
        'attribute_id' => "1",
        'attribute_short' => "K",
        'attribute_long' => "Kırmızı",
      ]);

      Attribute::create([
        'attribute_human_id' => '11',
        'attribute_id' => "1",
        'attribute_short' => "S",
        'attribute_long' => "Siyah",
      ]);

      Attribute::create([
        'attribute_human_id' => '12',
        'attribute_id' => "1",
        'attribute_short' => "Sa",
        'attribute_long' => "Sarı",
      ]);

      Attribute::create([
        'attribute_human_id' => '13',
        'attribute_id' => "2",
        'attribute_short' => "XS",
        'attribute_long' => "XSmall",
      ]);

      Attribute::create([
        'attribute_human_id' => '14',
        'attribute_id' => "2",
        'attribute_short' => "S",
        'attribute_long' => "Small",
      ]);

      Attribute::create([
        'attribute_human_id' => '15',
        'attribute_id' => "2",
        'attribute_short' => "M",
        'attribute_long' => "Medium",
      ]);
      Attribute::create([
        'attribute_human_id' => '16',
        'attribute_id' => "2",
        'attribute_short' => "L",
        'attribute_long' => "Large",
      ]);
      Attribute::create([
        'attribute_human_id' => '17',
        'attribute_id' => "2",
        'attribute_short' => "XL",
        'attribute_long' => "XLarge",
      ]);


      Attributename::create([
        'name' => 'Renk',
      ]);

      Attribute::create([
        'name' => 'Beden',

      ]);

    }
}
