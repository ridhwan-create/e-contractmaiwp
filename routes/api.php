<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ContractController;
use App\Http\Controllers\Api\ProjectionController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ExpenseCodeController;
use App\Http\Controllers\Api\BudgetCodeController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ContractTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('contracts', ContractController::class);
Route::apiResource('projections', ProjectionController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('expense-codes', ExpenseCodeController::class);
Route::apiResource('budget-codes', BudgetCodeController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('contract-types', ContractTypeController::class);
