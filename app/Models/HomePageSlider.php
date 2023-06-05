<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomePageSlider extends Model{
    use SoftDeletes;
    protected $table                = 'home_page_slider';
}
