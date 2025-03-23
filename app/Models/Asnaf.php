<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asnaf extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'asnaf';

    protected $fillable = ['code', 'description', 'created_by', 'edited_by'];
}
