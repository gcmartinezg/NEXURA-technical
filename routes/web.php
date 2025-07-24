<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/employee', function () {
    return view('listar-empleados');
});

Route::get('/employee/create', function () {
    return view('crear-modificar-empleado', ['id' => null]);
});

Route::get('/employee/{id}', function (int $id) {
    return view('crear-modificar-empleado', ['id' => $id]);
})->whereNumber('id');
*/
Route::resource('employees', EmpleadoController::class)
    ->except(['show']);