<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'inst';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//$route['inst-class'] = 'inst/inst_class';
//inst routes
$route['inst'] = 'inst';
$route['inst-login']			= 'inst/inst_login/school';
$route['inst-class'] = 'inst/inst_class';
$route['inst-logout'] = 'inst/inst_logout';
$route['inst-dashboard'] = 'inst/inst_dashboard';
$route['inst-profile'] = 'inst/inst_profile';
$route['inst-profile-img'] = 'inst/edit_inst_profile';
$route['inst-change-password'] = 'inst/update_inst_password';


$route['common-dashboard'] = 'teacher/dashboard';
//Teacher route
$route['teacher'] = 'teacher';
$route['teacher-login']			= 'teacher/teacher_login/teacher';
$route['teacher-logout'] = 'teacher/logout';
$route['teacher-data'] = 'teacher/teacher_dash';
$route['teacher-profile'] = 'teacher/profile';
$route['teacher-profile/(:any)'] = 'teacher/profile/$1';
$route['teacher-profile/(:any)/(:any)'] = 'teacher/profile/$1/$2';
$route['teacher-profile-img'] = 'teacher/edit_profile';
$route['teacher-change-password'] = 'teacher/update_password';

//Student route
$route['student'] = 'student';
$route['student-login']			= 'student/student_login/student';
$route['student-logout'] = 'student/Logout';
$route['student-dashboard'] = 'student/student_dashboard';
$route['student-profile'] = 'student/student_profile';
$route['student-profile-img'] = 'student/edit_student_profile';
$route['student-change-password'] = 'student/update_student_password';

//Class Teacher route
$route['class-teacher'] = 'class_teacher';
$route['class-teacher-logout'] = 'class_teacher/logout';
$route['class-teacher-data'] = 'class_teacher/dashboard';
$route['class-teacher-profile'] = 'class_teacher/profile';
$route['class-teacher-profile/(:any)'] = 'class_teacher/profile/$1';
$route['class-teacher-profile/(:any)/(:any)'] = 'class_teacher/profile/$1/$2';
$route['class-teacher-change-password'] = 'class_teacher/change_password';

//Accounts route
$route['accounts'] = 'accounts';
$route['accounts-logout'] = 'accounts/logout';
$route['accounts-data'] = 'accounts/dashboard';
$route['accounts-profile'] = 'accounts/profile';
$route['accounts-profile/(:any)'] = 'accounts/profile/$1';
$route['accounts-profile/(:any)/(:any)'] = 'accounts/profile/$1/$2';
$route['accounts-change-password'] = 'accounts/change_password';

//transport-data Route
$route['transport'] = 'transport';
$route['accounts-logout'] = 'transport/logout';
$route['transport-data'] = 'transport/dashboard';
$route['transport-profile'] = 'transport/profile';
$route['transport-profile/(:any)'] = 'transport/profile/$1';
$route['transport-profile/(:any)/(:any)'] = 'transport/profile/$1/$2';
$route['transport-change-password'] = 'transport/change_password';

//section-head-data Route
$route['section-head'] = 'section_head';
$route['section-head-logout'] = 'section_head/logout';
$route['section-head-data'] = 'section_head/dashboard';
$route['section-head-profile'] = 'section_head/profile';
$route['section-head-profile/(:any)'] = 'section_head/profile/$1';
$route['section-head-profile/(:any)/(:any)'] = 'section_head/profile/$1/$2';
$route['section-head-change-password'] = 'section_head/change_password';

//library-data Route
$route['library'] = 'library';
$route['library-logout'] = 'library/logout';
$route['library-data'] = 'library/dashboard';
$route['library-profile'] = 'library/profile';
$route['library-profile/(:any)'] = 'library/profile/$1';
$route['library-profile/(:any)/(:any)'] = 'library/profile/$1/$2';
$route['library-change-password'] = 'library/change_password';

// Start:: Profile
// teacher info
$route['teacher-info'] = 'inst/teacher_info';
$route['teacher-info/(:num)'] = 'inst/teacher_info/$1';
$route['teacher-info/(:any)'] = 'inst/teacher_info/$1';
$route['teacher-info/(:any)/(:num)'] = 'inst/teacher_info/$1/$2';
$route['teacher-info/(:any)/(:any)'] = 'inst/teacher_info/$1/$2';
$route['teacher-info/(:any)/(:any)/(:num)'] = 'inst/teacher_info/$1/$2/$3';

// change status
$route['change_status']        = 'inst/change_status';
$route['change_status1']        = 'teacher/change_status';

// Academc dashboard
$route['academic-data'] = 'academic/index';
$route['academic-profile'] = 'academic/profile';
$route['academic-profile/(:any)'] = 'academic/profile/$1';
$route['academic-profile/(:any)/(:any)'] = 'academic/profile/$1/$2';

// Academic Notice Master
$route['academic-notice'] = 'academic/academic_notice';
$route['academic-notice/(:num)'] = 'academic/academic_notice/$1';
$route['academic-notice/(:any)'] = 'academic/academic_notice/$1';
$route['academic-notice/(:any)/(:num)'] = 'academic/academic_notice/$1/$2';
$route['academic-notice/(:any)/(:any)'] = 'academic/academic_notice/$1/$2';
$route['academic-notice/(:any)/(:any)/(:num)'] = 'academic/academic_notice/$1/$2/$3';

