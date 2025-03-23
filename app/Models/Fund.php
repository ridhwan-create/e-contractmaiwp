<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'description', 'created_by', 'edited_by'];
}
