<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
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


Route::get('/debug/category',[DebugController::class,'dumpCategory']);
Route::get('/debug/game',[DebugController::class,'dumpGame']);
Route::get('/debug/type',[DebugController::class,'dumpType']);

Route::get('/user/login',[UserController::class,'viewLogin'])->name('login-user');

Route::get('/user/register',[UserController::class,'viewRegister']);

Route::post('/user/login',[UserController::class,'login']);
Route::post('/user/register',[UserController::class,'register']);


Route::get('/triggerSeeder',[AdminController::class,'triggerSeeder']);


Route::middleware('auth')->group(function () {
    
    Route::get('/user/account/index',[UserController::class,'viewIndex'])->name('user.account.index');
    Route::get("/user/account/pay",[UserController::class,'viewCash']);

    Route::get('/user/history', [HistoryController::class, 'show'])->name('user.show.history');

    Route::post("/user/account/pay",[UserController::class,'updateCash']);
    Route::post("/user/account/updatecash",[UserController::class,'updateCashInGaming']);

    Route::get("/game/{id}",[GameController::class,"index"]);

    Route::get('/home',[HomeController::class,'home'])->name('home');

    Route::get('/user/category/game/{id}',[CategoryController::class,'show'])->name('show.category');

    Route::get('/user/logout', [UserController::class, 'logout'])->name('logout');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard/category/index', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/category/show', [AdminCategoryController::class, 'show'])->name('category.show');
    Route::get('/dashboard/category/create', [AdminCategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/category/store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::get('/dashboard/category/edit/{category}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::put('/dashboard/category/update/{category}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::get('/dashboard/category/delete{id}', [AdminCategoryController::class, 'delete'])->name('category.delete');


    Route::get('/dashboard/games/index', [AdminGameController::class, 'index'])->name('games.index');
    Route::get('/dashboard/games/show', [AdminGameController::class, 'show'])->name('games.show');
    Route::get('/dashboard/games/create', [AdminGameController::class, 'create'])->name('games.create');
    Route::post('/dashboard/games/store', [AdminGameController::class, 'store'])->name('games.store');
    Route::get('/dashboard/games/edit/{game}', [AdminGameController::class, 'edit'])->name('games.edit');
    Route::put('/dashboard/games/update/{id}', [AdminGameController::class, 'update'])->name('games.update');
    Route::get('/dashboard/games/delete/{id}', [AdminGameController::class, 'delete'])->name('games.delete');

});

require __DIR__.'/auth.php';
