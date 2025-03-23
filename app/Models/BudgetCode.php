<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'description', 'created_by', 'edited_by'];

    public function projections()
    {
        return $this->hasMany(Projection::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
