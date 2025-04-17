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
use App\Http\Controllers\NucleoFamiliarController;


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
    return view('welcome');
});


// API routes - Estas rutas están disponibles para AJAX dentro de la aplicación 
Route::get('/api/medicamentos/{familiarId}', [DashboardController::class, 'getMedicamentosByFamiliar']);
// Podemos agregar una nueva ruta para obtener estadísticas si se implementa esa función
Route::get('/api/dashboard/stats', [DashboardController::class, 'getStats']);

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para núcleos familiares (solo accesibles para superadmin)
    Route::resource('nucleo_familiares', NucleoFamiliarController::class);

    // Actualización de contraseña de administrador de núcleo (ruta opcional)
    Route::post('nucleo_familiares/{nucleoFamiliar}/reset-admin-password', [NucleoFamiliarController::class, 'resetAdminPassword'])->name('nucleo_familiares.reset_admin_password');


    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Familiares - Rutas personalizadas
    Route::get('familiares/{familiar}', [FamiliarController::class, 'show'])->name('familiares.show');
    Route::get('familiares/{familiar}/edit', [FamiliarController::class, 'edit'])->name('familiares.edit');
    Route::put('familiares/{familiar}', [FamiliarController::class, 'update'])->name('familiares.update');
    Route::get('familiares/{familiar}/medicamentos', [FamiliarController::class, 'medicamentos'])->name('familiares.medicamentos');

    // Relaciones de Familiares
    Route::post('/familiares/{familiar}/enfermedades', [FamiliarController::class, 'agregarEnfermedad'])->name('familiares.agregarEnfermedad');
    Route::delete('/familiares/{familiar}/enfermedades/{enfermedad}', [FamiliarController::class, 'eliminarEnfermedad'])->name('familiares.eliminarEnfermedad');
    Route::post('/familiares/{familiar}/alergias', [FamiliarController::class, 'agregarAlergia'])->name('familiares.agregarAlergia');
    Route::delete('/familiares/{familiar}/alergias/{alergia}', [FamiliarController::class, 'eliminarAlergia'])->name('familiares.eliminarAlergia');

    // Rutas de Historial Medicamentos
    Route::get('historial_medicamentos/{historialMedicamento}', [HistorialMedicamentoController::class, 'show'])->name('historial_medicamentos.show');

    // Rutas para órdenes médicas por familiar
    Route::get('/familiares/{familiar}/ordenes-medicas', [OrdenMedicaController::class, 'indexByFamiliar'])->name('ordenes_medicas.indexByFamiliar');

    // Rutas de historial
    Route::get('/familiares/{familiar}/historial-medicamentos', [FamiliarController::class, 'historialMedicamentos'])->name('familiares.historialMedicamentos');
    Route::get('/familiares/{familiar}/historial-ordenes', [FamiliarController::class, 'historialOrdenes'])->name('familiares.historialOrdenes');

    // Resources routes - deben estar después de las rutas personalizadas
    Route::resource('familiares', FamiliarController::class)->except(['show', 'edit', 'update']);
    Route::resource('medicamentos', MedicamentoController::class);
    Route::resource('catalogos', CatalogoController::class);
    Route::resource('valor_catalogos', ValorCatalogoController::class);
    Route::resource('historial_medicamentos', HistorialMedicamentoController::class)->except(['show']);
    Route::resource('ordenes_medicas', OrdenMedicaController::class);
    Route::resource('citas_medicas', CitaMedicaController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('enfermedades', EnfermedadController::class);
    Route::resource('alergias', AlergiaController::class);
});

// Rutas de autenticación
require __DIR__ . '/auth.php';