// Class Master
$route['class-master'] = 'academic/class_master';
$route['class-master/(:num)'] = 'academic/class_master/$1';
$route['class-master/(:any)'] = 'academic/class_master/$1';
$route['class-master/(:any)/(:num)'] = 'academic/class_master/$1/$2';
$route['class-master/(:any)/(:any)'] = 'academic/class_master/$1/$2';
$route['class-master/(:any)/(:any)/(:num)'] = 'academic/class_master/$1/$2/$3';
$route['class_remote/(:any)'] 		= 'academic/class_remote/$1';
$route['class_remote/(:any)/(:any)'] 	= 'academic/class_remote/$1/$2';
$route['class_remote/(:any)/(:any)/(:any)'] = 'academic/class_remote/$1/$2/$3';

// Section Master
$route['section-master'] = 'academic/section_master';
$route['section-master/(:num)'] = 'academic/section_master/$1';
$route['section-master/(:any)'] = 'academic/section_master/$1';
$route['section-master/(:any)/(:num)'] = 'academic/section_master/$1/$2';
$route['section-master/(:any)/(:any)'] = 'academic/section_master/$1/$2';
$route['section-master/(:any)/(:any)/(:num)'] = 'academic/section_master/$1/$2/$3';

// Section  Allot Master
$route['section-allot-master'] = 'academic/section_allot_master';
$route['section-allot-master/(:num)'] = 'academic/section_allot_master/$1';
$route['section-allot-master/(:any)'] = 'academic/section_allot_master/$1';
$route['section-allot-master/(:any)/(:num)'] = 'academic/section_allot_master/$1/$2';
$route['section-allot-master/(:any)/(:any)'] = 'academic/section_allot_master/$1/$2';
// $route['section-allot-master/(:any)/(:any)/(:num)'] = 'academic/section_master/$1/$2/$3';

// Holiday Master
$route['holiday-master'] = 'academic/holiday_master';
$route['holiday-master/(:num)'] = 'academic/holiday_master/$1';
$route['holiday-master/(:any)'] = 'academic/holiday_master/$1';
$route['holiday-master/(:any)/(:num)'] = 'academic/holiday_master/$1/$2';
$route['holiday-master/(:any)/(:any)'] = 'academic/holiday_master/$1/$2';

// Exam Master
$route['exam-master'] = 'academic/exam_master';
$route['exam-master/(:num)'] = 'academic/exam_master/$1';
$route['exam-master/(:any)'] = 'academic/exam_master/$1';
$route['exam-master/(:any)/(:num)'] = 'academic/exam_master/$1/$2';
$route['exam-master/(:any)/(:any)'] = 'academic/exam_master/$1/$2';
$route['exam_remote/(:any)'] 		= 'academic/exam_remote/$1';
$route['exam_remote/(:any)/(:any)'] 	= 'academic/exam_remote/$1/$2';
$route['exam_remote/(:any)/(:any)/(:any)'] = 'academic/exam_remote/$1/$2/$3';

// category Master
$route['category-master'] = 'academic/category_master';
$route['category-master/(:num)'] = 'academic/category_master/$1';
$route['category-master/(:any)'] = 'academic/category_master/$1';
$route['category-master/(:any)/(:num)'] = 'academic/category_master/$1/$2';
$route['category-master/(:any)/(:any)'] = 'academic/category_master/$1/$2';
$route['category_remote/(:any)'] 		= 'academic/category_remote/$1';
$route['category_remote/(:any)/(:any)'] 	= 'academic/category_remote/$1/$2';
$route['category_remote/(:any)/(:any)/(:any)'] = 'academic/category_remote/$1/$2/$3';

// Academc dashboard
$route['admission-data'] = 'admission/index';
$route['admission-profile'] = 'admission/profile';
$route['admission-profile/(:any)'] = 'admission/profile/$1';
$route['admission-profile/(:any)/(:any)'] = 'admission/profile/$1/$2';
// Admission System
$route['admission-system'] = 'admission/admission_system';
$route['admission-system/(:num)'] = 'admission/admission_system/$1';
$route['admission-system/(:any)'] = 'admission/admission_system/$1';
$route['admission-system/(:any)/(:num)'] = 'admission/admission_system/$1/$2';
$route['admission-system/(:any)/(:any)'] = 'admission/admission_system/$1/$2';
$route['admission-system/(:any)/(:any)/(:num)'] = 'admission/admission_system/$1/$2/$3';


// Enquiry System
$route['enquiry-total'] = 'admission/total_enquiry';
$route['enquiry-total/(:num)'] = 'admission/total_enquiry/$1';
$route['enquiry-master'] = 'admission/enquiry_master';
$route['enquiry-master/(:num)'] = 'admission/enquiry_master/$1';
$route['enquiry-master/(:any)'] = 'admission/enquiry_master/$1';
$route['enquiry-master/(:any)/(:num)'] = 'admission/enquiry_master/$1/$2';
$route['enquiry-master/(:any)/(:any)'] = 'admission/enquiry_master/$1/$2';
$route['enquiry-master/(:any)/(:any)/(:num)'] = 'admission/enquiry_master/$1/$2/$3';

$route['rejected-student'] = 'admission/rejected_student';
$route['rejected-student/(:any)'] = 'admission/rejected_student/$1';
$route['rejected-student/(:any)/(:any)'] = 'admission/rejected_student/$1/$2';

// OH Hold 

