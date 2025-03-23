<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['contract_id', 'expense_code_id', 'amount', 'payment_date', 'status', 'created_by', 'edited_by', 'projection_id'];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function projection()
    {
        return $this->belongsTo(Projection::class, 'projection_id');
    }

    // public function expenseCode()
    // {
    //     return $this->belongsTo(ExpenseCode::class);
    // }

    public function expenseCode()
    {
        return $this->belongsTo(ExpenseCode::class, 'expense_code_id');
    }

}
