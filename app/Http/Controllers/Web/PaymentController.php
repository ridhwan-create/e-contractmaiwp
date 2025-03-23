<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\Projection;
use App\Models\ExpenseCode;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index', ['payments' => Payment::all()]);
    }

    public function create()
    {
        $contracts = Contract::all(); // Ambil semua kontrak
        $expense_codes = ExpenseCode::all(); // Ambil semua kod perbelanjaan
    
        return view('payments.create', compact('contracts', 'expense_codes'));
    }    

    // public function store(Request $request)
    // {
    //     Payment::create($request->all() + ['created_by' => auth()->id()]);
    //     return redirect()->route('payments.index')->with('success', 'Bayaran berjaya ditambah!');
    // }

    public function store(Request $request)
    {
        Payment::create($request->all() + ['created_by' => auth()->id()]);
        // Validasi Data
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'projection_id' => 'required|exists:projections,id',
            'expense_code_id' => 'required|exists:expense_codes,id',
            'amount' => 'required|numeric|min:0.01',
        ]);
            // dd($request->projection_id);
        // Dapatkan Unjuran Berkaitan
        $projection = Projection::findOrFail($request->projection_id);

        // Kira Baki Unjuran: baki lama - amaun bayaran
        if ($projection->remaining_projection == 0.00) {
            // Jika baki unjuran adalah 0.00, gunakan jumlah penuh unjuran
            $remaining = $projection->amount - $request->amount;
        } else {
            // Jika baki unjuran bukan 0.00, gunakan baki unjuran yang sedia ada
            $remaining = $projection->remaining_projection - $request->amount;
        }
    
        // Pastikan baki tidak negatif
        if ($remaining < 0) {
            return back()->withErrors(['amount' => 'Amaun bayaran melebihi baki unjuran!'])->withInput();
        }
    
        // Simpan Pembayaran
        // Payment::create([
        //     'contract_id' => $request->contract_id,
        //     'projection_id' => $request->projection_id,
        //     'expense_code_id' => $request->expense_code_id,
        //     'payment_date' => now(),
        //     'amount' => $request->amount,
        //     'remaining_projection' => $remaining,
        //     'created_by' => auth()->id(),
        // ]);
    
        // Kemas kini baki unjuran dalam Projection
        $projection->update(['remaining_projection' => $remaining]);
    
        return redirect()->route('contracts.show', $request->contract_id)->with('success_payments', 'Bayaran berjaya direkodkan!');
    }
    

    public function edit(Payment $payment)
    {
        $contracts = Contract::all(); // Ambil semua kontrak
        return view('payments.edit', compact('payment', 'contracts'));
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all() + ['edited_by' => auth()->id()]);
        return redirect()->route('payments.index')->with('success', 'Bayaran berjaya dikemas kini!');
    }

    // public function destroy(Payment $payment)
    // {
    //     $payment->delete();
    //     return redirect()->route('payments.index')->with('success', 'Bayaran berjaya dihapuskan!');
    // }

    public function destroy(Payment $payment)
    {
        // Ambil maklumat unjuran yang berkaitan
        $projection = $payment->projection;

        // Ambil nilai contract_id sebelum payment dihapuskan
        $contract_id = $payment->contract_id;

        // Tambahkan semula amaun bayaran ke remaining_projection
        if ($projection) {
            $projection->remaining_projection += $payment->amount;
            $projection->save();
        }

        // Hapus bayaran
        $payment->delete();

        // Redirect ke halaman maklumat kontrak
        return redirect()->route('contracts.show', ['contract' => $contract_id])->with('success', 'Bayaran berjaya dihapuskan!');
    }
}