$route['hold-student'] = 'admission/hold_student';
$route['hold-student/(:num)'] = 'admission/hold_student/$1';
$route['hold-student/(:any)'] = 'admission/hold_student/$1';
$route['hold-student/(:any)/(:num)'] = 'admission/hold_student/$1/$2';
$route['hold-student/(:any)/(:any)'] = 'admission/hold_student/$1/$2';
$route['hold-student/(:any)/(:any)/(:num)'] = 'admission/hold_student/$1/$2/$3';

// Registered Student
$route['registered-student'] = 'admission/registered_student';
$route['registered-student/(:num)'] = 'admission/registered_student/$1';
$route['registered-student/(:any)'] = 'admission/registered_student/$1';
$route['registered-student/(:any)/(:num)'] = 'admission/registered_student/$1/$2';
$route['registered-student/(:any)/(:any)'] = 'admission/registered_student/$1/$2';
$route['registered-student/(:any)/(:any)/(:num)'] = 'admission/registered_student/$1/$2/$3';

// admission-section-allot
$route['admission-section-allot'] = 'admission/admission_section_allot';
$route['admission-section-allot/(:num)'] = 'admission/admission_section_allot/$1';
$route['admission-section-allot/(:any)'] = 'admission/admission_section_allot/$1';
$route['admission-section-allot/(:any)/(:num)'] = 'admission/admission_section_allot/$1/$2';
$route['admission-section-allot/(:any)/(:any)'] = 'admission/admission_section_allot/$1/$2';
$route['admission-section-allot/(:any)/(:any)/(:num)'] = 'admission/admission_section_allot/$1/$2/$3';

// class-wise-registered
$route['class-wise-registered'] = 'admission/class_wise_registered';
$route['class-wise-registered/(:num)'] = 'admission/class_wise_registered/$1';

// View Register Student
$route['view-register-student/(:any)'] = 'admission/view_register_student/$1';
$route['view-register-student/(:any)/(:any)'] = 'admission/view_register_student/$1/$2';

// section-not-allot-student
$route['section-not-allot-student'] = 'admission/section_not_allot_student';
$route['section-not-allot-student/(:num)'] = 'admission/section_not_allot_student/$1';

// View Section Not Alloted Student
$route['view-section-not-allot-student/(:any)'] = 'admission/view_section_not_allot_student/$1';
$route['view-section-not-allot-student/(:any)/(:any)'] = 'admission/view_section_not_allot_student/$1/$2';

// section allot
$route['section-allot-student/(:any)'] = 'admission/view_section_not_allot_student/$1';
$route['section-allot-student/(:any)/(:any)'] = 'admission/view_section_not_allot_student/$1/$2';

$route['concession-master'] = 'admission/concession_master';
$route['concession-master/(:any)'] = 'admission/concession_master/$1';
$route['concession-master/(:any)/(:any)'] = 'admission/concession_master/$1/$2';
$route['concession_remote/(:any)'] 		= 'admission/concession_remote/$1';
$route['concession_remote/(:any)/(:any)'] 	= 'admission/concession_remote/$1/$2';
$route['concession_remote/(:any)/(:any)/(:any)'] = 'admission/concession_remote/$1/$2/$3';

// Student Master
$route['section-wise-student-master'] = 'admission/student_master';
$route['section-wise-student-master/(:num)'] = 'admission/student_master/$1';
$route['section-wise-student-master/(:any)'] = 'admission/student_master/$1';
$route['section-wise-student-master/(:any)/(:any)'] = 'admission/student_master/$1/$2';

$route['student-document-master'] = 'admission/student_document_master';
$route['student-document-master/(:num)'] = 'admission/student_document_master/$1';
$route['student-document-master/(:any)'] = 'admission/student_document_master/$1';
$route['student-document-master/(:any)/(:any)'] = 'admission/student_document_master/$1/$2';

// Student Update Details
$route['student-update-master'] = 'admission/student_update_details';
$route['student-update-master/(:num)'] = 'admission/student_update_details/$1';
$route['student-update-master/(:any)'] = 'admission/student_update_details/$1';
$route['student-update-master/(:any)/(:any)'] = 'admission/student_update_details/$1/$2';

// category-wise-student
$route['category-wise-student'] = 'admission/category_wise_student';
$route['category-wise-student/(:any)'] = 'admission/category_wise_student/$1';
$route['category-wise-student/(:any)/(:any)'] = 'admission/category_wise_student/$1/$2';


// category-wise-student
$route['left-student'] = 'admission/left_student';
$route['left-student/(:any)'] = 'admission/left_student/$1';
$route['left-student/(:any)/(:any)'] = 'admission/left_student/$1/$2';

// Hrm dashboard
$route['hrm-data'] = 'hrm/index';
$route['hrm-profile'] = 'hrm/profile';
$route['hrm-profile/(:any)'] = 'hrm/profile/$1';
$route['hrm-profile/(:any)/(:any)'] = 'hrm/profile/$1/$2';
// teacher information
$route['teacher-information'] = 'hrm/teacher_info';
$route['teacher-information/(:any)'] = 'hrm/teacher_info/$1';
$route['teacher-information/(:any)/(:any)'] = 'hrm/teacher_info/$1/$2';

