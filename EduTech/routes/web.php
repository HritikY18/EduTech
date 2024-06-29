<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CertificateController;

Route::get('/', function () {
    // return Auth::user()->role;
    return redirect()->route('home');
});

Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// user
Route::prefix('user/')->name('user.')->group(function () {
    Route::get('change-password',[UserController::class,'changePassword'])->name('changePassword');
    Route::patch('change-password',[UserController::class,'changePasswordStore'])->name('changePasswordStore');
});
Route::resource('user',UserController::class);



// teacher
Route::prefix('teacher/')->name('teacher.')->group(function () {
    // Route::resource('/',TeacherController::class);
    Route::get('get-courses',[TeacherController::class,'getCourses'])->name('getCourses');
    Route::get('enroll/{id}',[TeacherController::class,'enroll'])->name('enroll');
    Route::get('course-students/{id}',[TeacherController::class,'getCourseStudents'])->name('getCourseStudents');
    Route::get('comments/{id}',[TeacherController::class,'comments'])->name('comments');
    Route::get('payment-requests',[TeacherController::class,'paymentRequests'])->name('paymentRequests');
    Route::get('get-payment-requests',[TeacherController::class,'getPaymentRequests'])->name('getPaymentRequests');
    Route::get('certificate-requests',[CertificateController::class,'certificateRequests'])->name('certificateRequests');
    Route::get('get-certificate-requests',[CertificateController::class,'getCertificateRequests'])->name('getCertificateRequests');
    Route::patch('certificate-store',[CertificateController::class,'store'])->name('certificateStore');
});
Route::resource('teacher',TeacherController::class);

// student
Route::prefix('student/')->name('student.')->group(function () {
    // Route::resource('/',StudentController::class);
    Route::get('get-courses',[StudentController::class,'getCourses'])->name('getCourses');
    Route::get('coursemates/{id}',[StudentController::class,'getCoursemates'])->name('getCoursemates');
    Route::get('apply-for-certificate/{enroll}',[CertificateController::class,'applyForCertificate'])->name('applyForCertificate');
    Route::patch('rating',[EnrollController::class,'rating'])->name('rating');
});
Route::get('/temp',[StudentController::class,'temp'])->name('temp');
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
