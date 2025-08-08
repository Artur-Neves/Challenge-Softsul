<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get("/{product}", "findById");
    Route::post("", "save");
    Route::put("/{product}", "update");
    Route::delete("/{product}", "delete");
});