// Subject Master
$route['subject-master'] = 'academic/subject_master';
$route['subject-master/(:any)'] = 'academic/subject_master/$1';
$route['subject-master/(:any)/(:any)'] = 'academic/subject_master/$1/$2';
$route['subject_remote/(:any)'] 		= 'academic/subject_remote/$1';
$route['subject_remote/(:any)/(:any)'] 	= 'academic/subject_remote/$1/$2';
$route['subject_remote/(:any)/(:any)/(:any)'] = 'academic/subject_remote/$1/$2/$3';

// Room Master
$route['room-master'] = 'hrm/room_master';
$route['room-master/(:any)'] = 'hrm/room_master/$1';
$route['room-master/(:any)/(:any)'] = 'hrm/room_master/$1/$2';
$route['room_remote/(:any)'] 		= 'hrm/room_remote/$1';
$route['room_remote/(:any)/(:any)'] 	= 'hrm/room_remote/$1/$2';
$route['room_remote/(:any)/(:any)/(:any)'] = 'hrm/room_remote/$1/$2/$3';


// Role Master
$route['role-master'] = 'hrm/role_master';
$route['role-master/(:any)'] = 'hrm/role_master/$1';
$route['role-master/(:any)/(:any)'] = 'hrm/role_master/$1/$2';

// Role Assign Master
$route['role-assign-master'] = 'hrm/role_assign_master';
$route['role-assign-master/(:any)'] = 'hrm/role_assign_master/$1';
$route['role-assign-master/(:any)/(:any)'] = 'hrm/role_assign_master/$1/$2';


// Principal dashboard
$route['principal-data'] = 'principal/index';
$route['principal-profile'] = 'principal/profile';
$route['principal-profile/(:any)'] = 'principal/profile/$1';
$route['principal-profile/(:any)/(:any)'] = 'principal/profile/$1/$2';
// Subject Teacher Mapping
$route['subject-teacher-mapping'] = 'principal/sub_tea_mapping';
$route['subject-teacher-mapping/(:any)'] = 'principal/sub_tea_mapping/$1';
$route['subject-teacher-mapping/(:any)/(:any)'] = 'principal/sub_tea_mapping/$1/$2';

// class Teacher Mapping
$route['class-teacher-mapping'] = 'principal/class_teacher_mapping';
$route['class-teacher-mapping/(:any)'] = 'principal/class_teacher_mapping/$1';
$route['class-teacher-mapping/(:any)/(:any)'] = 'principal/class_teacher_mapping/$1/$2';

// Section Head Mapping
$route['section-head-mapping'] = 'principal/section_head_mapping';
$route['section-head-mapping/(:any)'] = 'principal/section_head_mapping/$1';
$route['section-head-mapping/(:any)/(:any)'] = 'principal/section_head_mapping/$1/$2';
// Role Assign 
$route['role-assign'] = 'principal/role_assign_master';
$route['role-assign/(:any)'] = 'principal/role_assign_master/$1';
$route['role-assign/(:any)/(:any)'] = 'principal/role_assign_master/$1/$2';

// Student Notice
$route['my-notice'] = 'student/my_notice';
$route['my-notice/(:any)'] = 'student/my_notice/$1';
$route['my-notice/(:any)/(:any)'] = 'student/my_notice/$1/$2';

// Teacher Notice
$route['teacher-notice'] = 'teacher/my_notice';
$route['teacher-notice/(:any)'] = 'teacher/my_notice/$1';
$route['teacher-notice/(:any)/(:any)'] = 'teacher/my_notice/$1/$2';

// Uoload Notes
$route['upload-notes'] = 'teacher/upload_notes';
$route['upload-notes/(:any)'] = 'teacher/upload_notes/$1';
$route['upload-notes/(:any)/(:any)'] = 'teacher/upload_notes/$1/$2';

// Upload HW
$route['upload-hw'] = 'teacher/upload_hw';
$route['upload-hw/(:any)'] = 'teacher/upload_hw/$1';
$route['upload-hw/(:any)/(:any)'] = 'teacher/upload_hw/$1/$2';


//teacher-view-notes
$route['teacher-view-notes'] = 'teacher/view_notes';
$route['teacher-view-notes/(:any)'] = 'teacher/view_notes/$1';
$route['teacher-view-notes/(:any)/(:any)'] = 'teacher/view_notes/$1/$2';

//subject topic
$route['subject-topic-master'] = 'academic/subject_topic';
$route['subject-topic-master/(:any)'] = 'academic/subject_topic/$1';
$route['subject-topic-master/(:any)/(:any)'] = 'academic/subject_topic/$1/$2';

//student-subject-notes
$route['student-subject-notes'] = 'student/student_subject_notes';
$route['student-subject-notes/(:any)'] = 'student/student_subject_notes/$1';
$route['student-subject-notes/(:any)/(:any)'] = 'student/student_subject_notes/$1/$2';

//student-subject-notes
$route['student-home-work'] = 'student/student_home_work';
$route['student-home-work/(:any)'] = 'student/student_home_work/$1';
$route['student-home-work/(:any)/(:any)'] = 'student/student_home_work/$1/$2';

//student-subject-notes
$route['section-head-notice'] = 'section_head/my_notice';
$route['section-head-notice/(:any)'] = 'section_head/my_notice/$1';
$route['section-head-notice/(:any)/(:any)'] = 'section_head/my_notice/$1/$2';

//section-head-upload-notes
$route['section-head-upload-notes'] = 'section_head/upload_notes';
$route['section-head-upload-notes/(:any)'] = 'section_head/upload_notes/$1';
$route['section-head-upload-notes/(:any)/(:any)'] = 'section_head/upload_notes/$1/$2';

