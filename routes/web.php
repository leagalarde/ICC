<?php

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

Route::get('/', 'LoginController@checkLogin');
Route::get('/login', 'LoginController@checkLogin');
Route::get('/loginadmin', 'AdminController@adminLogout');
Route::get('/loginpm', 'PMController@PMLogout');

Route::get('dologin', 'LoginController@doLogin');
Route::get('/Register', function () {
    return view('register');
});

Route::get('/profileAdmin', 'AdminController@Profile');
Route::post('/AMeditProfile', 'AdminController@editProfile');
Route::post('/AMeditPassword', 'AdminController@editPassword');
Route::get('/profilePm', 'PMController@PMProfile');
Route::post('/PMeditProfile', 'PMController@editProfile');
Route::post('/PMeditPassword', 'PMController@editPassword');

Route::post('/doLogin', 'LoginController@doLogin');
Route::post('/doRegister', 'LoginController@doRegister');

Route::get('/admin_logout', 'AdminController@adminLogout');
Route::get('/indexAdmin', 'AdminController@indexAdmin');

Route::get('/updatenotifadmin', 'AdminController@updatenotif');

Route::get('/notification', 'AdminController@notification');

/* CLIENT */
Route::get('/client', 'AdminController@Client');

Route::get('/getClient', 'AdminController@getClient');

Route::post('/editclient', 'AdminController@editclient');

Route::post('/deleteclient', 'AdminController@deleteclient');

/* COMPANY */
Route::get('/company', 'AdminController@Company');

Route::get('/getCompany', 'AdminController@getCompany');

Route::post('/editcompany', 'AdminController@editcompany');

Route::post('/deletecompany', 'AdminController@deletecompany');

/* ENGINEER */
Route::get('/engineer', 'AdminController@Engineer');

Route::post('/addengineer', 'AdminController@addengineer');

Route::get('/getEngineer', 'AdminController@getEngineer');

Route::post('/editengineer', 'AdminController@editengineer');

Route::post('/deleteengineer', 'AdminController@deleteengineer');

/* Plans */
Route::get('/plans', 'AdminController@Plans');

Route::post('/addplan', 'AdminController@addplan');

Route::get('/getPlan', 'AdminController@getPlan');

Route::post('/editplan', 'AdminController@editplan');

Route::post('/deleteplan', 'AdminController@deleteplan');

/* Phases */
Route::get('/phase', 'AdminController@Phase');

Route::post('/addphase', 'AdminController@addphase');

Route::get('/getPhase', 'AdminController@getPhase');

Route::post('/editphase', 'AdminController@editphase');

Route::post('/deletephase', 'AdminController@deletephase');

/* Tasks */
Route::get('/tasks', 'AdminController@Task');

Route::post('/addtask', 'AdminController@addtask');

Route::get('/getTask', 'AdminController@getTask');

Route::post('/edittask', 'AdminController@edittask');

Route::post('/deletetask', 'AdminController@deletetask');

/* project_add */
Route::get('/project_add', 'AdminController@Projectadd');

Route::post('/EquipmentPending', 'AdminController@EquipmentPending');

Route::get('/getEquipList', 'AdminController@getEquipList');

Route::get('/getEquipDetails', 'AdminController@getEquipDetails');

Route::get('/getSupplySelect', 'AdminController@getSupplySelect');

Route::get('/getSupplyDetails', 'AdminController@getSupplyDetails');

Route::get('/getSuppList', 'AdminController@getSuppList');

Route::get('/getSuppDetails', 'AdminController@getSuppDetails');

Route::get('/getTaskDetails', 'AdminController@getTaskDetails');

Route::get('/getClientDetails', 'AdminController@getClientDetails');

Route::get('/getCompanyDetails', 'AdminController@getCompanyDetails');

Route::post('/addproject', 'AdminController@addproject');

Route::post('/deleteproject', 'AdminController@deleteproject');

/* project */
Route::get('/project', 'AdminController@Project');

/* project_detail */
Route::get('/project_detail', 'AdminController@ProjectView');

Route::get('/equipment_util', 'AdminController@EquipmentUtilization');

Route::get('/pdfequip', 'AdminController@DownloadEquipment');

Route::get('/pdftimeextreq', 'AdminController@pdftimeextreq');

/* project_edit */
Route::get('/project_edit', 'AdminController@ProjectEdit');

Route::get('/previewcontract', 'AdminController@PreviewContract');

Route::post('/editproject', 'AdminController@editproject');

Route::get('/closeproject', 'AdminController@closeproject');

Route::get('/openproject', 'AdminController@openproject');

Route::get('/monthlyreport', 'AdminController@MonthlyReport');

Route::get('/addinvoice', 'AdminController@addinvoice');

Route::post('/invoice', 'AdminController@invoice');

Route::post('/addprojinvoice', 'AdminController@saveinvoice');

Route::get('/getinvoice', 'AdminController@getinvoice');

