<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\CoinsController;
use App\Http\Controllers\perfilcontroller;
use App\Http\Controllers\PruebaController;
use App\Http\Livewire\Permisoscontroller;
use App\Http\Livewire\Asignarcontroller;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\CompanyController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Artisan;
//use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Exporter;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManager;

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
    return redirect('login');
});

Route::get('imagen/', function() {
    $rectangulo = imagecreatetruecolor(55, 30);
        $blanco = imagecolorallocate($rectangulo, 255,255,255);
        imagefilledrectangle($rectangulo,4,4,50,25,$blanco);
        header('Content-Type: image/png');
        imagepng($rectangulo);
        imagedestroy($rectangulo);

});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Test visuales
Route::get('ejemplo', [PruebaController::class, 'ejemplo']);
Route::get('ActualizarWoocomerceCategories', [PruebaController::class, 'ActualizarWC'])->name('sembrarC')->middleware('auth');
Route::get('ActualizarWoocomerceProducts', [PruebaController::class, 'ActualizarWP'])->name('sembrarP')->middleware('auth');





// Route::get('ejecutarWorker', [PruebaController::class, 'WorkerRun'])->name('WR')->middleware('auth');
Route::get('imprimir', [PruebaController::class, 'Imprimir'])->name('imprimir')->middleware('auth');
Route::get('imprimirV1', [PruebaController::class, 'ImprimirV1'])->name('imprimirV1')->middleware('auth');
Route::get('imagen/{id}', [PruebaController::class, 'imagen'])->name('imagen')->middleware('auth');


Route::get('/run-queue', function () {
    Artisan::call('queue:work', ['--stop-when-empty' => true]);
    return redirect()->route('productos');
})->name('WR')->middleware('auth');

