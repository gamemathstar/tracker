<?php

use App\Http\Controllers\AuthLoginController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\SectorController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/',[AuthLoginController::class, 'showLoginForm']);

Route::get('/', [AuthLoginController::class, 'showLoginForm']);
Route::post('login', [AuthLoginController::class, 'login'])->name('login');
Route::get('logout', [AuthLoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Resource
Route::resource('users', UserController::class);

// Sector Resource
Route::get('sectors', [SectorController::class,'index'])->name('sectors.index');
Route::post('sectors/update', [SectorController::class,'update'])->name('sectors.update');
Route::post('sectors/save', [SectorController::class,'store'])->name('sectors.save');
Route::get('sectors/{id}/{id2?}', [SectorController::class,'show'])->name('sectors.view');

// Sector Resource
Route::get('commitment', [CommitmentController::class,'index'])->name('commitments.index');
Route::post('commitment/update', [CommitmentController::class,'update'])->name('commitments.update');
Route::post('commitment/save', [CommitmentController::class,'store'])->name('commitments.save');
Route::any('commitment/deliverables/{id}', [CommitmentController::class,'deliverables'])->name('commitments.deliverables');
//Route::get('commitment/{id}/{year?}', [CommitmentController::class,'show'])->name('commitments.view');


Route::post('deliverable/save', [DeliverableController::class,'store'])->name('deliverable.save');
Route::get('deliverable/view', [DeliverableController::class,'view'])->name('deliverable.view');
Route::get('deliverable/add/kpi', [DeliverableController::class,'addKPI'])->name('deliverable.add.kpi');
