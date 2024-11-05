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
use App\Http\Controllers\OrdenMedicaController;

use App\Models\OrdenMedica;

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

Route::get('ordenes', [OrdenMedicaController::class, 'index'])->name('ordenes.index');
Route::get('ordenes/create', [OrdenMedicaController::class, 'create'])->name('ordenes.create');
Route::post('ordenes', [OrdenMedicaController::class, 'store'])->name('ordenes.store');
Route::get('ordenes/{orden}', [OrdenMedicaController::class, 'show'])->name('ordenes.show');
Route::get('ordenes/{orden}/edit', [OrdenMedicaController::class, 'edit'])->name('ordenes.edit');
Route::put('ordenes/{orden}', [OrdenMedicaController::class, 'update'])->name('ordenes.update');
Route::delete('ordenes/{orden}', [OrdenMedicaController::class, 'destroy'])->name('ordenes.destroy');

Route::resource('ordenes.citas', CitasMedicasController::class);
// Rutas para citas médicas
Route::get('familiares/{familiar}/citas', [CitasMedicasController::class, 'index'])->name('familiares.citas');
Route::get('ordenes/{orden}/citas/create', [CitasMedicasController::class, 'create'])->name('ordenes.citas.create');
Route::post('citas', [CitasMedicasController::class, 'store'])->name('citas.store');

// Añadir más rutas según sea necesario para editar, mostrar o eliminar citas



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
Route::get('/familiares/{familiar}/medicamentos', [FamiliarController::class, 'medicamentos'])->name('familiares.medicamentos');

// Route::get('/familiares/{familiar}/medicamentos', [HistorialMedicamentoController::class, 'index'])->name('familiares.medicamentos');

// Ruta para acceder a las citas de un familiar
Route::get('familiares/{familiar}/citas', [CitasMedicasController::class, 'index'])->name('familiares.citas');

// Ruta para gestionar las órdenes
Route::get('familiares/{familiar}/ordenesMedicas', [FamiliarController::class, 'ordenesMedicas'])->name('familiares.ordenesMedicas');

// Route::get('historial_medicamentos/{historialMedicamento}', [HistorialMedicamentoController::class, 'show'])->name('historial_medicamentos.show');