//section-head-view-notes
$route['section-head-view-notes'] = 'section_head/view_notes';
$route['section-head-view-notes/(:any)'] = 'section_head/view_notes/$1';
$route['section-head-view-notes/(:any)/(:any)'] = 'section_head/view_notes/$1/$2';

//section-head-upload-hw
$route['section-head-upload-hw'] = 'section_head/upload_hw';
$route['section-head-upload-hw/(:any)'] = 'section_head/upload_hw/$1';
$route['section-head-upload-hw/(:any)/(:any)'] = 'section_head/upload_hw/$1/$2';

//section-head-student-gate-pass
$route['section-head-student-gate-pass'] = 'section_head/student_gatepass';
$route['section-head-student-gate-pass/(:any)'] = 'section_head/student_gatepass/$1';
$route['section-head-student-gate-pass/(:any)/(:any)'] = 'section_head/student_gatepass/$1/$2';

//section-head-student-master
$route['section-head-student-master'] = 'section_head/student_master';
$route['section-head-student-master/(:any)'] = 'section_head/student_master/$1';
$route['section-head-student-master/(:any)/(:any)'] = 'section_head/student_master/$1/$2';


//sectionhead-student-attendance-register
$route['sectionhead-student-attendance-register'] = 'section_head/student_attendance_register';
$route['sectionhead-student-attendance-register/(:any)'] = 'section_head/student_attendance_register/$1';
$route['sectionhead-student-attendance-register/(:any)/(:any)'] = 'section_head/student_attendance_register/$1/$2';

//section-wise-period-master
$route['section-wise-period-master'] = 'section_head/periods';
$route['section-wise-period-master/(:any)'] = 'section_head/periods/$1';
$route['section-wise-period-master/(:any)/(:any)'] = 'section_head/periods/$1/$2';

//section-time-table
$route['section-time-table'] = 'section_head/time_table';
$route['section-time-table/(:any)'] = 'section_head/time_table/$1';
$route['section-time-table/(:any)/(:any)'] = 'section_head/time_table/$1/$2';

//teacher-student-gate-pass
$route['teacher-student-gate-pass'] = 'teacher/student_gatepass';
$route['teacher-student-gate-pass/(:any)'] = 'teacher/student_gatepass/$1';
$route['teacher-student-gate-pass/(:any)/(:any)'] = 'teacher/student_gatepass/$1/$2';

//teacher-student-master
$route['teacher-student-master'] = 'teacher/student_master';
$route['teacher-student-master/(:any)'] = 'teacher/student_master/$1';
$route['teacher-student-master/(:any)/(:any)'] = 'teacher/student_master/$1/$2';


//student-attendance
$route['student-attendance'] = 'teacher/student_attendance';
$route['student-attendance/(:any)'] = 'teacher/student_attendance/$1';
$route['student-attendance/(:any)/(:any)'] = 'teacher/student_attendance/$1/$2';

//teacher-student-attendance-register
$route['teacher-student-attendance-register'] = 'teacher/student_attendance_register';
$route['teacher-student-attendance-register/(:any)'] = 'teacher/student_attendance_register/$1';
$route['teacher-student-attendance-register/(:any)/(:any)'] = 'teacher/student_attendance_register/$1/$2';


//view-teacher-time-table
$route['view-teacher-time-table'] = 'teacher/time_table';
$route['view-teacher-time-table/(:any)'] = 'teacher/time_table/$1';
$route['view-teacher-time-table/(:any)/(:any)'] = 'teacher/time_table/$1/$2';

//academic-student-master
$route['academic-student-master'] = 'academic/student_master';
$route['academic-student-master/(:any)'] = 'academic/student_master/$1';
$route['academic-student-master/(:any)/(:any)'] = 'academic/student_master/$1/$2';


//academic-student-attendance-register
$route['academic-student-attendance-register'] = 'academic/student_attendance_register';
$route['academic-student-attendance-register/(:any)'] = 'academic/student_attendance_register/$1';
$route['academic-student-attendance-register/(:any)/(:any)'] = 'academic/student_attendance_register/$1/$2';

//academic-section-wise-period-master
$route['academic-section-wise-period-master'] = 'academic/periods';
$route['academic-section-wise-period-master/(:any)'] = 'academic/periods/$1';
$route['academic-section-wise-period-master/(:any)/(:any)'] = 'academic/periods/$1/$2';

//class-teacher-notice
$route['class-teacher-notice'] = 'class_teacher/my_notice';
$route['class-teacher-notice/(:any)'] = 'class_teacher/my_notice/$1';
$route['class-teacher-notice/(:any)/(:any)'] = 'class_teacher/my_notice/$1/$2';

//class-teacher-upload-notes
$route['class-teacher-upload-notes'] = 'class_teacher/upload_notes';
$route['class-teacher-upload-notes/(:any)'] = 'class_teacher/upload_notes/$1';
$route['class-teacher-upload-notes/(:any)/(:any)'] = 'class_teacher/upload_notes/$1/$2';

//class-teacher-view-notes
$route['class-teacher-view-notes'] = 'class_teacher/view_notes';
$route['class-teacher-view-notes/(:any)'] = 'class_teacher/view_notes/$1';
$route['class-teacher-view-notes/(:any)/(:any)'] = 'class_teacher/view_notes/$1/$2';