Route::post('/editprojinvoice', 'AdminController@editprojinvoice');

Route::get('/approveequipreq', 'AdminController@approveequipreq');

Route::post('/addequipdep', 'AdminController@addequipdep');

Route::get('/rejectequipreq', 'AdminController@rejectequipreq');

Route::get('/approvetimeextreq', 'AdminController@approvetimeextreq');

Route::get('/rejecttimeextreq', 'AdminController@rejecttimeextreq');

Route::post('/editProjRemarks', 'AdminController@editprojremarks');

Route::get('/pdfinvoice', 'AdminController@pdfinvoice');

/* project_financial */
Route::get('/project_financial', 'AdminController@ProjectFinancial');

Route::get('/financial', 'AdminController@financialreport');

Route::get('/monthly_report', 'AdminController@monthly_report');

Route::get('/pf_detail', 'AdminController@ProjectFinancialView');

Route::get('/downloadfinancial', 'AdminController@DownloadFinancial');

/* Contract_information */
Route::get('/contract', 'AdminController@Contract');


/* Equipment List */
Route::get('/truck_category', 'AdminController@TruckCategory');

Route::post('/addtruck_category', 'AdminController@addTruckCategory');

Route::get('/gettruck_category', 'AdminController@getTruckCategory');

Route::post('/edittruck_category', 'AdminController@editTruckCategory');

Route::post('/deletetruck_category', 'AdminController@deleteTruckCategory');

/* Equipment */
Route::get('/equipment', 'AdminController@EquipmentCategory');

Route::get('/equipment_add', 'AdminController@addEquipment');

Route::get('/getequipmentinfo', 'AdminController@getEquipmentInfo');

Route::post('/addequipmentinfo', 'AdminController@addEquipmentinfo');

Route::post('/editequipmentinfo', 'AdminController@editEquipmentinfo');

Route::post('/deleteequipmentinfo', 'AdminController@deleteEquipmentInfo');

Route::get('/equipment_dep', 'AdminController@EquipmentDep');

Route::get('/equip_dep_detail', 'AdminController@EquipmentDepView');

Route::get('/ejr_detail', 'AdminController@ejrDetail');


Route::post('/editAdminProjContract', 'AdminController@editProjContract');

/* Project Manager */
Route::get('/indexProjectManager', 'PMController@indexPM');
/* logoout */
Route::get('/PM_logout', 'PMController@PMLogout');

Route::get('/PM_previewcontract', 'PMController@PreviewContract');

Route::get('/PM_monthlyreport', 'PMController@MonthlyReport');

Route::get('/PM_pdfinvoice', 'PMController@pdfinvoice');

/* PM_project */
Route::get('/PM_project', 'PMController@Project');

Route::get('/PM_notification', 'PMController@pmnotification');

/* PM_project_detail */
Route::get('/PM_project_detail', 'PMController@ProjectView');

/* PM_project_edit */
Route::get('/PM_project_edit', 'PMController@ProjectEdit');

Route::post('/editPMproject', 'PMController@editPMproject');

Route::get('/getClientCompany', 'PMController@getClientCompany');

Route::post('/editClientCompany', 'PMController@editClientCompany');

Route::get('/getAdminClientCompany', 'AdminController@getClientCompany');

Route::post('/editAdminClientCompany', 'AdminController@editClientCompany');

Route::get('/updatenotif', 'PMController@updatenotif');

Route::get('/getProjectTask', 'PMController@getProjectTask');

Route::post('/editProjectTask', 'PMController@editProjectTask');

Route::get('/getEquipment', 'PMController@getEquipment');

Route::post('/editEquipment', 'PMController@editEquipment');

Route::get('/getEquipmentMaintenance', 'PMController@getEquipmentMaintenance');

Route::post('/editEquipmentMaintenance', 'PMController@editEquipmentMaintenance');

Route::get('/getEquipmentRequest', 'PMController@getEquipmentRequest');

Route::post('/addEquipmentRequest', 'PMController@addEquipmentRequest');

Route::get('/reqequipment', 'PMController@ReqEquipment');

Route::get('/getreqdetails', 'PMController@getReqDetails');

Route::post('/reqtimeext', 'PMController@reqtimeext');

Route::post('/editProjContract', 'PMController@editProjContract');

Route::get('/getProjectMilestone', 'PMController@getProjectMilestone');

Route::post('/editProjectMilestone', 'PMController@editProjectMilestone');

/* PM_task */
Route::get('/PM_task', 'PMController@ProjectTask');

/* PM_phase */
Route::get('/PM_phase', 'PMController@ProjectPhase');

/* PM_calendar */
Route::get('/PM_calendar', 'PMController@ProjectCalendar');

Route::get('/getMyTask', 'PMController@MyTask');

Route::post('/editCalProjTask', 'PMController@editCalProjTask');

/* PM_timeextension */
Route::get('/PM_timeextension', 'PMController@PM_timeextension');

/* PM_pdf */
Route::get('/download', 'PMController@download');
