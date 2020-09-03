<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     // return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
//dashboard
Route::group(['middleware'=>['auth']],function(){
  Route::get('/home', 'HomeController@index')->name('home');
});
// //profile controller
// Route::group(['prefix'=>'profile','middleware'=>['auth']],function(){
// });
//all-users
Route::group(['prefix'=>'allusers','middleware'=>['auth']],function(){
  Route::resource('user-information','Backend\UserController');
  Route::resource('user-profile','Backend\ProfileController');
});
//setup Management
Route::group(['prefix'=>'setup','middleware'=>['auth']],function(){
  Route::resource('class-information','Backend\setup\StudentClassController');
  Route::resource('year-information','Backend\setup\StudentYearController');
  Route::resource('group-information','Backend\setup\StudentGroupController');
  Route::resource('shift-information','Backend\setup\StudentShitController');
  Route::resource('free-category','Backend\setup\FeeCategoryController');
  Route::resource('free-amount','Backend\setup\FeeAmountController');
  Route::resource('exam-type','Backend\setup\ExamTypeController');
  Route::resource('subject-view','Backend\setup\SubjectViewController');
  Route::resource('assign-subject','Backend\setup\AssignSubjectController');
  Route::resource('designation-information','Backend\setup\DesignationController');
});
//student Management
Route::group(['prefix'=>'students','middleware'=>['auth']],function(){
  Route::resource('registration-student','Backend\students\RegistrationController');
  Route::get('search-year-class-student','Backend\students\RegistrationController@search')->name('search-year-class-student');
//student class promotion
  Route::get('promotion-student/{student_id}','Backend\students\RegistrationController@promotion')->name('student-class-promotion');
  Route::post('store-promotion-student/{student_id}','Backend\students\RegistrationController@promotionStore')->name('store-promotion-student');
//student roll generate
Route::resource('student-roll-generate','Backend\students\StudentRollController');
Route::get('student-roll-generate-show','Backend\students\StudentRollController@getStudent')->name('get-student-roll');
//registration fee
Route::resource('registration-fee','Backend\students\RegistrationFeeController');
Route::get('registration-fee-payslip','Backend\students\RegistrationFeeController@Payslip')->name('student.registration.fee.Payslip');
//monthly fee
Route::resource('monthly-fee','Backend\students\MonthlyFeeController');
Route::get('monthly-fee-payslip','Backend\students\MonthlyFeeController@Payslip')->name('student.monthly.fee.Payslip');
//exam fee
Route::resource('exam-fee','Backend\students\ExamFeeController');
Route::get('exam-fee-payslip','Backend\students\ExamFeeController@Payslip')->name('student.exam.fee.Payslip');

});
//Employee Management
Route::group(['prefix'=>'employee','middleware'=>['auth']],function(){
  Route::resource('employee-registration','Backend\Employee\EmployeeRegistrationController');
  Route::resource('employee-salary','Backend\Employee\EmployeeSalaryController');
  Route::resource('employee-leave','Backend\Employee\EmployeeLeaveController');
  // Route::resource('employee-leavepurpose','Backend\Employee\LeavePurposeController');
  Route::resource('employee-attendance','Backend\Employee\EmployeeAttendanceController');
  Route::resource('employee-monthly-salary','Backend\Employee\EmployeeMonthlySalaryController');
});

//marks Management
Route::group(['prefix'=>'marks','middleware'=>['auth']],function(){
  Route::resource('student-marks-manage','Backend\Marks\MarksController');
  Route::post('student-marks-update','Backend\Marks\MarksController@markUpdate')->name('student-marks-update');
  //subject as class wise
  Route::get('marks.getsubject','Backend\Marks\MarksController@getsubject')->name('marks.getsubject');
  //student load form studentRegistration model
  Route::get('get-students','Backend\Marks\MarksController@getStudent')->name('get-students');
  //edit student marks
  Route::get('student-marks-edit','Backend\Marks\MarksController@marksEdit')->name('student-marks-edit');
  Route::get('get-student-subject-marks','Backend\Marks\MarksController@getMarks')->name('get-student-subject-marks');
});


Route::group(['prefix'=>'gradpoint','middleware'=>['auth']],function(){
  
});