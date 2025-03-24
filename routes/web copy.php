<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Web\ContractController;
use App\Http\Controllers\Web\ProjectionController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ExpenseCodeController;
use App\Http\Controllers\Web\BudgetCodeController;
use App\Http\Controllers\Web\CompanyController;
use App\Http\Controllers\Web\ContractTypeController;
use App\Http\Controllers\EntityCodeController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\AsnafController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProjectController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('contracts', ContractController::class);
    Route::get('contracts/{contract}/view', [ContractController::class, 'show'])->name('contracts.show');

    Route::resource('projections', ProjectionController::class);
    Route::resource('payments', PaymentController::class);

    // STATIC TABLES
    Route::resource('expense-codes', ExpenseCodeController::class);
    // Route::get('expense_codes/{expense_codes}/view', [ContractController::class, 'show'])->name('expense_codes.show');
    Route::resource('budget-codes', BudgetCodeController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('contract-types', ContractTypeController::class);
    Route::resource('entity-codes', EntityCodeController::class);
    Route::resource('funds', FundController::class);
    Route::resource('asnaf', AsnafController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';



