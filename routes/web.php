<?php

/*
|-----------------------------------------------------------------------------------------------------------------------
| Application Routes
|-----------------------------------------------------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//======================================================================================================================
//About
//======================================================================================================================
//Route::get('aboutApp', 'AboutController');

//======================================================================================================================
//Home routes
//======================================================================================================================
Route::get('home', 'HomeController@index');

//======================================================================================================================
//Login routes
//======================================================================================================================
Route::get('/',function(){return redirect('/home');});

//======================================================================================================================
//User routes
//======================================================================================================================
Route::get('users/{id}/addresses', 'UserAddressController@addresses');
Route::get('users/{id}/telephones', 'UserTelephoneController@telephones');
Route::get('users/{id}/emails', 'UserController@email_addresses');
Route::get('users/{id}/emergency_contacts', 'UserEmergencyContactController@emergency_contacts');
Route::get('users/{id}/availabilities', 'UserAvailabilityController@availabilities');
Route::get('users/{id}/references', 'UserReferenceController@references');
Route::get('users/{id}/philosophies', 'UserPhilosophyController@philosophies');
Route::get('users/{id}/education', 'UserEducationController@education');

//======================================================================================================================
//User profile routes
//======================================================================================================================
Route::get('profile/{id}/info', 'UserProfileController@personal_info');
Route::get('profile/{id}/info/edit', 'UserProfileController@edit_personal_info');
Route::patch('profile/{id}/info/update',[
    'as' => 'user_profile.update_personal_info',
    'uses' => 'UserProfileController@update_personal_info'
]);
Route::get('profile/{id}/emergency_contacts', 'UserProfileController@emergency_contact');
Route::get('profile/{id}/emergency_contacts/{contact_id}/edit', 'UserProfileController@edit_emergency_contact');
Route::patch('profile/{id}/emergency_contacts/{cert_id}/update',[
    'as' => 'user_profile.update_emergency_contact',
    'uses' => 'UserProfileController@update_emergency_contact'
]);
Route::get('profile/{id}/work_experience', 'UserProfileController@work_experience');
Route::get('profile/{id}/work_experience/{work_id}/edit', 'UserProfileController@edit_work_experience');
Route::patch('profile/{id}/work_experience/{work_id}/update',[
    'as' => 'user_profile.update_work_experience',
    'uses' => 'UserProfileController@update_work_experience'
]);
Route::get('profile/{id}/availabilities', 'UserProfileController@availabilities');
Route::get('profile/{id}/availabilities/{avail_id}/edit', 'UserProfileController@edit_availabilities');
Route::patch('profile/{id}/availabilities/{avail_id}/update',[
    'as' => 'user_profile.update_availabilities',
    'uses' => 'UserProfileController@update_availabilities'
]);
Route::get('profile/{id}/availabilities/new', 'UserProfileController@new_availabilities');
Route::patch('profile/{id}/availabilities/store',[
    'as' => 'user_profile.store_availabilities',
    'uses' => 'UserProfileController@store_availabilities'
]);
Route::get('profile/{id}/education', 'UserProfileController@education');
Route::get('profile/{id}/education/{edu_id}/edit', 'UserProfileController@edit_education');
Route::patch('profile/{id}/education/{edu_id}/update',[
    'as' => 'user_profile.update_education',
    'uses' => 'UserProfileController@update_education'
]);
Route::get('profile/{id}/certifications', 'UserProfileController@certification');
Route::get('profile/{id}/certifications/{cert_id}/edit', 'UserProfileController@edit_certifications');
Route::patch('profile/{id}/certifications/{cert_id}/update',[
    'as' => 'user_profile.update_certifications',
    'uses' => 'UserProfileController@update_certifications'
]);

//======================================================================================================================
//User search routes
//======================================================================================================================
Route::get('/userSearch','UserSearchController@showSearch');
Route::post('/userSearch', ['as' => 'user_search', 'uses' => 'UserSearchController@getRecords']);


//======================================================================================================================
//Building routes
//======================================================================================================================
Route::get('buildings/{id}/classrooms', 'BuildingController@classrooms');
Route::get('schedules/{id}/scheduler', 'ScheduleController@scheduler');
Route::post('schedules/saveAppointments', 'ScheduleController@saveAppointments');
Route::get('schedules/getAvailabilities', 'ScheduleController@getAvailabilities');
Route::get('schedules/generate', 'ScheduleController@generate');

//======================================================================================================================
//Availability Reports
//======================================================================================================================
Route::get('availabilityReports/availabilities', 'AvailabilityReportsController@availabilities');
Route::get('availabilityReports/gaps', 'AvailabilityReportsController@gaps');
Route::post('availabilityReports/availabilitiesReport',
            ['as' => 'availabilities_report', 'uses'=>'AvailabilityReportsController@availabilitiesReport']);
Route::post('availabilityReports/gapsReport',
    ['as' => 'gaps_report', 'uses'=>'AvailabilityReportsController@gapsReport']);


//======================================================================================================================
//Certification Reports
//======================================================================================================================
Route::get('certificationReports/userCertifications', 'CertificationReportsController@userCertifications');
Route::get('certificationReports/expiredCertifications', 'CertificationReportsController@expiredCertifications');
Route::get('certificationReports/comingDueCertifications', 'CertificationReportsController@comingDueCertifications');

Route::post('certificationReports/generateUCR',
    ['as' => 'user_certifications_report', 'uses'=>'CertificationReportsController@userCertificationsReport']);
Route::post('certificationReports/generateCCDR',
    ['as' => 'certifications_coming_due_report', 'uses'=>'CertificationReportsController@comingDueReport']);
Route::post('certificationReports/generateECR',
    ['as' => 'expired_certifications_report', 'uses'=>'CertificationReportsController@expiredReport']);

//======================================================================================================================
//Emergency Contact Reports
//======================================================================================================================
Route::get('emergencyContactReports/missing', 'EmergencyContactReportsController@missing');

//======================================================================================================================
//Financial Aid Reports
//======================================================================================================================
Route::get('financialAidReports/financialAidRecipients', 'FinancialAidReportsController@financialAidRecipients');
Route::post('financialAidReports/generateFARR', ['as' => 'financial_aid_recipient_report',
            'uses'=>'FinancialAidReportsController@recipientsReport']);

//======================================================================================================================
//Scheduling reports
//======================================================================================================================
Route::get('schedulingReports/scheduledHours', 'SchedulingReportsController@scheduledHours');
Route::post('schedulingReports/calculateWorkHours', ['as' => 'scheduled_hours_report',
            'uses'=>'SchedulingReportsController@hoursWorked']);

//======================================================================================================================
//Classrooms
//======================================================================================================================
Route::get('classrooms/attendance', 'ClassroomController@attendance');
Route::get('classrooms/assignments', 'ClassroomController@assignments');

//======================================================================================================================
//Semesters
//======================================================================================================================
Route::get('semesters/assignments', 'SemesterController@assignments');

//======================================================================================================================
//Users resource routes
//======================================================================================================================
Route::resource('users', 'UserController');
Route::resource('user_addresses', 'UserAddressController');
Route::resource('user_telephones', 'UserTelephoneController');
Route::resource('user_emergency_contacts', 'UserEmergencyContactController');
Route::resource('user_availabilities', 'UserAvailabilityController');
Route::resource('user_references', 'UserReferenceController');
Route::resource('user_philosophies', 'UserPhilosophyController');
Route::resource('user_education', 'UserEducationController');

//======================================================================================================================
//Drop Down List routes
//======================================================================================================================
//Configurations
Route::resource('suffixes', 'SuffixController');
Route::resource('degree_types', 'DegreeTypeController');
Route::resource('telephone_types', 'TelephoneTypeController');
Route::resource('buildings', 'BuildingController');
Route::resource('semesters', 'SemesterController');
Route::resource('classrooms', 'ClassroomController');
Route::resource('relationships', 'RelationshipController');
Route::resource('weekdays', 'WeekdayController');
Route::resource('roles', 'RoleController');
Route::resource('security_privilege_types', 'SecurityPrivilegeTypeController');
Route::resource('financial_aid_types', 'FinancialAidTypeController');
Route::resource('work_status_types', 'WorkStatusTypeController');
Route::resource('age_group_types', 'AgeGroupTypeController');
Route::resource('certification_types', 'CertificationTypeController');
Route::resource('constraints', 'ConstraintsController');

//System
Route::resource('states', 'StateController');
Route::resource('countries','CountryController');
Route::get('/logs', 'LogController@index');


//======================================================================================================================
//Schedule routes
//======================================================================================================================
Route::resource('schedules', 'ScheduleController');

Route::auth();

//======================================================================================================================
//Student Application Links
//======================================================================================================================
//Route::resource('/application', 'ApplicationController',['except' => ['index']]);
Route::get('application/create','ApplicationController@create');
Route::post('application/store','ApplicationController@store');
Route::get('application/{id}','ApplicationController@show');
Route::get('application/type/{id}', ['as' => 'application.index', 'uses' => 'ApplicationController@index'])->where('id', '['.config('constants.user_status.PENDING').'-'.config('constants.user_status.REJECTED').']+');
Route::post('application/action', ['as' => 'application.action', 'uses' => 'ApplicationController@action']);
//======================================================================================================================
//Student Application checklist
//======================================================================================================================
Route::get('/checklist','ApplicationChecklistController@index') /*function(){ return view("pages.application.checklist.overview");})*/;
Route::get('/documents_upload','DocumentsUploadController@index') /*function(){ return view("pages.admin.application.checklist.documents");})*/;
Route::get('/drug_testing', function(){ return view("pages.admin.application.checklist.drug");});
Route::get('/employee_emergency_info', function(){ return view("pages.admin.application.checklist.emergency");});
Route::get('/employee_health_policy', function(){ return view("pages.admin.application.checklist.health");});
Route::get('/cell_phone_guidelines', function(){ return view("pages.admin.application.checklist.phone");});
Route::get('/sa_job_description', function(){ return view("pages.admin.application.checklist.responsibilities");});

