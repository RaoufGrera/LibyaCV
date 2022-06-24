<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

if (!defined('PATH_SEEKER')) define('PATH_SEEKER', '/profile');
if (!defined('PATH_COMPANY')) define('PATH_COMPANY', '/company-profile');

Route::get('/push','PushController@push')->name('push');
Route::post('/push','PushController@store');

Route::get('files/template_arabic_cv/download', 'DownloadController@TemplateArabicCV1');


Route::get('files/template_english_resume_with_photo/download', 'DownloadController@TemplateEnglishCV1');
Route::get('files/free_resume_with_photo_english_grey/download', 'DownloadController@TemplateEnglishCVGrey');
Route::get('files/free_cv_resume_en_blue/download', 'DownloadController@TemplateEnglishCVBlue');

Route::get('free-cv-template','DownloadController@showBlog');


Route::get('free-cv-template/arabic-resume','DownloadController@showArabicBlog');


Route::get('free-cv-template/english-resume','DownloadController@showEnglishBlog');

Route::get('price/productar', 'HomeController@getProductAr');
Route::get('price/all', 'HomeController@all');

Route::get('price/product', 'HomeController@getProduct');
Route::get('price/open', 'HomeController@getOpen');
Route::get('price/insert', 'HomeController@postInsert');
Route::get('price/company', 'HomeController@getCompany');

Route::get('customer', 'ServicesController@getCustomer');
Route::get('customer/save', 'ServicesController@saveCustomer');
Route::get('customer/save1', 'ServicesController@saveCustomer1');
Route::get('customer/change', 'ServicesController@changeCustomer');


/* florida Controller */
Route::get('price/florida', 'FloridaController@index');

Route::get('file/jobs', 'FileController@index');
Route::get('file/insert', 'FileController@postInsert');

Route::get('policy', 'MainController@emeyprivacy');

Route::get('privacy_policy', 'MainController@policy');

Route::get('donate', 'MainController@donate');
Route::get('term', 'MainController@terms');
Route::get('emeypriv', 'MainController@emeyprivacy');

Route::get('emeyprivacy', 'MainController@emeyprivacy');

Route::get('login/facebook', 'SocialiteAuth\AuthController@redirectToProvider');
Route::get('login/facebook/callback', 'SocialiteAuth\AuthController@handleProviderCallback');

Route::get('login/google', 'SocialiteAuth\AuthController@redirectToProviderGoogle');
Route::get('login/google/callback', 'SocialiteAuth\AuthController@handleProviderCallbackGoogle');


Route::post('/', 'SeekersController@search');
Route::post('/apr/univ', 'SeekersController@univ');
Route::post('/apr/faculty', 'SeekersController@faculty');
Route::post('/apr/spec', 'SeekersController@spec');
Route::post('/apr/speccompany', 'SeekersController@specCompany');

Route::post('/apr/speced', 'SeekersController@specEd');
Route::post('/apr/exp', 'SeekersController@exp');
Route::post('/apr/hobby', 'SeekersController@hobby');
Route::post('/apr/cert', 'SeekersController@cert');



