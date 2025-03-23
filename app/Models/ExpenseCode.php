<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'description', 'created_by', 'edited_by'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
