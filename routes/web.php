<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FamiliarController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ValorCatalogoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\HistorialMedicamentoController;
use App\Http\Controllers\CitasMedicasController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;

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

Route::resource('familiares', FamiliarController::class);
Route::resource('catalogos', CatalogoController::class);
Route::resource('valor_catalogos', ValorCatalogoController::class);
Route::resource('medicamentos', MedicamentoController::class);
Route::resource('historial_medicamentos', HistorialMedicamentoController::class);
Route::resource('ordenes.citas', CitasMedicasController::class);

Route::resource('documentos', DocumentoController::class);

Route::get('/', function () {
    return view('welcome');
});




// Ruta al dashboard usando el DashboardController

Route::get('/api/medicamentos/{familiarId}', [DashboardController::class, 'getMedicamentosByFamiliar']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// familiares

Route::put('/familiares/{familiar}', [FamiliarController::class, 'update'])->name('familiares.update');
Route::get('familiares/{familiar}/medicamentos', [FamiliarController::class, 'medicamentos'])->name('familiares.medicamentos');
// Ruta para acceder a las citas de un familiar
Route::get('familiares/{familiar}/citas', [CitasMedicasController::class, 'index'])->name('familiares.citas');

// Ruta para gestionar las órdenes
Route::get('familiares/{familiar}/ordenes', [CitasMedicasController::class, 'index'])->name('familiares.ordenes');



Route::get('historial_medicamentos/{historialMedicamento}', [HistorialMedicamentoController::class, 'show'])->name('historial_medicamentos.show');

// Redirigir la ruta de medicamentos para un familiar específico al controlador correcto
Route::get('familiares/{familiar}/medicamentos', [HistorialMedicamentoController::class, 'index'])->name('familiares.medicamentos');

