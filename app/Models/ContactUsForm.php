<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUsForm extends Model{
    use SoftDeletes;
    protected $table                = 'contact_us_form';
}
