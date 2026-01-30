<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('acta-calificacion/{id}',[\App\Http\Controllers\Reports\ReportGradeController::class,'generate'])->name('report.grade.print');
