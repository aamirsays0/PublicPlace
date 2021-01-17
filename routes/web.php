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
use App\Events\Myevent;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//resources
//Route::get("test",function(){ return "eye to eye";});
Route::resource('posts', 'PostController')->middleware('auth');
Route::resource('profiles', 'ProfileController')->middleware('auth');
//Route::get('profiles/$id', 'ProfileController@show')->middleware('auth');
Route::resource('education', 'EducationController')->middleware('auth');
Route::resource('interest', 'InterestController')->middleware('auth');
Route::resource('work', 'WorkController')->middleware('auth');

// friends profile
Route::get('/viewprofile/{id}', 'ProfileController@viewFriendsProfile')->name('view.friends.profile');
//frirend or user education
Route::get('/vieweducation/{id}', 'EducationController@vieweducation')->name('view.friends.education');

//comment in post
Route::post('posts/comment/{id}',
 ['as' => 'posts.comment', 'uses' => 'PostController@postcomment']);
//react in post
Route::post('react','PostController@react');
 Route::get('search',
 ['as' => 'search', 'uses' => 'Searchcontroller@index']);
//  Route::get('chat',
//  ['as' => 'chat', 'uses' => 'ChatController@index']);
 Route::post('addfriend/{id}', 'FriendController@add');
 Route::post('confirmfriend/{id}', 'FriendController@confirm'); 
 Route::post('deletefriend/{id}', 'FriendController@deleteFriend'); 

 Route::get('chat', 'ChatController@index');
 Route::post('sendchat', 'ChatController@sendMessage');
 Route::post('chathistory', 'ChatController@chatHistory');
 Route::get('friends/{id}', 'FriendController@showFriends'); 
 Route::delete('/friend/unfriend_it/{friend_id}', 'FriendController@unfriend')->name('friend.unfriend');
 Route::get('/activity', 'ActivityController@index')->name('activity');
 Route::resource('notification', 'NotificationController')->middleware('auth');
 Route::get('images/{id}', 'PostController@images'); 
 Route::get('change-password', 'ChangePasswordController@index');
 Route::post('change-password', 'ChangePasswordController@store')->name('change.password');
 Route::delete('deleteComment/{comment}', 'PostController@deleteComment')->name('delete.comment');
 Route::delete('deleteEducation/{id}', 'EducationController@deleteEducation')->name('delete.education');
 Route::delete('deleteWork/{id}', 'WorkController@deleteWork')->name('delete.work');
 Route::get('/nearby', 'HomeController@nearby')->name('people.nearby');

