<?php

use App\Http\Controllers\AddActivity\AddActivityController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Dashbaord\DashboardController;
use App\Http\Controllers\Admin\Question\QuestionController;
use App\Http\Controllers\Admin\Shops\ShopsController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Cv\CvController;
use App\Http\Controllers\DoctorCounseling\DoctorCounselingController;
use App\Http\Controllers\Ebooks\EbooksController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Exam\UserExamController;
use App\Http\Controllers\FamilyCounseling\FamilyCounselingController;
use App\Http\Controllers\Gender\GenderController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\LegalCounseling\LegalCounselingController;
use App\Http\Controllers\LegitimateCounseling\LegitimateCounselingController;
use App\Http\Controllers\PrintedBook\PrintedBookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PsychicCounseling\PsychicCounselingController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get( '/cv', [CvController::class, 'index'])->name('cv');
Route::get( '/printed-books', [PrintedBookController::class, 'index'])->name('printed-books');
Route::get( '/e-books', [EbooksController::class, 'index'])->name('e-books');
Route::get( '/add-activity', [AddActivityController::class, 'index'])->name('add-activity');
Route::get('/family-counseling', [FamilyCounselingController::class, 'index'])->name('family-counseling');
Route::get('/doctor-counseling', [DoctorCounselingController::class, 'index'])->name('doctor-counseling');
Route::get('/legal-counseling', [LegalCounselingController::class, 'index'])->name('legal-counseling');
Route::get('/psychic-counseling', [PsychicCounselingController::class, 'index'])->name('psychic-counseling');
Route::get('/legitimate-counseling', [LegitimateCounselingController::class, 'index'])->name('legitimate-counseling');
Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::middleware(AuthUser::class)->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::post('update-gender', [GenderController::class, 'update'])->name('gender.update');

        Route::get('exam', [ExamController::class, 'index'])->name('exam.index');
        Route::post('exam/save-answer', [ExamController::class, 'saveUserAnswer'])->name('exam.save-answer');

        Route::get('my-exams', [UserExamController::class, 'index'])->name('exam.user.index');
        Route::get('my-exams/{id}', [UserExamController::class, 'show'])->name('exam.user.show');
    });
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(AuthAdmin::class)->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('questions', QuestionController::class);
        Route::resource('users', UserController::class);
        Route::get('Shops', [ShopsController::class, 'index'])->name('shops');

    });
});

require __DIR__ . '/auth.php';
