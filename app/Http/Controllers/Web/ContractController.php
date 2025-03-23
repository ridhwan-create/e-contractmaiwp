<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Company;
use App\Models\ContractType;
use App\Models\BudgetCode;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with(['company', 'contractType', 'budgetCode'])->get();
        return view('contracts.index', compact('contracts'));
    }

    // public function show($id)
    // {
    //     $contract = Contract::with(['company', 'contractType', 'budgetCode'])->findOrFail($id);
    //     return view('contracts.view', compact('contract'));
    // }

    // public function show($id)
    // {
    //     $contract = Contract::with(['projections.budgetCode', 'payments'])->findOrFail($id);
    //     return view('contracts.view', compact('contract'));
    // }

    // public function show($id)
    // {
    //     $contract = Contract::with(['payments.projection'])->findOrFail($id);
    //     return view('contracts.view', compact('contract'));
    // }

    // public function show($id)
    // {
    //     $contract = Contract::with(['company', 'contractType', 'budgetCode', 'projections', 'payments'])
    //         ->findOrFail($id);
    
    //     $perPage = request('per_page', 10); // Default 10 rekod per page
    //     $payments = $contract->payments()->paginate($perPage);
    
    //     return view('contracts.view', compact('contract', 'payments'));
    // }    

    public function show($id)
    {
        $contract = Contract::with(['company', 'contractType', 'budgetCode'])
            ->findOrFail($id);

        $projectionsPerPage = request('projections_per_page', 10);
        $paymentsPerPage = request('payments_per_page', 10);

        // $projections = $contract->projections()->paginate($projectionsPerPage, ['*'], 'projectionsPage');
        $projections = $contract->projections()->with('expenseCode')->paginate($projectionsPerPage, ['*'], 'projectionsPage');

        // $payments = $contract->payments()->paginate($paymentsPerPage, ['*'], 'paymentsPage');
        $payments = $contract->payments()->with('expenseCode')->paginate($paymentsPerPage, ['*'], 'paymentsPage');

        return view('contracts.view', compact('contract', 'projections', 'payments'));
    }

    public function create()
    {
        $companies = Company::all();
        $contractTypes = ContractType::all();
        $budgetCodes = BudgetCode::all();

        return view('contracts.create', compact('companies', 'contractTypes', 'budgetCodes'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'contract_number' => 'required|unique:contracts',
    //         'title' => 'required',
    //         'company_id' => 'required|exists:companies,id',
    //         'contract_type_id' => 'required|exists:contract_types,id',
    //         'budget_code_id' => 'required|exists:budget_codes,id',
    //         'contract_value' => 'required|numeric',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //     ]);

    //     Contract::create($request->all() + ['created_by' => auth()->id()]);

    //     return redirect()->route('contracts.index')->with('success', 'Kontrak berjaya ditambah!');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'contract_number' => 'required|unique:contracts|string|max:255',
            'title' => 'required|string|max:500',
            'company_id' => 'required|exists:companies,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'budget_code_id' => 'required|exists:budget_codes,id',
            'contract_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:AKTIF,TIDAK AKTIF,TAMAT',
            'cost_center' => 'nullable|string|max:255',
            'order_date' => 'nullable|date',
            'transaction_no' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|string|max:255',
            'order_no' => 'nullable|string|max:255',
            'sst_amount' => 'nullable|numeric|min:0',
            'purchase_method' => 'nullable|in:TENDER,SEBUTHARGA,PEMBELIAN TERUS',
        ], [
            'contract_number.required' => 'Nombor kontrak wajib diisi.',
            'contract_number.unique' => 'Nombor kontrak telah wujud, sila gunakan nombor lain.',
            'title.required' => 'Tajuk kontrak wajib diisi.',
            'company_id.required' => 'Syarikat mesti dipilih.',
            'company_id.exists' => 'Syarikat yang dipilih tidak sah.',
            'contract_type_id.required' => 'Jenis kontrak mesti dipilih.',
            'contract_type_id.exists' => 'Jenis kontrak yang dipilih tidak sah.',
            'budget_code_id.required' => 'Kod bajet mesti dipilih.',
            'budget_code_id.exists' => 'Kod bajet yang dipilih tidak sah.',
            'contract_value.required' => 'Nilai kontrak wajib diisi.',
            'contract_value.numeric' => 'Nilai kontrak mesti dalam bentuk angka.',
            'contract_value.min' => 'Nilai kontrak mesti sekurang-kurangnya RM 0.',
            'start_date.required' => 'Tarikh mula wajib diisi.',
            'start_date.date' => 'Tarikh mula tidak sah.',
            'end_date.required' => 'Tarikh tamat wajib diisi.',
            'end_date.date' => 'Tarikh tamat tidak sah.',
            'end_date.after_or_equal' => 'Tarikh tamat mesti selepas atau sama dengan tarikh mula.',
            'status.required' => 'Status kontrak mesti dipilih.',
            'status.in' => 'Status yang dipilih tidak sah.',
            'cost_center.string' => 'Cost Center mesti dalam bentuk teks.',
            'transaction_no.string' => 'No. transaksi mesti dalam bentuk teks.',
            'supplier_id.string' => 'ID pembekal mesti dalam bentuk teks.',
            'order_no.string' => 'No. pesanan mesti dalam bentuk teks.',
            'sst_amount.numeric' => 'Jumlah SST mesti dalam bentuk angka.',
            'sst_amount.min' => 'Jumlah SST mesti sekurang-kurangnya RM 0.',
            'purchase_method.in' => 'Kaedah pembelian yang dipilih tidak sah.',
        ]);
    
        // Convert input kepada huruf besar (uppercase)
        $data = $request->all();
        $data['contract_number'] = strtoupper($data['contract_number']);
        $data['title'] = strtoupper($data['title']);
        $data['cost_center'] = strtoupper($data['cost_center'] ?? '');
        $data['transaction_no'] = strtoupper($data['transaction_no'] ?? '');
        $data['supplier_id'] = strtoupper($data['supplier_id'] ?? '');
        $data['order_no'] = strtoupper($data['order_no'] ?? '');
        $data['created_by'] = auth()->id();
    
        // Simpan ke dalam pangkalan data
        Contract::create($data);
    
        return redirect()->route('contracts.index')->with('success', 'Kontrak berjaya ditambah!');
    }
    


    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        $companies = Company::all();
        $contractTypes = ContractType::all();
        $budgetCodes = BudgetCode::all();

        return view('contracts.edit', compact('contract', 'companies', 'contractTypes', 'budgetCodes'));
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $request->validate([
            'contract_number' => 'required|unique:contracts,contract_number,' . $id,
            'title' => 'required',
            'company_id' => 'required|exists:companies,id',
            'contract_type_id' => 'required|exists:contract_types,id',
            'budget_code_id' => 'required|exists:budget_codes,id',
            'contract_value' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $contract->update($request->all() + ['edited_by' => auth()->id()]);

        return redirect()->route('contracts.index')->with('success', 'Kontrak berjaya dikemas kini!');
    }

    public function destroy($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Kontrak berjaya dihapuskan!');
    }
}
