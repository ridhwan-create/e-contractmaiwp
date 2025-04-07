<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $totalAllocation = Allocation::sum('total_allocation');
    //     $totalContracts = Contract::count();
    //     $totalPayments = Payment::sum('amount');

    //     $remainingAllocation = $totalAllocation - $totalPayments;

    //     //$totalStaffBTM = User::role('btm')->count();

    //     // Monthly Payments Chart
    //     $rawMonthly = Payment::selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
    //     ->groupBy('month')
    //     ->pluck('total', 'month')
    //     ->toArray();
    
    //     // Inisialisasi array 12 bulan dengan nilai 0
    //     $monthlyPayments = array_fill(0, 12, 0);
        
    //     // Masukkan nilai dari database
    //     foreach ($rawMonthly as $month => $total) {
    //         $monthlyPayments[$month - 1] = $total; // -1 sebab array index mula dari 0
    //     }
    

    //     // Contract Types Chart
    //     $contractTypes = Contract::select('purchase_method', \DB::raw('count(*) as total'))
    //         ->groupBy('purchase_method')
    //         ->pluck('total', 'purchase_method');

    //     return view('dashboard.index', compact(
    //         'totalAllocation', 'totalContracts', 'remainingAllocation', 'monthlyPayments', 'contractTypes'
    //     ));
    // }

    public function index()
    {
        $year = request('year') ?? now()->year;

        // Senarai tahun dari allocation (descending)
        $availableYears = Allocation::select('year')->distinct()->orderByDesc('year')->pluck('year');

        $allocation = Allocation::where('year', $year)->first();
        $totalAllocation = $allocation?->total_allocation ?? 0;

        $startOfYear = Carbon::createFromDate($year)->startOfYear();
        $endOfYear = Carbon::createFromDate($year)->endOfYear();
        
        $totalContracts = Contract::where(function ($query) use ($startOfYear, $endOfYear) {
            $query->whereDate('start_date', '<=', $endOfYear)
                  ->whereDate('end_date', '>=', $startOfYear);
        })->count();
        
        $totalContractsValue = Contract::where(function ($query) use ($startOfYear, $endOfYear) {
            $query->whereDate('start_date', '<=', $endOfYear)
                  ->whereDate('end_date', '>=', $startOfYear);
        })->sum('contract_value');
        

        $remainingAllocation = $totalAllocation - $totalContractsValue;

        return view('dashboard.index', compact(
            'year',
            'availableYears',
            'totalAllocation',
            'totalContracts',
            'remainingAllocation'
        ));
    }

}