//class-teacher-upload-hw
$route['class-teacher-upload-hw'] = 'class_teacher/upload_hw';
$route['class-teacher-upload-hw/(:any)'] = 'class_teacher/upload_hw/$1';
$route['class-teacher-upload-hw/(:any)/(:any)'] = 'class_teacher/upload_hw/$1/$2';

//class-teacher-student-gate-pass
$route['class-teacher-student-gate-pass'] = 'class_teacher/student_gatepass';
$route['class-teacher-student-gate-pass/(:any)'] = 'class_teacher/student_gatepass/$1';
$route['class-teacher-student-gate-pass/(:any)/(:any)'] = 'class_teacher/student_gatepass/$1/$2';

//class-teacher-student-master
$route['class-teacher-student-master'] = 'class_teacher/student_master';
$route['class-teacher-student-master/(:any)'] = 'class_teacher/student_master/$1';
$route['class-teacher-student-master/(:any)/(:any)'] = 'class_teacher/student_master/$1/$2';


//class-subject-topic-master
$route['class-subject-topic-master'] = 'class_teacher/subject_topic';
$route['class-subject-topic-master/(:any)'] = 'class_teacher/subject_topic/$1';
$route['class-subject-topic-master/(:any)/(:any)'] = 'class_teacher/subject_topic/$1/$2';

//class-student-attendance-register
$route['class-student-attendance-register'] = 'class_teacher/student_attendance_register';
$route['class-student-attendance-register/(:any)'] = 'class_teacher/student_attendance_register/$1';
$route['class-student-attendance-register/(:any)/(:any)'] = 'class_teacher/student_attendance_register/$1/$2';

//view-class-teacher-time-table
$route['view-class-teacher-time-table'] = 'class_teacher/time_table';
$route['view-class-teacher-time-table/(:any)'] = 'class_teacher/time_table/$1';
$route['view-class-teacher-time-table/(:any)/(:any)'] = 'class_teacher/time_table/$1/$2';



//principal-student-gate-pass
$route['principal-student-gate-pass'] = 'principal/student_gatepass';
$route['principal-student-gate-pass/(:any)'] = 'principal/student_gatepass/$1';
$route['principal-student-gate-pass/(:any)/(:any)'] = 'principal/student_gatepass/$1/$2';


//principal-student-master
$route['principal-student-master'] = 'principal/student_master';
$route['principal-student-master/(:any)'] = 'principal/student_master/$1';
$route['principal-student-master/(:any)/(:any)'] = 'principal/student_master/$1/$2';

//principal-student-attendance-register
$route['principal-student-attendance-register'] = 'principal/student_attendance_register';
$route['principal-student-attendance-register/(:any)'] = 'principal/student_attendance_register/$1';
$route['principal-student-attendance-register/(:any)/(:any)'] = 'principal/student_attendance_register/$1/$2';

//principal-section-time-table
$route['principal-section-time-table'] = 'principal/time_table';
$route['principal-section-time-table/(:any)'] = 'principal/time_table/$1';
$route['principal-section-time-table/(:any)/(:any)'] = 'principal/time_table/$1/$2';

//library-student-master
$route['library-student-master'] = 'library/student_master';
$route['library-student-master/(:any)'] = 'library/student_master/$1';
$route['library-student-master/(:any)/(:any)'] = 'library/student_master/$1/$2';

//drivers-master
$route['drivers-master'] = 'transport/drivers_master';
$route['drivers-master/(:any)'] = 'transport/drivers_master/$1';
$route['drivers-master/(:any)/(:any)'] = 'transport/drivers_master/$1/$2';

//conductors-master
$route['conductors-master'] = 'transport/conductors_masters';
$route['conductors-master/(:any)'] = 'transport/conductors_masters/$1';
$route['conductors-master/(:any)/(:any)'] = 'transport/conductors_masters/$1/$2';

//vehicle-master
$route['vehicle-master'] = 'transport/vehicle_master';
$route['vehicle-master/(:any)'] = 'transport/vehicle_master/$1';
$route['vehicle-master/(:any)/(:any)'] = 'transport/vehicle_master/$1/$2';


//sub-route-map
$route['sub-route-map'] = 'transport/sub_route';
$route['sub-route-map/(:any)'] = 'transport/sub_route/$1';
$route['sub-route-map/(:any)/(:any)'] = 'transport/sub_route/$1/$2';

//route-allocation
$route['route-allocation'] = 'transport/route_allocation';
$route['route-allocation/(:any)'] = 'transport/route_allocation/$1';
$route['route-allocation/(:any)/(:any)'] = 'transport/route_allocation/$1/$2';


//student-route-map
$route['student-route-map'] = 'transport/student_route_mapping';
$route['student-route-map/(:any)'] = 'transport/student_route_mapping/$1';
$route['student-route-map/(:any)/(:any)'] = 'transport/student_route_mapping/$1/$2';

//student-vehicle-attendance
$route['student-vehicle-attendance'] = 'transport/student_vehicle_attendance';
$route['student-vehicle-attendance/(:any)'] = 'transport/student_vehicle_attendance/$1';
$route['student-vehicle-attendance/(:any)/(:any)'] = 'transport/student_vehicle_attendance/$1/$2';

