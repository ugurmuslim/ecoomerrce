<?php

namespace Modules\Unit\Entities;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [];

    public static function allInArray(){
          $units = Unit::all();
          $units2 = array();
          foreach ($units as $unit) {
            $units2[$unit->id] = $unit->name;
          }
          return $units2;
        }
}
