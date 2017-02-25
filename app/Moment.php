<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moment extends Model
{
    protected $table = 'moments';
    protected  $fillable = ['content', 'host'];
}
