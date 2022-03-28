<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function() {
    Route::get("/user", function (Request $request) {
        return $request->user();
    });
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::resource('toDo', ToDoController::class);
});

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