//======================================================================================================================
//Student Dashboard Links
//======================================================================================================================
Route::get('/studentHome', 'StudentHomeController@index');
//Availabilities
Route::get('/studentAvailabilities','StudentHomeController@availabilities');
/*Route::get('/studentAvailabilitiesException', function(){ return view("pages.student.availabilities.exception");});
Route::get('/studentAvailabilitiesChange', function(){ return view("pages.student.availabilities.change");});*/
Route::get('studentAvailabilities/create', 'StudentHomeController@create_availabilities');
Route::patch('studentAvailabilities/store',[
    'as' => 'studentHomeController.store_availabilities',
    'uses' => 'studentHomeController@store_availabilities'
]);
//Certification
Route::get('/studentCertification','StudentHomeController@certifications');
Route::get('/studentCertification/create', 'StudentHomeController@create_certifications');
Route::patch('studentCertification/store',[
    'as' => 'studentHomeController.store_certifications',
    'uses' => 'studentHomeController@store_certifications'
]);
//schedule
Route::get('/studentSchedule', 'StudentHomeController@schedule');
//WorkExperience
Route::get('/studentWorkExperience', 'StudentHomeController@work_experience');
//Education
Route::get('/studentEducationHistory', 'StudentHomeController@education_history');
//EmergencyContact
Route::get('/studentEmergencyContact', 'StudentHomeController@emergency_contact');
Route::get('/studentEmergencyContact/{contact_id}/edit', 'StudentHomeController@edit_emergency_contact');
Route::get('/studentEmergencyContact/create', 'StudentHomeController@create_emergency_contact');
Route::patch('studentEmergencyContact/{contact_id}/update',[
    'as' => 'studentEmergencyContact.update_emergency_contact',
    'uses' => 'StudentHomeController@update_emergency_contact'
]);
Route::patch('studentEmergencyContact/store',[
    'as' => 'studentHomeController.store_emergency_contact',
    'uses' => 'StudentHomeController@store_emergency_contact'
]);
//PersonalInformation
Route::get('/studentPersonalInformation', 'StudentHomeController@personal_information');
Route::get('/studentPersonalInformation/edit', 'StudentHomeController@edit_personal_information');
Route::patch('studentPersonalInformation/update',[
    'as' => 'studentPersonalInformation.update_personal_info',
    'uses' => 'StudentHomeController@update_personal_info'
]);