//admission-student-attendance-register
$route['admission-student-attendance-register'] = 'admission/student_attendance_register';
$route['admission-student-attendance-register/(:any)'] = 'admission/student_attendance_register/$1';
$route['admission-student-attendance-register/(:any)/(:any)'] = 'admission/student_attendance_register/$1/$2';


//my-attendance
$route['my-attendance'] = 'student/student_attendance_register';
$route['my-attendance/(:any)'] = 'student/student_attendance_register/$1';
$route['my-attendance/(:any)/(:any)'] = 'student/student_attendance_register/$1/$2';

//student-gate-pass
$route['student-gate-pass'] = 'student/student_gatepass';
$route['student-gate-pass/(:any)'] = 'student/student_gatepass/$1';
$route['student-gate-pass/(:any)/(:any)'] = 'student/student_gatepass/$1/$2';

//student-time-table
$route['student-time-table'] = 'student/time_table';
$route['student-time-table/(:any)'] = 'student/time_table/$1';
$route['student-time-table/(:any)/(:any)'] = 'student/time_table/$1/$2';


//fee-type-master
$route['fee-type-master'] = 'accounts/fee_type_master';
$route['fee-type-master/(:any)'] = 'accounts/fee_type_master/$1';
$route['fee-type-master/(:any)/(:any)'] = 'accounts/fee_type_master/$1/$2';
$route['fee_type_remote/(:any)'] 		= 'accounts/fee_type_remote/$1';
$route['fee_type_remote/(:any)/(:any)'] 	= 'accounts/fee_type_remote/$1/$2';
$route['fee_type_remote/(:any)/(:any)/(:any)'] = 'accounts/fee_type_remote/$1/$2/$3';

//fee-head-master
$route['fee-head-master'] = 'accounts/fee_head_master';
$route['fee-head-master/(:any)'] = 'accounts/fee_head_master/$1';
$route['fee-head-master/(:any)/(:any)'] = 'accounts/fee_head_master/$1/$2';

//academic-yaer-master
$route['academic-year-master'] = 'accounts/academic_year_master';
$route['academic-year-master/(:any)'] = 'accounts/academic_year_master/$1';
$route['academic-year-master/(:any)/(:any)'] = 'accounts/academic_year_master/$1/$2';

//fee-scheme-master
$route['fee-scheme-master'] = 'accounts/scheme';
$route['fee-scheme-master/(:any)'] = 'accounts/scheme/$1';
$route['fee-scheme-master/(:any)/(:any)'] = 'accounts/scheme/$1/$2';

//fee-structure
$route['fee-structure'] = 'accounts/structure';
$route['fee-structure/(:any)'] = 'accounts/structure/$1';
$route['fee-structure/(:any)/(:any)'] = 'accounts/structure/$1/$2';

//view-fee-structure
$route['view-fee-structure'] = 'accounts/view_fee_structure';
$route['view-fee-structure/(:any)'] = 'accounts/view_fee_structure/$1';
$route['view-fee-structure/(:any)/(:any)'] = 'accounts/view_fee_structure/$1/$2';

//fee-collection
$route['fee-collection'] = 'accounts/fee_collection';
$route['fee-collection/(:any)'] = 'accounts/fee_collection/$1';
$route['fee-collection/(:any)/(:any)'] = 'accounts/fee_collection/$1/$2';
$route['fee-PrintReceipt'] = 'accounts/PrintReceipt';
$route['fee-PrintReceipt/(:any)'] = 'accounts/PrintReceipt/$1';
$route['fee-PrintReceipt/(:any)/(:any)'] = 'accounts/PrintReceipt/$1/$2';

//fee-collection-report
$route['fee-collection-report'] = 'accounts/fee_collection_report';
$route['fee-collection-report/(:any)'] = 'accounts/fee_collection_report/$1';
$route['fee-collection-report/(:any)/(:any)'] = 'accounts/fee_collection_report/$1/$2';

//student-fee-collection-report
$route['student-fee-collection-report'] = 'accounts/student_fee_collection_report';
$route['student-fee-collection-report/(:any)'] = 'accounts/student_fee_collection_report/$1';
$route['student-fee-collection-report/(:any)/(:any)'] = 'accounts/student_fee_collection_report/$1/$2';

//student-fee-defaulter-list
$route['student-fee-defaulter-list'] = 'accounts/student_fee_defaulter_list';
$route['student-fee-defaulter-list/(:any)'] = 'accounts/student_fee_defaulter_list/$1';
$route['student-fee-defaulter-list/(:any)/(:any)'] = 'accounts/student_fee_defaulter_list/$1/$2';

//section-wise-fee-collection-report
$route['section-wise-fee-collection-report'] = 'accounts/section_wise_fee_collection_report';
$route['section-wise-fee-collection-report/(:any)'] = 'accounts/section_wise_fee_collection_report/$1';
$route['section-wise-fee-collection-report/(:any)/(:any)'] = 'accounts/section_wise_fee_collection_report/$1/$2';

//student-marks-upload
$route['student-marks-upload'] = 'academic/student_marks_upload';
$route['student-marks-upload/(:any)'] = 'academic/student_marks_upload/$1';
$route['student-marks-upload/(:any)/(:any)'] = 'academic/student_marks_upload/$1/$2';

//teacher-student-marks-upload
$route['teacher-student-marks-upload'] = 'teacher/student_marks_upload';
$route['teacher-student-marks-upload/(:any)'] = 'teacher/student_marks_upload/$1';
$route['teacher-student-marks-upload/(:any)/(:any)'] = 'teacher/student_marks_upload/$1/$2';

