<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FamiliarController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\ValorCatalogoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\HistorialMedicamentoController;
use App\Http\Controllers\OrdenMedicaController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlergiaController;
use App\Http\Controllers\EnfermedadController;

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
Route::resource('ordenes_medicas', OrdenMedicaController::class);
Route::resource('citas_medicas', CitaMedicaController::class);
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
Route::get('familiares/{familiar}', [FamiliarController::class, 'show'])->name('familiares.show');
Route::get('familiares/{familiar}/edit', [FamiliarController::class, 'edit'])->name('familiares.edit');

Route::get('historial_medicamentos/{historialMedicamento}', [HistorialMedicamentoController::class, 'show'])->name('historial_medicamentos.show');

// Añadir estas líneas junto a las demás rutas resource
Route::resource('enfermedades', EnfermedadController::class);
Route::resource('alergias', AlergiaController::class);

// Rutas para gestionar las relaciones
Route::post('/familiares/{familiar}/enfermedades', [FamiliarController::class, 'agregarEnfermedad'])->name('familiares.agregarEnfermedad');
Route::delete('/familiares/{familiar}/enfermedades/{enfermedad}', [FamiliarController::class, 'eliminarEnfermedad'])->name('familiares.eliminarEnfermedad');

Route::post('/familiares/{familiar}/alergias', [FamiliarController::class, 'agregarAlergia'])->name('familiares.agregarAlergia');
Route::delete('/familiares/{familiar}/alergias/{alergia}', [FamiliarController::class, 'eliminarAlergia'])->name('familiares.eliminarAlergia');
