<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register2', 'Api\Auth\SeekerAuthController@register2');


Route::post('register', 'Api\Auth\SeekerAuthController@register');
Route::post('login', 'Api\Auth\SeekerAuthController@login');
Route::post('refresh', 'Api\Auth\SeekerAuthController@refresh');

//Route::get('/job/search', 'Search\JobController@showJob');

Route::get('test', 'Api\PostController@getMessage');
/*
Route::get('test1', function (Request $request) {
    dd("test ok");
});*/
Route::post('update/price/__update_!_price_!', 'Api\PostController@getMessage');
/*

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd("salut");
});*/

Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');



//Route::get('profile', 'SeekersController@index');
/*
 Route::get('user',function(){
    dd("salut");
});
*/

Route::get('we', 'Api\HomeController@index');
Route::get('price', 'Api\HomeController@allPriceProduct');
Route::get('refresh', 'Api\HomeController@refresh');

Route::get('category', 'Api\HomeController@category');
Route::get('version', 'Api\HomeController@getVersion');


Route::get('search/cv', 'Api\Search\CvController@searchCV');

Route::middleware('auth:api')->group(function () {
    Route::get('show/seeker', 'Api\Show\ShowController@showCvAuth');

    Route::get('settingnote', 'Api\PostController@getDomainFireBaseSeeker');

    Route::post('settingnote', 'Api\PostController@postDomainFireBaseSeeker');

    Route::post('logout', 'Api\Auth\SeekerAuthController@logout');

    Route::get('editinfo', 'Api\PostController@editInfo');
    Route::post('editinfo', 'Api\PostController@updateInfo');
    Route::post('edit_image', 'Api\PostController@updateImageSeeker');

    Route::get('company', 'Api\Company\CompanyController@index');
    Route::get('create_company', 'Api\Company\CompanyController@createCompany');
    Route::post('create_company', 'Api\Company\CompanyController@postCompany');
    Route::get('company/edit_info', 'Api\Company\CompanyController@editInfoCompany');
    Route::post('company/edit_info', 'Api\Company\CompanyController@updateInfoCompany');
    Route::post('company/edit_image', 'Api\Company\CompanyController@updateImageCompany');
    Route::get('company/edit_image', 'Api\Company\CompanyController@getImageCompany');
    Route::get('edit/map/{user}', 'Api\Company\CompanyController@editMapCompany');
    Route::post('edit/map/{user}', 'Api\Company\CompanyController@updateMapCompany');


    Route::resource('seeker/services', 'Api\Seeker\ServicesController', ['except' => ['show']]);
    Route::get('search/services', 'Api\Search\ServicesSearchController@searchServices');

    Route::get('services/{user}', 'Api\Search\ServicesSearchController@showJob');

    Route::resource('company/job', 'Api\Company\PostJobController', ['except' => ['show']]);

    Route::get('company/{user}/job-application/{jobid}', 'Api\Search\JobApplicationController@show');

    //cv
    /*    Route::get('education','Api\PostController@showEducation');
    Route::post('education','Api\PostController@postEducation');

    Route::get('education/{id}/edit','Api\PostController@editEducation');
*/
    Route::resource('education', 'Api\Seeker\EducationController', ['except' => ['show']]);
    Route::resource('experience', 'Api\Seeker\ExperienceController',  ['except' => ['show']]);

    // Language Controller
    Route::resource('language', 'Api\Seeker\LanguageController', ['except' => ['show']]);

    // Specialtys Controller
    Route::resource('specialty', 'Api\Seeker\SpecialtyController', ['except' => ['show']]);

    // Skills Controller
    Route::resource('skills', 'Api\Seeker\SkillsController', ['except' => ['show']]);

    // Training Controller
    Route::resource('training', 'Api\Seeker\TrainingController', ['except' => ['show']]);

    // Certificate Controller
    Route::resource('certificate', 'Api\Seeker\CertificateController', ['except' => ['show']]);

    // Hobby Controller
    Route::resource('hobby', 'Api\Seeker\HobbyController', ['except' => ['show']]);

    // Reference Controller
    // Route::resource('reference', 'Api\Seeker\ReferenceController', ['except' => [ 'show']]);

    // Info Controller
    Route::resource('info', 'Api\Seeker\InfoController', ['except' => ['show']]);

    Route::get('posts', 'Api\PostController@index');
    Route::get('we', 'Api\PostController@we');
    Route::get('edit_refresh', 'Api\PostController@editRefresh');
    Route::post('edit_refresh', 'Api\PostController@storeRefresh');

    Route::get('search/job', 'Api\Search\JobSearchController@searchJob');
    Route::get('search/company', 'Api\Search\CompanyController@showCompany');
    Route::get('job/{user}', 'Api\Search\JobSearchController@showJob');
    Route::get('c/{user}', 'Api\Search\CompanyController@index');
    Route::get('c/{user}/add', 'Api\Search\CompanyController@addFollow');
    Route::get('c/{user}/remove', 'Api\Search\CompanyController@removeFollow');
    Route::get('search/showparajob', 'Api\Search\JobSearchController@showParaSearchJob');

    Route::get('profile', 'Api\Show\ShowController@index');
    Route::get('show/seeker/{seeker_id}', 'Api\Show\ShowController@showCv');



    Route::get('setting', 'Api\PostController@getSetting');
    Route::get('notifications', 'Api\PostController@getNote');
    Route::get('myappjob', 'Api\Search\JobSearchController@myJob');


    Route::post('setting', 'Api\PostController@storeSetting');
    Route::post('setting/password', 'Api\PostController@changePassword');



    Route::post('__fire/addtoken', 'Api\PostController@addToken');



    Route::post('postjob/{id}', 'Api\Search\JobSearchController@postJob');
    Route::post('deletejob/{id}', 'Api\Search\JobSearchController@deleteJob');



    Route::post('accept/job/{jobid}/{seeker_id}', 'Api\Search\JobApplicationController@addAccept');
    Route::post('remove/job/{jobid}/{seeker_id}', 'Api\Search\JobApplicationController@removeSeeker');
});