//principal-student-marks-upload
$route['principal-student-marks-upload'] = 'principal/student_marks_upload';
$route['principal-student-marks-upload/(:any)'] = 'principal/student_marks_upload/$1';
$route['principal-student-marks-upload/(:any)/(:any)'] = 'principal/student_marks_upload/$1/$2';


//student-marksheet
$route['student-marksheet'] = 'principal/student_marksheet';
$route['student-marksheet/(:any)'] = 'principal/student_marksheet/$1';
$route['student-marksheet/(:any)/(:any)'] = 'principal/student_marksheet/$1/$2';

//student-marksheet-individual
$route['student-marksheet-individual'] = 'principal/student_marksheet_individual';
$route['student-marksheet-individual/(:any)'] = 'principal/student_marksheet_individual/$1';
$route['student-marksheet-individual/(:any)/(:any)'] = 'principal/student_marksheet_individual/$1/$2';


//academic-calendar
$route['academic-calendar'] = 'academic/calendar';
$route['academic-calendar/(:any)'] = 'academic/calendar/$1';
$route['academic-calendar/(:any)/(:any)'] = 'academic/calendar/$1/$2';

//fee-collection-report
$route['fee-collection-this-month-report'] = 'accounts/fee_collection_this_month_report';
$route['fee-collection-this-month-report/(:any)'] = 'accounts/fee_collection_this_month_report/$1';
$route['fee-collection-this-month-report/(:any)/(:any)'] = 'accounts/fee_collection_this_month_report/$1/$2';

//this-month-paid-fee-student
$route['this-month-paid-fee-student'] = 'accounts/this_month_paid_fee_student';
$route['this-month-paid-fee-student/(:any)'] = 'accounts/this_month_paid_fee_student/$1';
$route['this-month-paid-fee-student/(:any)/(:any)'] = 'accounts/this_month_paid_fee_student/$1/$2';

//this-month-unpaid-fee-student
$route['this-month-unpaid-fee-student'] = 'accounts/this_month_unpaid_fee_student';
$route['this-month-unpaid-fee-student/(:any)'] = 'accounts/this_month_unpaid_fee_student/$1';
$route['this-month-unpaid-fee-student/(:any)/(:any)'] = 'accounts/this_month_unpaid_fee_student/$1/$2';



//add-author
$route['add-author'] = 'library/add_author';
$route['add-author/(:any)'] = 'library/add_author/$1';
$route['add-author/(:any)/(:any)'] = 'library/add_author/$1/$2';

// library remote
$route['library_remote/(:any)'] 		= 'library/library_remote/$1';
$route['library_remote/(:any)/(:any)'] 	= 'library/library_remote/$1/$2';
$route['library_remote/(:any)/(:any)/(:any)'] = 'library/library_remote/$1/$2/$3';

//add-publishers
$route['add-publishers'] = 'library/add_publishers';
$route['add-publishers/(:any)'] = 'library/add_publishers/$1';
$route['add-publishers/(:any)/(:any)'] = 'library/add_publishers/$1/$2';

//book-category-master
$route['book-category-master'] = 'library/book_category_master';
$route['book-category-master/(:any)'] = 'library/book_category_master/$1';
$route['book-category-master/(:any)/(:any)'] = 'library/book_category_master/$1/$2';

//books-master
$route['books-master'] = 'library/books_master';
$route['books-master/(:any)'] = 'library/books_master/$1';
$route['books-master/(:any)/(:any)'] = 'library/books_master/$1/$2';

//student-book-assign
$route['student-book-assign'] = 'library/student_book_assign';
$route['student-book-assign/(:any)'] = 'library/student_book_assign/$1';
$route['student-book-assign/(:any)/(:any)'] = 'library/student_book_assign/$1/$2';

//teacher-book-assign
$route['teacher-book-assign'] = 'library/teacher_book_assign';
$route['teacher-book-assign/(:any)'] = 'library/teacher_book_assign/$1';
$route['teacher-book-assign/(:any)/(:any)'] = 'library/teacher_book_assign/$1/$2';


//teacher-assigned-books
$route['teacher-assigned-books'] = 'library/teacher_assigned_books';
$route['teacher-assigned-books/(:any)'] = 'library/teacher_assigned_books/$1';
$route['teacher-assigned-books/(:any)/(:any)'] = 'library/teacher_assigned_books/$1/$2';

//teacher-attendance
$route['teacher-attendance'] = 'teacher/teacher_attendance';
$route['teacher-attendance/(:any)'] = 'library/teacher_attendance/$1';
$route['teacher-attendance/(:any)/(:any)'] = 'library/teacher_attendance/$1/$2';
$route['submit_attendance'] = 'teacher/submit_attendance';

//working-hour-master
$route['working-hour-master'] = 'hrm/working_hour_master';
$route['working-hour-master/(:any)'] = 'hrm/working_hour_master/$1';
$route['working-hour-master/(:any)/(:any)'] = 'hrm/working_hour_master/$1/$2';

//staff-attendance-register
$route['staff-attendance-register'] = 'hrm/staff_attendance_register';
$route['staff-attendance-register/(:any)'] = 'hrm/staff_attendance_register/$1';
$route['staff-attendance-register/(:any)/(:any)'] = 'hrm/staff_attendance_register/$1/$2';
