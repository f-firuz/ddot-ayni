<?php

use App\Http\Controllers\Admin\AllFacultetsController;
use App\Http\Controllers\admin\AtteNB;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\admin\DostupController;
use App\Http\Controllers\admin\FacultetController;
use App\Http\Controllers\Admin\LessonsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\TypeGradesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\TableCellController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    $routeName = auth()->user() && (auth()->user()->is_student || auth()->user()->is_teacher) ? 'admin.calendar.index' : 'admin.home';
    if (session('status')) {
        return redirect()->route($routeName)->with('status', session('status'));
    }

    return redirect()->route($routeName);
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::get('/teachers', [UsersController::class, 'getAllTeachrs'])->name('user.getAllTeachrs');
    Route::get('/students', [UsersController::class, 'getAllStudents'])->name('user.getAllStudents');
    
    Route::put('users/student/{id}', [FacultetController::class, 'updateStudents'])->name('user.students.update');
    Route::get('users/student/{id}/edit', [UsersController::class, 'editStudents'])->name('user.students.edite');
    



    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::resource('lessons', 'LessonsController');


    Route::post('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');

    // School Classes
    Route::delete('school-classes/destroy', 'SchoolClassesController@massDestroy')->name('school-classes.massDestroy');
    Route::resource('school-classes', 'SchoolClassesController');


    // Calendar
    Route::get('calendar', 'CalendarController@index')->name('calendar.index');
    //    Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    //    Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/items/update', [AttendanceController::class, 'update']);
    Route::post('/items/create', [AttendanceController::class, 'create']);
    Route::match(['get', 'post'], '/allGrates', [AttendanceController::class, 'allGrates'])->name('allgrates.index');
    Route::match(['get', 'post'], '/addgrades', [AttendanceController::class, 'store'])->name('grades.data');
    // Route::post('/addgrades', [AttendanceController::class, 'store'])->name('admin.addgrades');
    
    // AttNB
    
    Route::get('/attnb', [AtteNB::class, 'index'])->name('attnb-index');

    Route::post('/items/update', [AttendanceController::class, 'update']);
    Route::post('/items/store', [AttendanceController::class, 'store']);


    // Allfacultets
   // Allfacultets
    Route::match(['get', 'post'], 'indexallfacultets', [AllFacultetsController::class, 'index'])->name('indexAllfacultets.index');
    Route::match(['get', 'post'], 'allfacultets', [AllFacultetsController::class, 'store'])->name('getAllfacultets.index');

    

    Route::post('/update-position', 'AllFacultetsController@updatePosition');
    Route::post('/update-order', [AllFacultetsController::class, 'updateOrder']);

    // Type-Grades
    Route::get('typegrades', [TypeGradesController::class, 'index'])->name('type-grades.index');
    Route::get('type-grades/create', [TypeGradesController::class, 'create'])->name('type-grades.creates');
    Route::post('type-grades/creates', [TypeGradesController::class, 'store'])->name('type-grades.store');
    Route::delete('delete/{id}', [TypeGradesController::class, 'destroy'])->name('destroy-typegrades.destroy');
    // Facultets
    Route::get('facultets', [FacultetController::class, 'index'])->name('facultets.index');
    Route::get('create/facultets', [FacultetController::class, 'create'])->name('create-facultets.index');
    Route::post('creates/facultets', [FacultetController::class, 'store'])->name('create-facultets.store');
    Route::put('facultets/{id}', [FacultetController::class, 'update'])->name('facultets.update');
    Route::get('facultets/{id}/edit', [FacultetController::class, 'edite'])->name('facultets.edite');
    Route::delete('delete/{id}', [FacultetController::class, 'destroy'])->name('destroy-facultets.destroy');

    // Close Lesson
    Route::match(['get', 'post'],'closeLesson', [AttendanceController::class, 'stopLesson'])->name('perform-action');
    // Close LessonAll
    Route::match(['get', 'post'],'closeLessonAll', [AttendanceController::class, 'stopLessonAll'])->name('perform-action');
    // Dostup-Lesson
    Route::get('/dostuplesson', [DostupController::class, 'index'])->name('dostup-lesson-index');


    
});




Route::get('/table', [TableCellController::class, 'index']);
Route::post('/table/update/{id}', [TableCellController::class, 'update']);

Route::post('/create/les', [LessonsController::class, 'index'])->name('les.store');



Route::post('/update-cell', 'AllFacultetsController@updateCell');
// Route::match(['get', 'post'],'/events', [TableCellController::class, 'store'])->name('events.store');
// Route::match(['get', 'post'],'/event', [TableCellController::class, 'index'])->name('events.store');

// Define the store route with POST method
Route::post('/events', [TableCellController::class, 'store'])->name('events.store');

// Define the index route with GET method
Route::get('/event', [TableCellController::class, 'index'])->name('events.index');