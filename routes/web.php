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
use App\Http\Controllers\PsychicCounseling\PsychicCounselingController;
use App\Http\Controllers\MarriageRequests\MarriageRequestController;
use App\Http\Controllers\Admin\MarriageRequestAdminController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddActivity\BusinessActivityController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\ProfileApprovalController;
use App\Http\Controllers\courses\CourseController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/cv', [CvController::class, 'index'])->name('cv');
Route::get('/printed-books', [PrintedBookController::class, 'index'])->name('printed-books');
Route::get('/e-books', [EbooksController::class, 'index'])->name('e-books');
Route::get('/add-activity', [AddActivityController::class, 'index'])->name('add-activity');
Route::get('/family-counseling', [FamilyCounselingController::class, 'index'])->name('family-counseling');
Route::get('/doctor-counseling', [DoctorCounselingController::class, 'index'])->name('doctor-counseling');
Route::get('/legal-counseling', [LegalCounselingController::class, 'index'])->name('legal-counseling');
Route::get('/psychic-counseling', [PsychicCounselingController::class, 'index'])->name('psychic-counseling');
Route::get('/legitimate-counseling', [LegitimateCounselingController::class, 'index'])->name('legitimate-counseling');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

Route::controller(GoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('/business-activities/create', [BusinessActivityController::class, 'create'])->name('business-activities.create');
Route::post('/business-activities', [BusinessActivityController::class, 'store'])->name('business-activities.store');
Route::get('/business-activities/{type}', [BusinessActivityController::class, 'showByType'])->name('business-activities.show');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::middleware(AuthUser::class)->group(function () {
        Route::post('update-gender', [GenderController::class, 'update'])->name('gender.update');
        Route::get('personal-info', [HomeController::class, 'personalInfoStart'])->name('personal-info');

        Route::get('index', [ExamController::class, 'index'])->name('exam.index');
        Route::get('exam/pledge', [ExamController::class, 'pledge'])->name('exam.pledge');
        Route::post('exam/save-answer', [ExamController::class, 'saveUserAnswer'])->name('exam.save-answer');

        Route::get('my-exams', [UserExamController::class, 'index'])->name('exam.user.index');
        Route::get('my-exams/{id}', [UserExamController::class, 'show'])->name('exam.user.show');
        Route::get('profile/{id}', [ProfileApprovalController::class, 'show'])->name('profile-approvals.show');

        Route::prefix('marriage-requests')->group(function () {
            Route::get('/', [MarriageRequestController::class, 'index'])->name('marriage-requests.index');
            Route::get('/create', [MarriageRequestController::class, 'create'])->name('marriage-requests.create');
            Route::get('/boys', [MarriageRequestController::class, 'boys'])->name('marriage-requests.boys');
            Route::get('/girls', [MarriageRequestController::class, 'girls'])->name('marriage-requests.girls');
            Route::get('/create-proposal/{targetId}', [MarriageRequestController::class, 'createProposal'])->name('marriage-requests.create-proposal');
            Route::post('/store-proposal/{targetId}', [MarriageRequestController::class, 'storeProposal'])->name('marriage-requests.store-proposal');
            Route::get('/status', [MarriageRequestController::class, 'status'])->name('marriage-requests.status');
            Route::get('/admin-approval', [MarriageRequestController::class, 'adminApproval'])->name('marriage-requests.admin-approval');
            Route::post('/approve/{id}', [MarriageRequestController::class, 'approve'])->name('marriage-requests.approve');
            Route::post('/reject/{id}', [MarriageRequestController::class, 'reject'])->name('marriage-requests.reject');
            Route::post('/respond/{id}', [MarriageRequestController::class, 'respond'])->name('marriage-requests.respond');
            Route::post('/submit-test/{id}', [MarriageRequestController::class, 'submitTest'])->name('marriage-requests.submit-test');
            Route::post('/submit-test-result/{id}', [MarriageRequestController::class, 'submitTestResult'])->name('marriage-requests.submit-test-result');
            Route::post('/final-approval/{id}', [MarriageRequestController::class, 'finalApproval'])->name('marriage-requests.final-approval');
            Route::get('/edit-profile', [RegisteredUserController::class, 'editProfile'])->name('profile.edit');
            Route::post('/update-profile', [RegisteredUserController::class, 'updateProfile'])->name('profile.update');
        });
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
        Route::resource('shops', BusinessActivityController::class);
        Route::get('/shops', [BusinessActivityController::class, 'index'])->name('shops');
        Route::post('/business-activities/{businessActivity}/status', [BusinessActivityController::class, 'updateStatus'])
            ->name('business-activities.updateStatus');
        Route::post('/profile/{id}/approve', [MarriageRequestAdminController::class, 'approveProfile'])->name('profile.approve');
        Route::post('/profile/{id}/reject', [MarriageRequestAdminController::class, 'rejectProfile'])->name('profile.reject');

        Route::resource('courses', AdminCourseController::class)->except('show');
        Route::prefix('profile-approvals')->group(function () {
            Route::get('/', [ProfileApprovalController::class, 'index'])->name('profile-approvals.index');
            Route::post('/{id}/approve', [ProfileApprovalController::class, 'approve'])->name('profile-approvals.approve');
            Route::get('/{id}', [ProfileApprovalController::class, 'show'])->name('profile-approvals.show');
            Route::post('/{id}/reject', [ProfileApprovalController::class, 'reject'])->name('profile-approvals.reject');
            Route::post('/{id}/pending', [ProfileApprovalController::class, 'pending'])->name('profile-approvals.pending');
        });
        Route::prefix('marriage-requests')->group(function () {
            Route::get('/', [MarriageRequestAdminController::class, 'index'])->name('marriage-requests.index');
            Route::post('/{id}/approve-final', [MarriageRequestAdminController::class, 'approveFinal'])->name('marriage-requests.approve-final');
            Route::post('/{id}/send-test-link', [MarriageRequestAdminController::class, 'sendTestLink'])->name('marriage-requests.send-test-link');
            Route::post('/{id}/approve-final', [MarriageRequestAdminController::class, 'approveFinal'])->name('marriage-requests.approve-final');
            Route::post('/{id}/reject', [MarriageRequestAdminController::class, 'reject'])->name('marriage-requests.reject');
            Route::post('/{id}/pending', [MarriageRequestAdminController::class, 'pending'])->name('marriage-requests.pending');
        });
    });
});

require __DIR__ . '/auth.php';
