<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'contract_number', 
        'title', 
        'company_id', 
        'contract_type_id',
        'budget_code_id', 
        'contract_value', 
        'start_date', 
        'end_date',
        'cost_center', 
        'order_date', 
        'transaction_no', 
        'supplier_id', 
        'order_no',
        'entry_date', 
        'requested_by', 
        'document_received_date', 
        'status',
        'requester_contact_no', 
        'expected_date', 
        'print_status', 
        'requisition_no',
        'quotation_no', 
        'sst_amount', 
        'reference_no', 
        'total_order',
        'purchase_method', 
        'document_type',
        'created_by', 
        'edited_by'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }

    public function budgetCode()
    {
        return $this->belongsTo(BudgetCode::class);
    }

    public function projections()
    {
        return $this->hasMany(Projection::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
