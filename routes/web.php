<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;


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
    return view('welcome');
});

// route auth

//route register
    Route::get('/register',[AuthController::class, 'loadRegister']);
    Route::post('/register',[AuthController::class, 'userRegister'])->name('userRegister');

    //route landing page
    Route::get('/homeDashboard', function(){
        return redirect('/');
    });

    //route homeDashboard
    Route::get('/',[AuthController::class, 'loadHomeDashboard']);

    //route login
    Route::get('/login',[AuthController::class, 'loadLogin']);
    Route::post('/login',[AuthController::class, 'userLogin'])->name('userLogin');

    //route logout
    Route::get('/logout',[AuthController::class, 'logout']);

    //route forget password
    Route::get('/forget-password',[AuthController::class, 'forgetPasswordLoad']);
    Route::post('/forget-password',[AuthController::class, 'forgetPassword'])->name('forgetPassword');

    //route reset password
    Route::get('/reset-password',[AuthController::class, 'resetPasswordLoad']);
    Route::post('/reset-password',[AuthController::class, 'resetPassword'])->name('resetPassword');



    //route user
Route::group(['prefix' => 'user', 'middleware'=>['web','checkUser']], function(){
    Route::get('/dashboard',[UserController::class, 'Dashboard']);

    //exam
    Route::get('/exam',[UserController::class, 'exam']);
    Route::get('/exam/{id}',[ExamController::class, 'loadExamDashboard'])->name('exam.dashboard');
    Route::post('/exam-submit',[ExamController::class, 'examSubmit'])->name('examSubmit');
    Route::get('/exam/{id}/attempt', [ExamController::class, 'examAttempt'])->name('examAttempt');
    Route::get('/exam/{id}/attempt/{attempt_id}/history', [ExamController::class, 'examHistory'])->name('examHistory');

    //document
    Route::get('/document',[UserController::class, 'document']);
    Route::get('/document/{id}',[UserController::class, 'documentLoad'])->name('documentLoad');


    // profile
    Route::get('/user/{id}', [UserController::class, 'loadUserProfile'])->name('loadUserProfile');
    Route::post('/user/{id}', [UserController::class, 'updateUserProfile'])->name('updateUserProfile');

    // notification


});

    //route admin
Route::group(['prefix' => 'admin', 'middleware'=>['web','checkAdmin']], function(){
    Route::get('/dashboard',[AdminController::class, 'adminDashboard'])->name('dashboardAdmin');

    // subject route
    Route::get('/subject',[AdminController::class, 'subject']);
    Route::post('/add-subject',[AdminController::class, 'addSubject'])->name('addSubject');
    Route::post('/edit-subject',[AdminController::class, 'editSubject'])->name('editSubject');
    Route::post('/delete-subject',[AdminController::class, 'deleteSubject'])->name('deleteSubject');

    //test route
    Route::get('exam',[AdminController::class, 'exam']);
    Route::post('/add-exam',[AdminController::class, 'addExam'])->name('addExam');
    Route::get('/get-exam-detail/{id}',[AdminController::class, 'getExamDetail'])->name('getExamDetail');
    Route::post('/edit-exam',[AdminController::class, 'editExam'])->name('editExam');
    Route::post('/delete-exam',[AdminController::class, 'deleteExam'])->name('deleteExam');

    // Q&A
    Route::get('qna-ans',[AdminController::class, 'qnaDashboard']);
    Route::post('/add-qna-ans',[AdminController::class, 'addQna'])->name('addQna');
    Route::get('/get-qna-details',[AdminController::class, 'getQnaDetails'])->name('getQnaDetails');
    Route::get('/delete-ans',[AdminController::class, 'deleteAns'])->name('deleteAns');
    Route::post('/update-qna-ans',[AdminController::class, 'updateQna'])->name('updateQna');
    Route::post('/delete-qna-ans',[AdminController::class, 'deleteQna'])->name('deleteQna');
    Route::post('/import-qna-ans',[AdminController::class, 'importQna'])->name('importQna');

    // User
    Route::get('users',[AdminController::class, 'userDashboard']);
    Route::post('/add-user',[AdminController::class, 'addUser'])->name('addUser');
    Route::get('/get-user-detail/{id}',[AdminController::class, 'getUserDetail'])->name('getUserDetail');
    Route::post('/edit-user',[AdminController::class, 'editUser'])->name('editUser');
    Route::post('/delete-user',[AdminController::class, 'deleteUser'])->name('deleteUser');

//    manage-role
//    Route::get('/manage-role',[AdminController::class,'manageRole'])->name('manageRole');
//    Route::post('/update-role',[AdminController::class,'updateRole'])->name('updateRole');

    //role
    Route::get('/manage-role',[AdminController::class, 'manageRole']);
    Route::post('/add-manage',[AdminController::class, 'addManage'])->name('addManage');
    Route::post('/edit-manage',[AdminController::class, 'editManage'])->name('editManage');
    Route::post('/delete-manage',[AdminController::class, 'deleteManage'])->name('deleteManage');

    //qna-exam
    Route::get('/get-questions',[AdminController::class, 'getQuestions'])->name('getQuestions');
    Route::post('/add-questions',[AdminController::class, 'addQuestions'])->name('addQuestions');
    Route::get('/get-exam-questions',[AdminController::class, 'getExamQuestions'])->name('getExamQuestions');
    Route::post('/delete-exam-questions',[AdminController::class, 'deleteExamQuestions'])->name('deleteExamQuestions');

    //route ckeditor upload
    Route::post('/upload', [AdminController::class, 'upload'])->name('ckeditor.upload');

    // Notification
    Route::get('/notification',[AdminController::class, 'notification']);
    Route::post('/add-notification',[AdminController::class, 'addNotification'])->name('addNotification');
    Route::post('/edit-notification',[AdminController::class, 'editNotification'])->name('editNotification');
    Route::post('/delete-notification',[AdminController::class, 'deleteNotification'])->name('deleteNotification');

    // Document
    Route::get('/document',[AdminController::class, 'document']);
    Route::post('/add-document',[AdminController::class, 'addDocument'])->name('addDocument');
    Route::get('/get-document-detail/{id}',[AdminController::class, 'getDocumentDetail'])->name('getDocumentDetail');
    Route::get('/public/document/{filename}', [AdminController::class, 'getDocument'])->name('getDocument');
    Route::post('/edit-document',[AdminController::class, 'editDocument'])->name('editDocument');
    Route::post('/delete-document',[AdminController::class, 'deleteDocument'])->name('deleteDocument');

    // profile
    Route::get('/admin/{id}', [AdminController::class, 'loadProfile'])->name('loadProfile');
    Route::post('/admin/{id}', [AdminController::class, 'updateProfile'])->name('updateProfile');
});

