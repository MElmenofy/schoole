<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
require __DIR__.'/auth.php';

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function(){
        Route::get('/dashboard', [Controllers\Controller::class, 'index'])->name('dashboard');

    // GRADES
//    Route::domain('{alias}.' .config('app.short_url'))->group(function () {
//        Route::resource('grades', Controllers\Grades\GradeController::class);
//    });

    Route::resource('grades', Controllers\Grades\GradeController::class);
    // Classrooms
    Route::resource('classrooms', Controllers\Classrooms\ClassroomController::class);
    Route::post('c_delete_all', [Controllers\Classrooms\ClassroomController::class, 'c_delete_all'])->name('c_delete_all');
    Route::post('filter_classes', [Controllers\Classrooms\ClassroomController::class, 'filter_classes'])->name('filter_classes');

//    sections
    Route::resource('sections', Controllers\Sections\SectionController::class);
    Route::get('/classes/{id}', [Controllers\Sections\SectionController::class, 'get_classes']);
});
