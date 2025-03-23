<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'registration_number', 'address', 'phone', 'email', 'created_by', 'edited_by'];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