////////***Mailing Routes***////////
Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');


//only a pending student who needs to fill up the checklist items will be able to access these routes
Route::group(['middleware' => ['auth','web','pendingstudent']], function() {
        //======================================================================================================================
        //Student Application checklist
        //======================================================================================================================*/
                Route::resource('/checklist','ApplicationChecklistController');
                Route::resource('/documents','DocumentsController');
                Route::resource('/emergency','UserEmergencyContactController');
                Route::get('/drug_testing', function(){ return view("pages.admin.application.checklist.drug");});
                Route::get('/employee_health_policy', function(){ return view("pages.admin.application.checklist.health");});
                Route::get('/cell_phone_guidelines', function(){ return view("pages.admin.application.checklist.phone");});
                Route::get('/sa_job_description', function(){ return view("pages.admin.application.checklist.responsibilities");});


});


//only an active student will be able to access these routes
Route::group(['middleware' => ['auth','web','activestudent']], function() {
        //======================================================================================================================
        //Student Dashboard Links
        //======================================================================================================================*/
                Route::get('/studentHome', 'StudentHomeController@index');
        //Availabilities
                Route::get('/studentAvailabilities','StudentHomeController@availabilities');
                /*Route::get('/studentAvailabilitiesException', function(){ return view("pages.student.availabilities.exception");});
                Route::get('/studentAvailabilitiesChange', function(){ return view("pages.student.availabilities.change");});*/
                Route::get('studentAvailabilities/create', 'StudentHomeController@create_availabilities');
                Route::patch('studentAvailabilities/store',[
                    'as' => 'studentHomeController.store_availabilities',
                    'uses' => 'StudentHomeController@store_availabilities'
                ]);
        //Certification
                Route::get('/studentCertification','StudentHomeController@certifications');
                Route::get('/studentCertification/create', 'StudentHomeController@create_certifications');
                Route::patch('studentCertification/store',[
                    'as' => 'studentHomeController.store_certifications',
                    'uses' => 'StudentHomeController@store_certifications'
                ]);
        //schedule
                Route::get('/studentSchedule', 'StudentHomeController@schedule');
        //WorkExperience
                Route::get('/studentWorkExperience', 'StudentHomeController@work_experience');
        //Education
                Route::get('/studentEducationHistory', 'StudentHomeController@education_history');
        //EmergencyContact
                Route::get('/studentEmergencyContact', 'StudentHomeController@emergency_contact');
                Route::get('/studentEmergencyContact/{contact_id}/edit', 'StudentHomeController@edit_emergency_contact');
                Route::get('/studentEmergencyContact/create', 'StudentHomeController@create_emergency_contact');
                Route::patch('studentEmergencyContact/{contact_id}/update',[
                    'as' => 'studentEmergencyContact.update_emergency_contact',
                    'uses' => 'StudentHomeController@update_emergency_contact'
                ]);
                Route::patch('studentEmergencyContact/store',[
                    'as' => 'studentHomeController.store_emergency_contact',
                    'uses' => 'StudentHomeController@store_emergency_contact'
                ]);
        //PersonalInformation
                Route::get('/studentPersonalInformation', 'StudentHomeController@personal_information');
                Route::get('/studentPersonalInformation/edit', 'StudentHomeController@edit_personal_information');
                Route::patch('studentPersonalInformation/update',[
                    'as' => 'studentPersonalInformation.update_personal_info',
                    'uses' => 'StudentHomeController@update_personal_info'
                ]);
});


