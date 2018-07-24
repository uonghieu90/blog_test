<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

Route::get('/','HomeController@index')->name('home');
Route::get('/view','HomeController@view')->name('view_blog');
Route::post('/login_admin', function (Request $request) {
     $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])) {
        	return redirect()->route('admin.index');
           }    
			else{
			return Redirect::back()->withErrors(['msg', 'The Message']);
			}
			    
    
})->name('login_admin_post');
Route::get('/admin','AdminController@index')->name('admin.index');
Route::get('/blog_admin','AdminController@blog')->name('blog_admin');
Route::get('/login_admin',function(){
	$user=Auth::user();
	if(!empty($user) && $user->isAdmin()) return redirect()->route('admin.index');
	return view('admin.login');
})->name('login_admin');
Route::get('admin/blog/search','AdminController@search');
Route::get('/blog_accept','AdminController@accept')->name('accept_blog');

Route::get('/author','AuthorController@index')->name('author.index');

Route::get('/blog','AuthorController@blog')->name('blog');
Route::get('/edit_blog','AuthorController@edit')->name('edit_blog');
Route::get('/blog/search','AuthorController@search');
Route::get('/blog/delete','AuthorController@delete')->name('delete_blog');
Route::post('/blog/store','AuthorController@store')->name('store_blog');
Auth::routes();

