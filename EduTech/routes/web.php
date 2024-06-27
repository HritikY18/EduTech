<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Auth::user()->role;
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user
Route::prefix('user')->name('user.')->group(function () {
    // Route::resource('/',UserController::class);
    Route::get('/{user}/changePassword/',[UserController::class,'changePassword'])->name('changePassword');
    Route::patch('/{user}/changePasswordStore/',[UserController::class,'changePasswordStore'])->name('changePasswordStore');
});
Route::resource('user',UserController::class);



// teacher 
Route::prefix('teacher/')->name('teacher.')->group(function () {
    // Route::resource('/',TeacherController::class);
    Route::get('getCourses',[TeacherController::class,'getCourses'])->name('getCourses');
    Route::get('enroll/{id}',[TeacherController::class,'enroll'])->name('enroll');
    Route::get('courseStudents/{id}',[TeacherController::class,'getCourseStudents'])->name('getCourseStudents');
    Route::get('comments/{id}',[TeacherController::class,'comments'])->name('comments');
    Route::get('paymentRequests',[TeacherController::class,'paymentRequests'])->name('paymentRequests');
    Route::get('getPaymentRequests',[TeacherController::class,'getPaymentRequest'])->name('getPaymentRequests');
});
Route::resource('teacher',TeacherController::class);

// student
Route::prefix('student/')->name('student.')->group(function () {
    // Route::resource('/',StudentController::class);
    Route::get('getCourses',[StudentController::class,'getCourses'])->name('getCourses');
    Route::get('coursemates/{id}',[StudentController::class,'getCoursemates'])->name('getCoursemates');
});
Route::get('/temp',[TeacherController::class,'temp'])->name('temp');
Route::resource('student',StudentController::class);


// course
Route::resource('course',CourseController::class);

// enroll
Route::resource('enroll',EnrollController::class);

// comment
// Route::resource('comment',CommentController::class);
Route::prefix('comment')->name('comment.')->group(function(){
    Route::get('create/{id}',[CommentController::class,'create'])->name('create');
    Route::post('store/{id}',[CommentController::class,'store'])->name('store');
    Route::get('{id}',[CommentController::class,'getComments'])->name('getComments');
});

// payments
Route::prefix('payment/')->name('payment.')->group(function(){
    Route::get('create/{course}',[PaymentController::class,'create'])->name('create');
    Route::post('store/{id}',[PaymentController::class,'store'])->name('store');
    Route::get('update/{payment}',[PaymentController::class,'update'])->name('update');
});