//authorization middleware which ensures users are logged in as administrator to be able to see these pages
Route::group(['middleware' => ['auth','web','admin']], function()
{
    //======================================================================================================================
    //Home routes
    //======================================================================================================================
        Route::get('home', 'HomeController@index');

    //======================================================================================================================
    //User search routes
    //======================================================================================================================
        Route::get('/userSearch','UserSearchController@showSearch');
        Route::post('/userSearch', ['as' => 'user_search', 'uses' => 'UserSearchController@getRecords']);

    //======================================================================================================================
    //Drop Down List routes
    //======================================================================================================================
    //Configurations
        Route::resource('suffixes', 'SuffixController');
        Route::resource('degree_types', 'DegreeTypeController');
        Route::resource('telephone_types', 'TelephoneTypeController');
        Route::resource('buildings', 'BuildingController');
        Route::resource('semesters', 'SemesterController');
        Route::resource('classrooms', 'ClassroomController');
        Route::resource('relationships', 'RelationshipController');
        Route::resource('weekdays', 'WeekdayController');
        Route::resource('roles', 'RoleController');
        Route::resource('security_privilege_types', 'SecurityPrivilegeTypeController');
        Route::resource('financial_aid_types', 'FinancialAidTypeController');
        Route::resource('work_status_types', 'WorkStatusTypeController');
        Route::resource('age_group_types', 'AgeGroupTypeController');
        Route::resource('certification_types', 'CertificationTypeController');
        Route::resource('constraints', 'ConstraintsController');

    //System
        Route::resource('states', 'StateController');
        Route::resource('countries','CountryController');
    //Route::get('logs', function() { return view("pages.admin.system.log");});


    //======================================================================================================================
    //Schedule routes
    //======================================================================================================================
        Route::get('schedules/getAvailabilities', 'ScheduleController@getAvailabilities');
        Route::get('schedules/{id}/scheduler', 'ScheduleController@scheduler');
        Route::post('schedules/saveAppointments', 'ScheduleController@saveAppointments');
        Route::get('schedules/generate', 'ScheduleController@generate');
        Route::resource('schedules', 'ScheduleController');

    //======================================================================================================================
    //Building routes
    //======================================================================================================================
        Route::get('buildings/{id}/classrooms', 'BuildingController@classrooms');

    //======================================================================================================================
    //Availability Reports
    //======================================================================================================================
        Route::get('availabilityReports/availabilities', 'AvailabilityReportsController@availabilities');
        Route::get('availabilityReports/gaps', 'AvailabilityReportsController@gaps');
        Route::post('availabilityReports/availabilitiesReport',
            ['as' => 'availabilities_report', 'uses'=>'AvailabilityReportsController@availabilitiesReport']);
        Route::post('availabilityReports/gapsReport',
            ['as' => 'gaps_report', 'uses'=>'AvailabilityReportsController@gapsReport']);


    //======================================================================================================================
    //Certification Reports
    //======================================================================================================================
        Route::get('certificationReports/userCertifications', 'CertificationReportsController@userCertifications');
        Route::get('certificationReports/expiredCertifications', 'CertificationReportsController@expiredCertifications');
        Route::get('certificationReports/comingDueCertifications', 'CertificationReportsController@comingDueCertifications');

        Route::post('certificationReports/generateUCR',
            ['as' => 'user_certifications_report', 'uses'=>'CertificationReportsController@userCertificationsReport']);
        Route::post('certificationReports/generateCCDR',
            ['as' => 'certifications_coming_due_report', 'uses'=>'CertificationReportsController@comingDueReport']);
        Route::post('certificationReports/generateECR',
            ['as' => 'expired_certifications_report', 'uses'=>'CertificationReportsController@expiredReport']);

    //======================================================================================================================
    //Emergency Contact Reports
    //======================================================================================================================
        Route::get('emergencyContactReports/missing', 'EmergencyContactReportsController@missing');

    //======================================================================================================================
    //Financial Aid Reports
    //======================================================================================================================
        Route::get('financialAidReports/financialAidRecipients', 'FinancialAidReportsController@financialAidRecipients');
        Route::post('financialAidReports/generateFARR', ['as' => 'financial_aid_recipient_report',
            'uses'=>'FinancialAidReportsController@recipientsReport']);

    //======================================================================================================================
    //Scheduling reports
    //======================================================================================================================
        Route::get('schedulingReports/scheduledHours', 'SchedulingReportsController@scheduledHours');
        Route::post('schedulingReports/calculateWorkHours', ['as' => 'scheduled_hours_report',
            'uses'=>'SchedulingReportsController@hoursWorked']);

    //======================================================================================================================
    //Classrooms
    //======================================================================================================================
        Route::get('classrooms/attendance', 'ClassroomController@attendance');
        Route::get('classrooms/assignments', 'ClassroomController@assignments');

    //======================================================================================================================
    //Semesters
    //======================================================================================================================
        Route::get('semesters/assignments', 'SemesterController@assignments');

    //======================================================================================================================
    //User profile routes
    //======================================================================================================================
        Route::get('profile/{id}/info', 'UserProfileController@personal_info');
        Route::get('profile/{id}/info/edit', 'UserProfileController@edit_personal_info');
        Route::patch('profile/{id}/info/update',[
            'as' => 'user_profile.update_personal_info',
            'uses' => 'UserProfileController@update_personal_info'
        ]);
        Route::get('profile/{id}/emergency_contacts', 'UserProfileController@emergency_contact');
        Route::get('profile/{id}/emergency_contacts/{contact_id}/edit', 'UserProfileController@edit_emergency_contact');
        Route::patch('profile/{id}/emergency_contacts/{cert_id}/update',[
            'as' => 'user_profile.update_emergency_contact',
            'uses' => 'UserProfileController@update_emergency_contact'
        ]);
        Route::get('profile/{id}/work_experience', 'UserProfileController@work_experience');
        Route::get('profile/{id}/work_experience/{work_id}/edit', 'UserProfileController@edit_work_experience');
        Route::patch('profile/{id}/work_experience/{work_id}/update',[
            'as' => 'user_profile.update_work_experience',
            'uses' => 'UserProfileController@update_work_experience'
        ]);
        Route::get('profile/{id}/availabilities', 'UserProfileController@availabilities');
        Route::get('profile/{id}/availabilities/{avail_id}/edit', 'UserProfileController@edit_availabilities');
        Route::patch('profile/{id}/availabilities/{avail_id}/update',[
            'as' => 'user_profile.update_availabilities',
            'uses' => 'UserProfileController@update_availabilities'
        ]);
        Route::get('profile/{id}/availabilities/new', 'UserProfileController@new_availabilities');
        Route::patch('profile/{id}/availabilities/store',[
            'as' => 'user_profile.store_availabilities',
            'uses' => 'UserProfileController@store_availabilities'
        ]);
        Route::get('profile/{id}/education', 'UserProfileController@education');
        Route::get('profile/{id}/education/{edu_id}/edit', 'UserProfileController@edit_education');
        Route::patch('profile/{id}/education/{edu_id}/update',[
            'as' => 'user_profile.update_education',
            'uses' => 'UserProfileController@update_education'
        ]);
        Route::get('profile/{id}/certifications', 'UserProfileController@certification');
        Route::get('profile/{id}/certifications/{cert_id}/edit', 'UserProfileController@edit_certifications');
        Route::patch('profile/{id}/certifications/{cert_id}/update',[
            'as' => 'user_profile.update_certifications',
            'uses' => 'UserProfileController@update_certifications'
        ]);
        Route::get('profile/{id}/documents', 'UserProfileController@documents');
        Route::get('profile/{id}/documents/{doc_id}/view', 'UserProfileController@documentsFile');




});
