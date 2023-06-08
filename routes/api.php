<?php

use App\Http\Controllers\General\CodeLanguageController;
use App\Http\Controllers\General\CodeStyleController;
use App\Http\Controllers\User\CodeController;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::bind('code', function($id) {
    return Cache::rememberForever("Code-{$id}", function() use ($id) {
        return Code::where('id', $id)->firstOrFail();
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('General')->group(function() {
    Route::get('code-style', [CodeStyleController::class, 'index'])->name('code-style.index');
    Route::get('code-language', [CodeLanguageController::class, 'index'])->name('code-language.index');
});

Route::namespace('User')->group(function() {
    Route::get('code', [CodeController::class, 'index'])->name('code.index')->middleware('can:viewAny,App\Models\Code');
    Route::post('code', [CodeController::class, 'store'])->name('code.store');
    Route::get('code/{code}', [CodeController::class, 'view'])->name('code.view')->middleware('can:view,code');
    Route::put('code/{code}', [CodeController::class, 'update'])->name('code.update');
    Route::delete('code/{code}', [CodeController::class, 'destroy'])->name('code.destroy');
});
 