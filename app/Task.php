<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

    protected $dates = ['created_at'];

    protected $fillable = [
        'id', 'descripcion', 'urlimage', 'order', 'status',
    ];
}
