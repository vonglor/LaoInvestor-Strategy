<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SymbolController;
use App\Http\Controllers\StrategiesController;
use App\Http\Controllers\CapitalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('strategies.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route ສຳລັບປ່ຽນພາສາ
Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'lo'])) {
        session()->put('locale', $lang);
    }
    return redirect()->back(); // ກັບຄືນໄປໜ້າທີ່ຜ່ານມາ
})->name('lang.switch');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('symbol', SymbolController::class);

    //strategies route
    Route::resource('strategies', StrategiesController::class);
    Route::post('strategies/{strategies}/status', [StrategiesController::class, 'changeStatus'])
    ->name('strategies.changeStatus');
    Route::get('strategies/backtest/{strategies}', [StrategiesController::class, 'backtest'])
    ->name('strategies.backtest');
    Route::post('strategies/{strategies}/timespan', [StrategiesController::class, 'timespan'])
    ->name('strategies.timespan');
    Route::get('strategies/win/{strategies}', [StrategiesController::class, 'win'])->name('strategies.win');
    Route::get('strategies/loss/{strategies}', [StrategiesController::class, 'loss'])->name('strategies.loss');

    // capital route
    Route::post('capital/save', [CapitalController::class, 'store'])->name('capital.store');
    Route::get('capital/', [CapitalController::class, 'index'])->name('capital.index');
    Route::get('capital/edit/{capital}', [CapitalController::class, 'edit'])->name('capital.edit');
    Route::delete('capital/delete/{capital}', [CapitalController::class, 'destroy'])->name('capital.destroy');
    Route::put('capital/{capital}/update', [CapitalController::class, 'update'])->name('capital.update');

    // user route
    Route::resource('users', UserController::class);

});
require __DIR__.'/auth.php';
