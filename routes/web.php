<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\IncomingController;

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
    return view('auth.login');
});
Route::middleware('auth')->group(function(){
    Route::controller(StudentController::class)->group(function(){
        Route::get('student/create/{student?}', 'addEdit')->name('students.addEdit');
        Route::get('student/index', 'index')->name('students.index');
        Route::post('student/updateStore/{student?}', 'storeUpdate')->name('students.storeUpdate');
        Route::get('student/delete/{student}', 'delete')->name('students.delete');
        Route::get('student/importForm', 'formImport')->name('students.formImport');
        Route::post('student/import', 'import')->name('students.import');
        Route::get('search', 'search')->name('students.search');
    });
});
Route::middleware('auth', 'is_admin')->group(function () {
    Route::prefix('users')->controller(UserController::class)->group(function(){
        Route::get('create', 'create')->name('users.create');
        Route::post('store/{user?}', 'store')->name('users.store');
        Route::get('index', 'index')->name('users.index');
        Route::get('edit/{user}', 'edit')->name('users.edit');
        Route::post('delete/{user}', 'delete')->name('users.delete');
        Route::get('search', 'search')->name('users.search');
    });

    Route::prefix('teacher')->controller(TeacherController::class)->group(function(){
        Route::get('index', 'index')->name('teacher.index');
        Route::get('addEdit/{teacher?}', 'addEdit')->name('teacher.addedit');
        Route::post('storeUpdate/{teacher?}', 'storeUpdate')->name('teacher.storeUpdate');
        Route::get('delete/{teacher}', 'delete')->name('teacher.delete');
        Route::get('search', 'search')->name('teacher.search');
    });

    Route::prefix('group')->controller(GroupController::class)->group(function(){
        Route::get('index', 'index')->name('group.index');
        Route::get('addEdit/{group?}', 'addEdit')->name('group.addEdit');
        Route::post('storeUpdate/{group?}', 'storeUpdate')->name('group.storeUpdate');
        Route::get('delete/{group}', 'delete')->name('group.delete');
        Route::get('search', 'search')->name('group.search');
    });

    Route::prefix('tutor')->controller(TutorController::class)->group(function(){
        Route::get('index', 'index')->name('tutors.index');
        Route::get('addedit/{tutor?}', 'addEdit')->name('tutors.addEdit');
        Route::post('storeUpdate/{tutor?}', 'storeUpdate')->name('tutors.storeUpdate');
        Route::get('delete/{tutor}', 'delete')->name('tutors.delete');
        Route::get('search', 'search')->name('tutors.search');
    });

    Route::prefix('invoice')->controller(InvoiceController::class)->group(function(){
        Route::get('index', 'index')->name('invoice.index');
        Route::get('index-closed', 'indexClosed')->name('invoice.indexClosed');
        Route::get('addEdit/{invoice?}', 'addEdit')->name('invoice.addEdit');
        Route::post('storeUpdate/{invoice?}', 'storeUpdate')->name('invoice.storeUpdate');
        Route::get('delete/{invoice}', 'delete')->name('invoice.delete');
        Route::get('importForm', 'formImport')->name('invoice.formImport');
        Route::post('import', 'import')->name('invoice.import');
        Route::get('search', 'search')->name('invoice.search');
    });

    Route::prefix('incoming')->controller(IncomingController::class)->group(function(){
        Route::get('index', 'index')->name('incoming.index');
        Route::get('index-closed', 'indexClosed')->name('incoming.indexClosed');
        Route::get('addEdit/{incoming?}', 'addEdit')->name('incoming.addEdit');
        Route::post('storeUpdate/{incoming?}', 'storeUpdate')->name('incoming.storeUpdate');
        Route::get('delete/{incoming}', 'delete')->name('incoming.delete');
        Route::get('importForm', 'formImport')->name('incoming.formImport');
        Route::post('import', 'import')->name('incoming.import');
        Route::get('match', 'match')->name('incoming.match');
        Route::get('search', 'search')->name('incoming.search');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
