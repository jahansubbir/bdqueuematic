<?php

use App\Http\Controllers\BoothController;
use App\Http\Controllers\BoothTypeController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TokenTypeController;
use App\Http\Controllers\UserRoleController;
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

// Route::get('/dashboard', function () {
//     return Route::get('/',[TokenTypeController::class,'create'])->name('token.create')->middleware('auth');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::controller(TokenController::class)->group(function(){
    Route::get('/dashboard',[TokenController::class,'create'])->name('dashboard')->middleware('auth');
    Route::get('/tokens',[TokenController::class,'index'])->name('tokens.index')->middleware('auth');
    Route::get('/tokens/create',[TokenController::class,'create'])->name('tokens.create')->middleware('auth');
    Route::get('/tokens/{id}/details',[TokenController::class, 'details'])->name('tokens.details')->middleware('auth');
    Route::post('/tokens/create',[TokenController::class,'store'])->name('tokens.store')->middleware('auth');
    Route::view('/tokens/error','tokens.error')->name('tokens.error');
    
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// web.php or routes/web.php

Route::middleware(['checkRole:admin'])->group(function () {
    // Your routes that require the 'user' role
    Route::get('/counters', [CounterController::class,'index'])->name('counters');
});


Route::controller(CounterController::class)->group(function(){
    Route::get('/counters',[CounterController::class,'index'])->middleware('auth')->middleware('checkRole:operator,admin')->name('counters.index');
    Route::get('/counters/create',[CounterController::class,'create'])->name('counters.create')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/counters/create',[CounterController::class,'store'])->name('counters.store')->middleware('auth')->middleware('checkRole:admin');
    //Route::get('/counters/edit{id}',[CounterController::class,'edit'])->middleware('auth');
    Route::get('/counters/{id}/edit', [CounterController::class,'edit'])->name('counters.edit')->middleware('auth')->middleware('checkRole:admin');
    Route::put('/counters/{id}', [CounterController::class,'update'])->name('counters.update')->middleware('auth')->middleware('checkRole:admin');

});


Route::controller(BoothTypeController::class)->group(function(){
    Route::get('/boothTypes',[BoothTypeController::class,'index'])->middleware('auth')->middleware('checkRole:admin');
    Route::get('/boothTypes/create',[BoothTypeController::class,'create'])->name('boothTypes.create')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/boothTypes/create',[BoothTypeController::class,'store'])->name('boothTypes.store')->middleware('auth')->middleware('checkRole:admin');
    //Route::get('/counters/edit{id}',[CounterController::class,'edit'])->middleware('auth');
    Route::get('/boothTypes/{id}/edit', [BoothTypeController::class,'edit'])->name('boothTypes.edit')->middleware('auth')->middleware('checkRole:admin');
    Route::put('/boothTypes/{id}', [BoothTypeController::class,'update'])->name('boothTypes.update')->middleware('auth')->middleware('checkRole:admin');

});

Route::controller(BoothController::class)->group(function(){
    Route::get('/booths',[BoothController::class,'index'])->middleware('auth')->middleware('checkRole:admin')->name('booths.index');
    Route::get('/booths/create',[BoothController::class,'create'])->name('booths.create')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/booths/create',[BoothController::class,'store'])->name('booths.store')->middleware('auth')->middleware('checkRole:admin');
    //Route::get('/counters/edit{id}',[CounterController::class,'edit'])->middleware('auth');
    Route::get('/booths/{id}/edit', [BoothController::class,'edit'])->name('booths.edit')->middleware('auth')->middleware('checkRole:admin');
    Route::put('/booths/{id}', [BoothController::class,'update'])->name('booths.update')->middleware('auth')->middleware('checkRole:admin');

});

Route::controller(TokenTypeController::class)->group(function(){
    Route::get('/tokenTypes',[TokenTypeController::class,'index'])->middleware('auth')->middleware('checkRole:admin')->name('tokenTypes.index');
    Route::get('/tokenTypes/create',[TokenTypeController::class,'create'])->name('tokenTypes.create')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/tokenTypes/create',[TokenTypeController::class,'store'])->name('tokenTypes.store')->middleware('auth')->middleware('checkRole:admin');
    //Route::get('/counters/edit{id}',[CounterController::class,'edit'])->middleware('auth');
    Route::get('/tokenTypes/{id}/edit', [TokenTypeController::class,'edit'])->name('tokenTypes.edit')->middleware('auth')->middleware('checkRole:admin');;
    Route::put('/tokenTypes/{id}', [TokenTypeController::class,'update'])->name('tokenTypes.update')->middleware('auth')->middleware('checkRole:admin');;

});

Route::controller(UserRoleController::class)->group(function(){
    Route::get('/searchable-user-roles', [UserRoleController::class, 'searchableIndex'])->name('user-roles.searchableIndex')->middleware('auth')->middleware('checkRole:admin');
    Route::get('/user-roles', [UserRoleController::class, 'index'])->name('user-roles.index')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/user-roles/assign/{userId}', [UserRoleController::class, 'assignRole'])->name('user-roles.assign')->middleware('auth')->middleware('checkRole:admin');
    Route::post('/user-roles/remove/{userId}/{roleName}', [UserRoleController::class, 'removeRole'])->name('user-roles.remove')->middleware('auth')->middleware('checkRole:admin');
    Route::get('/roles',[UserRoleController::class,'get_roles'])->name('user-roles.roles')->middleware('auth')->middleware('checkRole:admin');


});


require __DIR__.'/auth.php';
