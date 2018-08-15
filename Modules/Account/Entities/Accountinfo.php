<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;

class Accountinfo extends Model
{
  protected $fillable = [];
    protected $table = 'account_informations';


public function user() {
  return  $this->belongsTo('App\Models\Auth\User\User','user_id');
}
}
