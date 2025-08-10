<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->group(function () {
    Route::get("/datatable", "getOrdersData");
    Route::get("/{order}", "show");
    Route::post("", "store");
    Route::put("/{order}", "update");
    Route::delete("/{order}", "destroy");
});
