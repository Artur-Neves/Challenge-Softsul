<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get("/{product}", "show");
    Route::post("", "store");
    Route::put("/{product}", "update");
    Route::delete("/{product}", "destroy");
});