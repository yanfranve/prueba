<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DatosController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VerificationController;


// Resto del código

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/generate-pdf/{employeeId}', [DocumentController::class, 'generatePDF']);

Route::get('/verify-pdf/{code}', [DocumentController::class, 'verifyPDF']);

Route::get('/formulario', [DatosController::class, 'mostrarFormulario'])->name('mostrarFormulario');

Route::post('/guardar-datos', [DatosController::class, 'guardarDatos'])->name('guardarDatos');

// routes/web.php



Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


