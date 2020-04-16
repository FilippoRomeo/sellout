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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', 'UserController@index');

Auth::routes();

Route::get('/home', 'UserController@index');

//display my ads
Route::get('/myAds', 'UserController@myAds') -> middleware('auth');

//fetch location ---> Navidation fuzzy search
Route::post('UserController/fetch', 'UserController@fetch')->name('searchlocation.fetch');

//fetch main categories ---> Navigation bar dropdown 
Route::post('UserController/retrieve', 'UserController@retrieve')->name('categories.retrieve');

//categories menu link to corresponding result 
Route::get('post-classified-ads', 'UserController@postad');

//display categories view 
Route::get('/post-classified-ads/{maincategory}/{id}', 'UserController@categories') -> middleware('auth');

//url to publish post 
Route::post('/addPost', 'UserController@addPost') -> middleware('auth');

//load all advertisement
Route::get('UserController/getAds', 'UserController@getAds')->name('categories.ads');

//filter place by category
Route::get('/viewAds/{mainCategory}/{id}', 'UserController@viewAds');

//search ads by product name
Route::post('/product/search', 'UserController@searchProduct');

//search ads by place and category
Route::post('/search/advertisement', 'UserController@searchAdvertisement');

//show an advertisement
Route::get('product/view/{id}', 'UserController@viewProduct');

//show edit form
Route::get('product/edit/{id}', 'UserController@edit') -> middleware('auth');

//show edit form
Route::patch('product/edit/{id}', 'UserController@update') -> middleware('auth');

//delete post
Route::delete('product/delete/{id}', 'UserController@delete')-> middleware('auth');

