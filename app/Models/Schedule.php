<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model{
    use SoftDeletes;
    protected $table                = 'schedule';

    public function city() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