Route::get('/', 'viewController@index');
Route::get('/__createWelcome', 'viewController@createTestR');
Route::get('/__createfire', 'viewController@sendFireBase');
Route::get('/__createfire1', 'viewController@sendSpecFireBase');
/* Route::get('/email','viewController@sendE55mail');*/




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['users']], function () {

//Login Routes...


Route::get('/register/verify/{confirmation_code}', 'SeekersAuth\AuthController@confirm');

Route::get('/password/email', 'SeekersAuth\PasswordController@getEmail');
Route::post('/password/email', 'SeekersAuth\PasswordController@postEmail');
Route::get('/password/reset/{token}', 'SeekersAuth\PasswordController@getReset');
Route::post('/password/reset', 'SeekersAuth\PasswordController@postReset');

Route::get('login', ['as' => 'login', 'uses' => 'SeekersAuth\AuthController@login_get']);
Route::get('/confirm', 'SeekersAuth\ConfirmController@getConfirm');
Route::post('/confirm', 'SeekersAuth\ConfirmController@postConfirm');

Route::post('/login', 'SeekersAuth\AuthController@login_post');
//Route::get('/login', 'SeekersAuth\AuthController@login_get'  );

Route::get('/register', 'SeekersAuth\AuthController@showRegister');


Route::post('/register', 'SeekersAuth\AuthController@register');

Route::post('/register/main', 'SeekersAuth\AuthController@registerEasy');


/*
|-----------------------------------
|Seekers * Seekers *Seekers
|This is for Seekers Tools
|------------------------------------
*/

//Route::group(['middleware' => ['users']], function () {


//Route::get('/exam', 'Exam\ExamController@index'); 
Route::post('/search', 'SeekersController@searchAll');

Route::get('/block/cv/{user_name}', 'Block\BlockController@showBlockCv');
Route::get('/block/company/{user_name}', 'Block\BlockController@showBlockCompany');
Route::get('/block/job/{user_name}', 'Block\BlockController@showBlockJob');

Route::get(PATH_SEEKER . '/logout', 'SeekersAuth\AuthController@getLogout');

Route::group(['middleware' => 'users'], function () {
    /*
    Route::get('/exam/{url}/show', 'Exam\ExamController@showExam');
    Route::get('/exam/{url}', 'Exam\ExamController@backExam');
    Route::post('/exam/{url}', 'Exam\ExamController@startExam');
    Route::post('/exam/{url}/result', 'Exam\ExamController@endExam');
    Route::get('/exam/{url}/result', 'Exam\ExamController@resultExam');*/
    Route::get(PATH_SEEKER, 'SeekersController@index');
    Route::get(PATH_SEEKER . '/newtest', 'SeekersController@test');
    Route::get(PATH_SEEKER . '/MarkAllSeen', 'SeekersController@allSeen');

    Route::get(PATH_SEEKER . '/job/create', 'SeekersController@createjob');
    Route::post(PATH_SEEKER . '/job/create', 'SeekersController@storejob');


    Route::get(PATH_SEEKER . '/dashboard', 'MainController@dashboard'); // عدد المشاهدات وما الي ذالك

    //Route::get('pdf/{user_name}', 'PDF\PdfController@postPdf');

    Route::get(PATH_SEEKER . '/download/print', 'PDF\PdfController@printPdf');


    Route::get(PATH_SEEKER . '/download', 'PDF\PdfController@show');
    Route::get(PATH_SEEKER . '/download/pdf', 'PDF\PdfController@download');
    Route::get(PATH_SEEKER . '/download/pdf/1', 'PDF\PdfController@pdf1');
    Route::get(PATH_SEEKER . '/download/pdf/2', 'PDF\PdfController@pdf2');


    Route::get(PATH_SEEKER . '/job-application', 'SeekersController@req');
    Route::delete(PATH_SEEKER . '/job-application/{req_id}', 'SeekersController@deleteReq');

    Route::get(PATH_SEEKER . '/profile-visibility', 'SeekersController@visibility');

    Route::get(PATH_SEEKER . '/friends', 'SeekersController@friends');

    Route::get(PATH_SEEKER . '/settings', 'SettingController@index');
    Route::patch(PATH_SEEKER . '/settings/password', 'SettingController@changePassword');
    Route::patch(PATH_SEEKER . '/settings/cv', 'SettingController@changeCV');
    Route::patch(PATH_SEEKER . '/settings/image', 'SettingController@changeImage');
    Route::patch(PATH_SEEKER . '/settings/phone', 'SettingController@changePhone');
    Route::patch(PATH_SEEKER . '/settings/delete', 'SettingController@delete');

    //SHOP
    Route::get(PATH_SEEKER . '/store', 'SeekersController@showStore');
    Route::get(PATH_SEEKER . '/store/cv', 'SeekersController@showCv');
    Route::post(PATH_SEEKER . '/store/cv', 'SeekersController@payCv');
    Route::get(PATH_SEEKER . '/store/company', 'SeekersController@showCompany');

    Route::post(PATH_SEEKER . '/store/company', 'SeekersController@payCompany');


    Route::get(PATH_SEEKER . '/store/job', 'SeekersController@showJob');

    Route::post(PATH_SEEKER . '/store/job', 'SeekersController@payJob');
    Route::get(PATH_SEEKER . '/recharge', 'SeekersController@showRecharge');

    Route::get(PATH_SEEKER . '/store/download', 'SeekersController@showDownloadCv');

    Route::get(PATH_SEEKER . '/notification', 'SeekersController@notification');


    // Add plus for specs
    Route::post('/spec/{user_name}/{spec_id}', 'Show\CvController@plusSpec');

    //Modal Edit Image Seeker
    Route::get(PATH_SEEKER . '/image', 'SeekersController@editImageSeeker');
    Route::post(PATH_SEEKER . '/image', 'SeekersController@updateImageSeeker');
    Route::delete(PATH_SEEKER . '/image', 'SeekersController@destroyImageSeeker');


    //Modal Edit goal
    Route::get(PATH_SEEKER . '/edit-info', 'SeekersController@editInfo');
    Route::patch(PATH_SEEKER . '/edit-info', 'SeekersController@updateInfo');

    //Model Update Cv
    Route::get(PATH_SEEKER . '/update-cv', 'SeekersController@editCv');
    Route::post(PATH_SEEKER . '/update-cv', 'SeekersController@updateCv');


    //Modal Edit contact
    Route::get(PATH_SEEKER . '/edit-contact', 'SeekersController@editContact');
    Route::patch(PATH_SEEKER . '/edit-contact', 'SeekersController@updateContact');


    //Modal Edit goal
    Route::get(PATH_SEEKER . '/edit-goal', 'SeekersController@editGoal');
    Route::patch(PATH_SEEKER . '/edit-goal', 'SeekersController@updateGoal');

    Route::get(PATH_SEEKER . '/goal', 'SeekersController@showGoal');






    Route::resource(PATH_SEEKER . '/services', 'ServicesController');

    // Education Controller
    Route::resource(PATH_SEEKER . '/education', 'Seekers\EducationController', ['except' => ['index', 'show']]);

    // Experience Controller
    Route::resource(PATH_SEEKER . '/experience', 'Seekers\ExperienceController', ['except' => ['index', 'show']]);

    // Language Controller
    Route::resource(PATH_SEEKER . '/language', 'Seekers\LanguageController', ['except' => ['index', 'show']]);

    // Specialtys Controller
    Route::resource(PATH_SEEKER . '/specialtys', 'Seekers\SpecialtysController', ['except' => ['index', 'show']]);

    // Skills Controller
    Route::resource(PATH_SEEKER . '/skills', 'Seekers\SkillsController', ['except' => ['index', 'show']]);

    // Training Controller
    Route::resource(PATH_SEEKER . '/training', 'Seekers\TrainingController', ['except' => ['index', 'show']]);

    // Certificate Controller
    Route::resource(PATH_SEEKER . '/certificate', 'Seekers\CertificateController', ['except' => ['index', 'show']]);

    // Hobby Controller
    Route::resource(PATH_SEEKER . '/hobby', 'Seekers\HobbyController', ['except' => ['index', 'show']]);

    // Reference Controller
    Route::resource(PATH_SEEKER . '/reference', 'Seekers\ReferenceController', ['except' => ['index', 'show']]);

    // Info Controller
    Route::resource(PATH_SEEKER . '/info', 'Seekers\InfoController', ['except' => ['index', 'show']]);

    Route::get('create-company', 'Company\CompanyController@create');
    Route::post('create-company', 'Company\CompanyController@store');






    /*
|-----------------------------------
|Company * Company * Company
|This is Privet pages For Company
|------------------------------------
*/
    // Search Company s
    //Route::get('/company/search', 'Search\CompanyController@showCompany');

    // Route::get('/{user_name}', 'Show\CompanyController@Company');
    Route::post('/c/{company_name}', 'Show\CompanyController@update');

    Route::get(PATH_COMPANY . '/services/{user}/create', 'Company\CompanyController@indexServices');
    Route::PATCH(PATH_COMPANY . '/services/{user}', 'Company\CompanyController@storeServices');

    Route::get(PATH_COMPANY . '/map/{user}/create', 'Company\CompanyController@editMap');
    Route::PATCH(PATH_COMPANY . '/map/{user}', 'Company\CompanyController@storeMap');


    Route::get(PATH_COMPANY . '/specialty/{user}/create', 'Company\SpecialtysController@create');
    Route::post(PATH_COMPANY . '/specialty/{user}', 'Company\SpecialtysController@store');
    Route::delete(PATH_COMPANY . '/specialty/{user}/{id}', 'Company\SpecialtysController@destroy');

    Route::resource(PATH_COMPANY . '/specialtys', 'Company\SpecialtysController', [
        'except' => [
            'index', 'show', 'create', 'store'
        ],
        'parameters' => [
            'specialtys' => 'user'
        ]
    ]);

    /*Route::get(PATH_COMPANY.'/users/{user}', 'Company\CompanyController@listUsers');
    Route::DELETE(PATH_COMPANY.'/users/{user}/{id}/destroy', 'Company\CompanyController@destroyUser');
    Route::get(PATH_COMPANY.'/users/{user}/create', 'Company\CompanyController@addUser');
    Route::get(PATH_COMPANY.'/users/{user}/{id}/edit', 'Company\CompanyController@editUser');
    Route::POST(PATH_COMPANY.'/users/{user}', 'Company\CompanyController@storeUser');
*/


    Route::get(PATH_COMPANY . '/{user}', 'Company\CompanyController@showing');

    //Modal Edit Info Company
    Route::get(PATH_COMPANY . '/edit-info/{user}', 'Company\CompanyController@editInfoCompany');
    Route::patch(PATH_COMPANY . '/edit-info/{user}', 'Company\CompanyController@updateInfoCompany');

    //Modal Edit Info Company
    Route::get(PATH_COMPANY . '/edit-description/{user}', 'Company\CompanyController@editDescriptionCompany');
    Route::patch(PATH_COMPANY . '/edit-description/{user}', 'Company\CompanyController@updateDescriptionCompany');

    //Modal Edit Map Company
    Route::get(PATH_COMPANY . '/edit-map/{user}', 'Company\CompanyController@editMapCompany');
    Route::patch(PATH_COMPANY . '/edit-map/{user}', 'Company\CompanyController@updateMapCompany');

    //Modal Edit Image Company
    Route::get(PATH_COMPANY . '/edit-image/{user}', 'Company\CompanyController@editImageCompany');
    Route::patch(PATH_COMPANY . '/edit-image/{user}', 'Company\CompanyController@updateImageCompany');
    Route::delete(PATH_COMPANY . '/delete-image/{user}', 'Company\CompanyController@destroyImageCompany');

    Route::get(PATH_COMPANY . '/edit-cover/{user}', 'Company\CompanyController@editCoverCompany');
    Route::patch(PATH_COMPANY . '/edit-cover/{user}', 'Company\CompanyController@updateCoverCompany');
    Route::delete(PATH_COMPANY . '/delete-cover/{user}', 'Company\CompanyController@destroyCoverCompany');

    //Post Job
    Route::resource(PATH_COMPANY . '/{user}/job', 'Company\PostJobController', ['except' => ['show']]);


    Route::get('/job/domain', 'Search\JobController@domainJob');

    Route::patch('/job/{user}', 'Show\JobController@update');
    Route::delete('/job/{user}', 'Show\JobController@destroy');


    Route::get(PATH_COMPANY . '/{user}/job-application', 'Company\JobApplicationController@index');
    Route::get(PATH_COMPANY . '/{user}/job-application/{jobid}', 'Company\JobApplicationController@show');

    Route::patch(PATH_COMPANY . '/{user}/job-application/{jobid}/{req_id}/{seeker_id}', 'Company\JobApplicationController@addAccept');
    Route::delete(PATH_COMPANY . '/{user}/job-application/{jobid}/{req_id}/{seeker_id}/delete', 'Company\JobApplicationController@removeSeeker');

    Route::get(PATH_COMPANY . '/{user}/job-appilication/{jobid}', 'Company\JobApplicationController@showAjax');

    // Search Company s







    Route::get('/send/job/{user_name}', 'Send\SendController@showSendJob');
    Route::post('/send/job/{user_name}', 'Block\BlockController@postSendJob');
    // Search CVs





    Route::post('/block/cv/{user_name}', 'Block\BlockController@postBlockCv');

    Route::post('/block/company/{user_name}', 'Block\BlockController@postBlockCompany');

    Route::post('/block/job/{user_name}', 'Block\BlockController@postBlockJob');

    Route::get('/block/course/{user_name}', 'Block\BlockController@showBlockCourse');
    Route::post('/block/course/{user_name}', 'Block\BlockController@postBlockCourse');
    //Route::get('/pdf/{user_name}','PDF\PdfController@showPdf');

    //Route::post('pdf/{user_name}', 'PDF\PdfController@postPdf');
    Route::get('pdf/{user_name}', 'PDF\PdfController@postPdf');
    Route::get('pdff/{user_name}', 'PDF\PdfController@getCv');
    Route::patch('/user/{user_name}', 'Show\CvController@firends');
    Route::delete('/user/{user_name}', 'Show\CvController@unfirends');
});

Route::get('/user/{user_name}', 'Show\CvController@index');



Route::get('/spec/{user_name}/{spec_id}', 'Show\CvController@showSpec');

/*
|-----------------------------------
|Grants Grants Everyone Anyone
|This is Public pages Search CV
|------------------------------------
*/

Route::get('/cv/search/', 'Search\CvController@showCv');
Route::get('/cv/saerch', 'Search\CvController@showCvAjax');


Route::get('/services/search/', 'Search\ServicesController@showServices');
Route::get('/services/saerch', 'Search\ServicesController@showServicesAjax');
Route::get('/services/{company_name}', 'Show\ServicesController@index');


Route::get('/job/search', 'Search\JobController@showJob');
//Route::get('/', 'Search\JobController@showJob');

Route::get('/job/saerch', 'Search\JobController@showJobAjax');

Route::get('/job/{user}/{name}', 'Show\JobController@index');
Route::get('/job/{user}/{name?}', 'Show\JobController@index');


Route::get('/company/search', 'Search\CompanyController@showCompany');
Route::get('/company/saerch', 'Search\CompanyController@showCompanyAjax');
Route::get('/c/{company_name}', 'Show\CompanyController@index');



Route::get('/administrator/login', 'Admins\AuthController@showLoginForm_2');
Route::get('/admin/login', 'Admins\AuthController@showLoginForm_2');
Route::get('/administration/login', 'Admins\AuthController@showLoginForm');
/*Route::get('/administrator/login', 'Admins\AuthController@showLoginForm');*/
Route::get('/__administrator_ya_3ayil/login', 'Admins\AuthController@showLoginForm');
Route::post('/administrator/login', 'Admins\AuthController@login_post');
Route::group(['middleware' =>  'admins'], function () {
    Route::get('/administrator/register', 'Admins\AuthController@showRegistrationForm');

    Route::get('/administrator/logout', 'Admins\AuthController@getLogout');
    Route::get('/administrator/dashboard', 'Admins\DashboardController@showDashBoard');

    /* seekers admins*/
    Route::get('/administrator/seeker', 'Admins\SeekersController@showAllSeeker');
    Route::get('/administrator/seeker/{user}', 'Admins\SeekersController@showSeeker');

    Route::patch('/administrator/seeker/{user}/block', 'Admins\SeekersController@blockAdmin');
    Route::patch('/administrator/seeker/{user}/confirmed', 'Admins\SeekersController@confirmed');
    /* Sales */
    Route::get('/administrator/sales-seeker', 'Admins\SalesController@showSalesSeeker');



    Route::get('/administrator/exam', 'Admins\MangeExamController@showAllExam');
    Route::get('/administrator/exam/create', 'Admins\MangeExamController@createExam');
    Route::post('/administrator/exam/create', 'Admins\MangeExamController@storeExam');
    Route::get('/administrator/exam/{exam_id}/edit', 'Admins\MangeExamController@editExam');
    Route::post('/administrator/exam/{exam_id}/edit', 'Admins\MangeExamController@updateExam');
    Route::get('/administrator/exam/{exam_id}/mange', 'Admins\MangeExamController@manageExam');
    Route::get('/administrator/exam/{exam_id}/mange/create', 'Admins\MangeExamController@createQuestion');
    Route::post('/administrator/exam/{exam_id}/mange/create', 'Admins\MangeExamController@storeQuestion');
    Route::get('/administrator/exam/{exam_id}/mange/{question_id}/edit', 'Admins\MangeExamController@editQuestion');
    Route::post('/administrator/exam/{exam_id}/mange/{question_id}/edit', 'Admins\MangeExamController@updateQuestion');
    Route::get('/administrator/redis/create', 'Admins\RedisController@create');
    Route::get('/administrator/redis/createcompany', 'Admins\RedisController@createCompany');
});
