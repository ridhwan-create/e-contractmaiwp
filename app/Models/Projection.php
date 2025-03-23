<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'contract_id', 
        'budget_code_id', 
        'year',
        'entity_code',
        'fund_code',
        'asnaf_code',
        'department_code',
        'program_code',
        'project_code',
        'expense_code_id', 
        'amount', 
        'remaining_projection', 
        'created_by', 
        'edited_by'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function budgetCode()
    {
        return $this->belongsTo(BudgetCode::class);
    }

    public function expenseCode()
    {
        return $this->belongsTo(ExpenseCode::class, 'expense_code_id');
    }

}
