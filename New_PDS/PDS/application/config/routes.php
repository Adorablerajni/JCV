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
$route['default_controller'] = 'home';
// $route['test'] = 'home/test';
$route['signup'] = 'home/sign_up';
$route['forgot_password'] = 'home/forgot_password';
$route['registered'] = 'home/registered';
$route['forgetpassword'] = 'home/forgetpassword';
$route['new_password/:any/:any'] = 'home/new_password/$1/$2';
$route['save_new_password'] = 'home/save_new_password';
$route['verify'] = 'home/verify';
$route['login'] = 'home/login_user';
$route['dashboard'] = 'dashboard';
$route['url_list'] = 'dashboard/url_list';
$route['add_url'] = 'dashboard/add_url';
$route['(edit_url/:num)'] = 'dashboard/edit_url/$1';
$route['(delete_url/:num)'] = 'dashboard/delete_url/$1';
$route['questions'] = 'question';
$route['add_question'] = 'question/add_question';
$route['(edit_question/:num)'] = 'question/edit_question/$1';
$route['(delete_question/:num)'] = 'question/delete_question/$1';
$route['questions_responses'] = 'question/question_responses';
$route['poll'] = 'poll';
$route['users'] = 'Home/users_list';
$route['poll_response'] = 'poll/poll_response';
$route['posts'] = 'posts/posts';
$route['logout'] = 'logout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
