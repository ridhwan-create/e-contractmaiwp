<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allocation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'year',
        'total_allocation',
        'created_by',
        'edited_by',
    ];
}
