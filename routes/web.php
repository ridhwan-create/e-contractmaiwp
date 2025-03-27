<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller
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
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

// Redirect ke login jika akses root
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard hanya boleh diakses oleh pengguna yang login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Proses logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Kawalan untuk semua pengguna yang login
Route::middleware('auth')->group(function () {
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Kawalan untuk Admin sahaja
Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::resource('contracts', ContractController::class);
    Route::resource('projections', ProjectionController::class);
    Route::resource('payments', PaymentController::class);

    // Static Tables (Admin sahaja boleh ubah)
    Route::resource('expense-codes', ExpenseCodeController::class);
    Route::resource('budget-codes', BudgetCodeController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('contract-types', ContractTypeController::class);
    Route::resource('entity-codes', EntityCodeController::class);
    Route::resource('funds', FundController::class);
    Route::resource('asnaf', AsnafController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('projects', ProjectController::class);

    // Senarai Pengguna dan Peranan
    Route::get('/users', [UserRoleController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/assign-role', [UserRoleController::class, 'edit'])->name('users.assign-role');
    Route::post('/users/{user}/assign-role', [UserRoleController::class, 'update'])->name('users.assign-role.update');

    // Tetapan Pengguna
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Tetapan Peranan (Role)
    Route::resource('roles', RoleController::class);


});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/test-admin', function () {
        return "Anda Admin!";
    });
});


// ✅ Kawalan untuk Manager sahaja
Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::get('contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('contracts', [ContractController::class, 'store'])->name('contracts.store');

    Route::get('projections', [ProjectionController::class, 'index'])->name('projections.index');
    Route::get('projections/create', [ProjectionController::class, 'create'])->name('projections.create');
    Route::post('projections', [ProjectionController::class, 'store'])->name('projections.store');
});

// ✅ Kawalan untuk semua pengguna yang login (tetapi hanya boleh melihat data)
// Route::middleware(['auth'])->group(function () {
//     Route::get('contracts/{contract}/view', [ContractController::class, 'show'])->name('contracts.show');
//     Route::get('projections/{projection}/view', [ProjectionController::class, 'show'])->name('projections.show');
//     Route::get('payments/{payment}/view', [PaymentController::class, 'show'])->name('payments.show');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index'); // ⬅️ Tambah di sini
    Route::get('contracts/{contract}/view', [ContractController::class, 'show'])->name('contracts.show');
    Route::get('projections/{projection}/view', [ProjectionController::class, 'show'])->name('projections.show');
    Route::get('payments/{payment}/view', [PaymentController::class, 'show'])->name('payments.show');
});


require __DIR__.'/auth.php';
