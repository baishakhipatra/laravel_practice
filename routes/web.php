<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;

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


 Route::get('/login',[LoginController::class, 'loginForm'])->name('login')->middleware('guest');
 Route::post('/login',[LoginController::class, 'login']);

 Route::get('/register',[RegisterController::class, 'registerForm'])->name('register')->middleware('guest');
 Route::post('/register',[RegisterController::class, 'register']);


 Route::get('/forget-password',[LoginController::class, 'forgetPasswordForm'])->name('forget.password.form');
 Route::post('/forget-password',[LoginController::class, 'forgetPassword'])->name('forget.password');

 Route::prefix('admin')->middleware(['auth:web'])->group(function(){
      Route::get('/index',[HomeController::class, 'index'])->name('index');
      Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

      Route::get('/profile',[LoginController::class, 'profile'])->name('admin.profile');
      Route::post('/profile/update',[LoginController::class, 'profileUpdate'])->name('admin.profile.update');
      Route::get('/password',[LoginController::class, 'password'])->name('admin.password.update.form');
      Route::post('/password/update',[LoginController::class, 'update_password'])->name('admin.password.update');
  
   Route::prefix('dashboard')->group(function(){
      Route::get('/dashboard1',[HomeController::class, 'index'])->name('index');
      Route::get('/dashboard2',[HomeController::class, 'dashboard_two'])->name('dashboard_two');
      Route::get('/dashboard3',[HomeController::class, 'dashboard_three'])->name('dashboard_three');
   });

   Route::prefix('forms')->group(function(){
      Route::get('/general_form',[HomeController::class, 'general_form'])->name('general_form');
      Route::get('/advanced_com',[HomeController::class, 'advanced'])->name('advanced');
      Route::get('/validation',[HomeController::class, 'validation'])->name('validation');
      Route::get('/wizard',[HomeController::class, 'wizard'])->name('wizard');
      Route::get('/uploads',[HomeController::class, 'uploads'])->name('uploads');
      Route::get('/buttons',[HomeController::class, 'buttons'])->name('buttons');
   });

   Route::prefix('UI-elements')->group(function(){
      Route::get('/general-elements',[HomeController::class, 'general_elements'])->name('general_elements');
      Route::get('/media_gallery',[HomeController::class, 'media_gallery'])->name('media_gallery');
      Route::get('/typography',[HomeController::class, 'typography'])->name('typography');
      Route::get('/icons',[HomeController::class, 'icons'])->name('icons');
      Route::get('/glyphicons',[HomeController::class, 'glyphicons'])->name('glyphicons');
      Route::get('/widgets',[HomeController::class, 'widgets'])->name('widgets');
      Route::get('/invoice',[HomeController::class, 'invoice'])->name('invoice');
      Route::get('/inbox',[HomeController::class, 'inbox'])->name('inbox');
      Route::get('/calender',[HomeController::class, 'calender'])->name('calender');
   });

   Route::prefix('tables')->group(function(){
      Route::get('/table',[HomeController::class, 'table'])->name('table');
      Route::get('/table-dynamic',[HomeController::class, 'table_dynamic'])->name('table_dynamic');
   });

   Route::prefix('data-presentation')->group(function(){
      Route::get('/chart-js',[HomeController::class, 'chart_js'])->name('chart_js');
      Route::get('/chart-js2',[HomeController::class, 'chart_js_two'])->name('chart_js_two');
      Route::get('/moris-js',[HomeController::class, 'moris_js'])->name('moris_js');
      Route::get('/echarts',[HomeController::class, 'echarts'])->name('echarts');
      Route::get('/other_charts',[HomeController::class, 'other_charts'])->name('other_charts');
   });

   Route::get('/show-query',[HomeController::class, 'showQuery'])->name('show_query');
   Route::get('/chat/{id}', [HomeController::class, 'admin_chat'])->name('admin_chat');
   Route::post('/chat/send', [HomeController::class, 'send_message'])->name('send_message');
   Route::get('/messages', [HomeController::class, 'getUserMessages'])->name('admin.messages');

   Route::get('/contacts',[HomeController::class, 'contacts'])->name('contacts');
   Route::get('/view_profile/{id}',[HomeController::class, 'view_profile'])->name('view_profile');
   Route::post('/make-team-lead/{id}', [HomeController::class, 'makeTeamLead'])->name('makeTeamLead');
 });

Route::prefix('user')->middleware(['auth_user'])->group(function(){
   Route::post('/chat/user_send', [HomeController::class, 'user_send_message'])->name('user_send_message');
   Route::prefix('additional-pages')->group(function(){
      Route::get('/e-commerce',[HomeController::class, 'e_commerce'])->name('e_commerce'); 


      Route::get('/projects',[ProjectController::class, 'projects'])->name('projects');
      Route::get('projects/add',[ProjectController::class, 'projectsAdd'])->name('project.add');
      Route::post('/projects/store',[ProjectController::class, 'projectsStore'])->name('project.store');
      Route::get('/projects/view/{id}',[ProjectController::class, 'view_project'])->name('project.view');
      Route::delete('/delete/{id}',[ProjectController::class, 'project_delete'])->name('project.delete');
      Route::get('/project/edit/{id}',[ProjectController::class, 'projectEditForm'])->name('project.edit.form');
      Route::post('/project/update',[ProjectController::class, 'projectUpdate'])->name('project.update');


      Route::get('/project-detail',[HomeController::class, 'project_detail'])->name('project_detail');
      Route::get('/profiles',[HomeController::class, 'profiles'])->name('profiles');
      Route::get('/team/create/{id}',[HomeController::class, 'createTeam'])->name('team.create');
      Route::post('/team/store',[HomeController::class, 'storeTeam'])->name('team.store');
      Route::get('/show-team',[HomeController::class, 'showTeam'])->name('show.team');

      Route::get('/query-form',[HomeController::class, 'queryForm'])->name('query');
      Route::post('/query',[HomeController::class, 'querySubmit'])->name('query.submit');
      Route::get('/query-list',[HomeController::class, 'QueryList'])->name('query_list');
   });

   Route::prefix('Extras')->group(function(){
      Route::get('/403-error',[HomeController::class, 'error403'])->name('403_error');
      Route::get('/404-error',[HomeController::class, 'error404'])->name('404_error');
      Route::get('/500-error',[HomeController::class, 'error500'])->name('500_error');
      Route::get('/plain-page',[HomeController::class, 'plain_page'])->name('plain_page');
      Route::get('/login-page',[HomeController::class, 'login_page'])->name('login_page');
      Route::get('/pricing-tables',[HomeController::class, 'pricing_tables'])->name('pricing_tables');
   });
   
   Route::prefix('layout')->group(function(){
      Route::get('/fixed-sidebar',[HomeController::class, 'fixed_sidebar'])->name('fixed_sidebar');
      Route::get('/fixed-footer',[HomeController::class, 'fixed_footer'])->name('fixed_footer');
   });

   Route::get('/chat/{id}',[HomeController::class, 'user_chat'])->name('user_chat');
   Route::post('chat/send',[HomeController::class, 'user_send_message'])->name('user_send_message');

   Route::get('/user/profile',[LoginController::class, 'profile'])->name('user.profile');
   Route::post('/user/profile/update',[LoginController::class, 'profileUpdate'])->name('user.profile.update');
   Route::get('/user/password',[LoginController::class, 'password'])->name('user.password.update.form');
   Route::post('/user/password/update',[LoginController::class, 'update_password'])->name('user.password.update');
 
});

