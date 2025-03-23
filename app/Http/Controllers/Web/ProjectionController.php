<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Projection;
use App\Models\Contract;
use App\Models\BudgetCode;
use App\Models\ExpenseCode;
use Illuminate\Http\Request;

use App\Models\EntityCode;
use App\Models\Fund;
use App\Models\Asnaf;
use App\Models\Department;
use App\Models\Program;
use App\Models\Project;


class ProjectionController extends Controller
{
    public function index()
    {
        return view('projections.index', ['projections' => Projection::all()]);
    }

    // public function create(Request $request)
    // {
    //     $contract = Contract::findOrFail($request->contract_id);
    //     $budgetCodes = \App\Models\BudgetCode::all(); // Ambil semua kod bajet
    
    //     return view('projections.create', compact('contract', 'budgetCodes'));
    // }

    // public function create(Request $request)
    // {
    //     $contract = Contract::findOrFail($request->contract_id);
    //     $budgetCodes = BudgetCode::all();
    //     $expenseCodes = ExpenseCode::all(); // Ambil semua kod belanja

    //     return view('projections.create', compact('contract', 'budgetCodes', 'expenseCodes'));
    // }

    public function create(Request $request)
    {
        $contract = Contract::findOrFail($request->contract_id);
        $budgetCodes = BudgetCode::all();
        $expenseCodes = ExpenseCode::all(); // Ambil semua kod belanja
        $entityCodes = EntityCode::all(); // Ambil semua kod entiti
        $funds = Fund::all(); // Ambil semua kod dana
        $asnaf = Asnaf::all(); // Ambil semua kod asnaf
        $departments = Department::all(); // Ambil semua kod bahagian
        $programs = Program::all(); // Ambil semua kod program
        $projects = Project::all(); // Ambil semua kod projek

        return view('projections.create', compact(
            'contract',
            'budgetCodes',
            'expenseCodes',
            'entityCodes',
            'funds',
            'asnaf',
            'departments',
            'programs',
            'projects'
        ));
    }



    // public function store(Request $request)
    // {
    //     Projection::create($request->all() + ['created_by' => auth()->id()]);
    //     return redirect()->route('projections.index')->with('success', 'Unjuran berjaya ditambah!');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'contract_id' => 'required|exists:contracts,id',
    //         'budget_code_id' => 'required|exists:budget_codes,id',
    //         'year' => 'required|digits:4',
    //         'amount' => 'required|numeric|min:1',
    //     ]);
    
    //     \App\Models\Projection::create([
    //         'contract_id' => $request->contract_id,
    //         'budget_code_id' => $request->budget_code_id,
    //         'year' => $request->year,
    //         'amount' => $request->amount,
    //         'remaining_projection' => $request->amount,
    //         'created_by' => auth()->id(),
    //     ]);
    
    //     return redirect()->route('contracts.show', $request->contract_id)
    //                      ->with('success', 'Unjuran berjaya didaftarkan!');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'contract_id'      => 'required|exists:contracts,id',
            'budget_code_id'   => 'required|exists:budget_codes,id',
            'expense_code_id'  => 'required|exists:expense_codes,id',
            'year'             => 'required|digits:4',
            'entity_code_id'      => 'required|string|max:255',
            'fund_id'        => 'required|string|max:255',
            'asnaf_id'       => 'required|string|max:255',
            'department_id'  => 'required|string|max:255',
            'program_id'     => 'required|string|max:255',
            'project_id'     => 'required|string|max:255',
            'amount'           => 'required|numeric|min:1',
            'title'        => 'required|string|max:255',
        ]);

        \App\Models\Projection::create([
            'contract_id'        => $request->contract_id,
            'budget_code_id'     => $request->budget_code_id,
            'expense_code_id'    => $request->expense_code_id,
            'year'               => $request->year,
            'entity_code'        => $request->entity_code_id,
            'fund_code'          => $request->fund_id,
            'asnaf_code'         => $request->asnaf_id,
            'department_code'    => $request->department_id,
            'program_code'       => $request->program_id,
            'project_code'       => $request->project_id,
            'amount'             => $request->amount,
            'title'             => $request->title,
            'remaining_projection' => $request->amount, // Set nilai default
            'created_by'         => auth()->id(),
        ]);

        return redirect()->route('contracts.show', $request->contract_id)
                        ->with('success_projections', 'Unjuran berjaya didaftarkan!');
    }


    // public function edit(Projection $projection)
    // {
    //     $contracts = Contract::all();
    //     $entityCodes = EntityCode::all();
    //     $funds = Fund::all();
    //     $asnaf = Asnaf::all();
    //     $departments = Department::all();
    //     $programs = Program::all();
    //     $projects = Project::all();
    //     $expenseCodes = ExpenseCode::all();
    //     $budgetCodes = BudgetCode::all();
    
    //     return view('projections.edit', compact(
    //         'contracts', 'projection', 
    //         'entityCodes', 'funds', 'asnaf', 'departments', 
    //         'programs', 'projects', 'expenseCodes', 'budgetCodes'
    //     ));
    // }

    public function edit(Projection $projection)
    {
        $contracts = Contract::all();
        $entityCodes = EntityCode::all();
        $funds = Fund::all();
        $asnaf = Asnaf::all();
        $departments = Department::all();
        $programs = Program::all();
        $projects = Project::all();
        $expenseCodes = ExpenseCode::all();
        $budgetCodes = BudgetCode::all();

        return view('projections.edit', compact(
            'contracts', 'projection', 
            'entityCodes', 'funds', 'asnaf', 'departments', 
            'programs', 'projects', 'expenseCodes', 'budgetCodes'
        ));
    }
    

    // public function update(Request $request, Projection $projection)
    // {
    //     $projection->update($request->all() + ['edited_by' => auth()->id()]);
    //     return redirect()->route('projections.index')->with('success', 'Unjuran berjaya dikemas kini!');
    // }

    // public function update(Request $request, Projection $projection)
    // {
    //     // // Validasi input
    //     // $request->validate([
    //     //     'amount' => 'required|numeric|min:1',
    //     // ]);

    //     $projection->update($request->all() + ['edited_by' => auth()->id()]);

    //     // Kemas kini rekod dengan nilai baru
    //     $projection->update([
    //         'amount' => $request->amount,
    //         'remaining_projection' => $request->amount,
    //         'edited_by' => auth()->id(),
    //     ]);

    //     return redirect()->route('projections.index')
    //                     ->with('success', 'Unjuran berjaya dikemas kini!');
    // }

    public function update(Request $request, Projection $projection)
    {
        // Validasi input
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Kemas kini semua medan dari $request, dan tambah/tindih dengan nilai yang dikira
        $projection->update(
            $request->all() + [
                'remaining_projection' => $request->amount,
                'edited_by' => auth()->id(),
            ]
        );

        return redirect()->route('contracts.show', $request->contract_id)
                        ->with('success', 'Unjuran berjaya dikemas kini!');
    }

    public function destroy(Projection $projection)
    {
        $projection->delete();
        return redirect()->route('projections.index')->with('success', 'Unjuran berjaya dihapuskan!');
    }
}
