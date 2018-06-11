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

Route::get('/log', function (){

    return view('pages.login');

});

Route::get('/','IndexController@index')->name('index');
Route::post('/login','IndexController@login');
Route::get('/showLog','IndexController@showLogin');
Route::post('/registerUser','IndexController@store');
Route::get('/author', function (){
    return view('pages.author');
});


Route::middleware(['protect'])->group(function () {

    Route::get('/home','HomeController@index')->name('home');
    Route::get('/profil','ProfilController@index')->name('profil');
    Route::post('/postImg','ImgController@store');
    Route::get('/logout','IndexController@logout');
    Route::post('/edit','ProfilController@edit');
    Route::post('/editProfilImg','ImgController@editProfilImg');
    Route::post('/postArticle','ArticleController@store');
    Route::get('/home/like','AjaxController@like');
    Route::get('/home/deletePost','AjaxController@delPost');
    Route::get('/profil/deletePost','AjaxController@delPost');
    Route::get('/home/deleteComment','CommentController@delComm');
    Route::get('/profil/deleteComment','CommentController@delComm');
    Route::get('/profil/like','AjaxController@like');
    Route::get('/home/viewLikes','AjaxController@viewLikes');
    Route::get('/profil/viewLikes','AjaxController@viewLikes');
    Route::get('home/insertComment','CommentController@store');
    Route::get('/home/showLikers','CommentController@show');
    Route::get('/profil/showLikers','CommentController@show');
    Route::get('profil/insertComment','CommentController@store');
    Route::post('/home/subSurvey','AjaxController@survey');
    Route::get('/home/getSuggestion','AjaxController@getSuggestion');
    Route::get('/profil/getSuggestion','AjaxController@getSuggestion');
    Route::get('/home/viewProfil','AjaxController@viewProfil');
    Route::get('/profil/viewProfil','AjaxController@viewProfil');
    Route::get('/profil/pag','AjaxController@pagination');
    Route::get('home/deleteNotification','NotificationController@deleteNoty');
});

Route::middleware(['adminProtect'])->group(function () {
Route::prefix('admin')->group(function () {
    Route::get('/','AdminController@index')->name('admin');
    Route::post('/delete/{id}','AdminController@delete');
    Route::post('/postImg','ImgController@store');
    Route::get('/edit','AdminController@edit');
    Route::post('edit/update/{id}','AdminController@editUser');
    Route::get('/post','AdminController@post');
    Route::get('/post/show','AdminController@showPost');
    Route::get('/post/delete','AdminController@deletePost');
    Route::get('/comment','AdminController@comment');
    Route::get('/comment/show','AdminController@showComment');
    Route::get('/comment/delete','AdminController@deleteComment');
    Route::get('/comment/updateComment','AdminController@updateComment');
    Route::get('/activities','AdminController@activities');
    Route::get('/activities/show','AdminController@showActivities');
    Route::get('/survey','AdminController@survey');
    Route::get('/survey/show','AdminController@showSurvey');
    Route::get('/survey/update','AdminController@updateSurvey');
    Route::post('/survey/insert','AdminController@insertSurvey');
    Route::post('/survey/delete','AdminController@deleteSurvey');
    Route::get('/adv','AdminController@adv');
    Route::post('/adv/insert','AdminController@insertAdv');
    Route::post('/adv/update','AdminController@updateAdv');
    Route::post('/adv/update/fin','AdminController@updateAdvFin');
    Route::post('/adv/delete','AdminController@deleteAdv');
    Route::post('/register','AdminController@registerUser');
    Route::get('/logout','IndexController@logout');
    Route::get('comment/insertComment','CommentController@store');
    Route::get('/comment/show/post','AdminController@showPostCom');
    Route::get('/post/showUpdate','AdminController@showUpForm');
    Route::post('/updatePostTitle','AdminController@updatePost');
    Route::get('/docs', function (){
        return response()->download(public_path('Docs.pdf'));
    });
});
});