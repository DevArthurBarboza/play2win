<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GameController as AdminGame;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/user/login',[UserController::class,'viewLogin'])->name('login-user');

Route::get('/user/register',[UserController::class,'viewRegister']);

Route::post('/user/login',[UserController::class,'login']);
Route::post('/user/register',[UserController::class,'register']);


Route::middleware('auth')->group(function () {
    
    Route::get('/user/account/index',[UserController::class,'viewIndex'])->name('user.account.index');
    Route::get("/user/account/pay",[UserController::class,'viewCash']);

    Route::post("/user/account/pay",[UserController::class,'updateCash']);
    Route::post("/user/account/updatecash",[UserController::class,'updateCashInGaming']);

    Route::get("/game/{id}",[GameController::class,"index"]);

    Route::get('/home',[HomeController::class,'home'])->name('home');

    Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/triggerSeeder',[AdminController::class,'triggerSeeder']);

    Route::get('/dashboard/category/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/category/show', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/dashboard/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/dashboard/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/dashboard/category/delete', [CategoryController::class, 'delete'])->name('category.delete');


    Route::get('/dashboard/games/index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/games/show', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/dashboard/games/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/games/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/dashboard/games/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/dashboard/games/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/dashboard/games/delete', [CategoryController::class, 'delete'])->name('category.delete');

});

require __DIR__.'/auth.php';
