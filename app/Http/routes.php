<?php

use App\Post;
use App\User;

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

Route::get('/', function () {
    return view('welcome');
});
//
//Route::get('/about', function () {
//    return 'Hi about page';
//});
//
//Route::get('/contact', function () {
//    return 'Hi I am contact';
//});
//
//Route::get('/post/{id}/{name}', function ($id, $name) {
//    return "This is post number ". $id. " ". $name;
//});
//
//Route::get('admin/posts/example', array('as'=>'admin.home' ,function () {
//    $url = route('admin.home');
//
//    return "this url is ". $url;
//}));

//Route::get('/post', 'PostsController@index');

//Route::get('/', function () {
//    return 'hello';
//});
//
//Route::resource('posts', 'PostsController');
//
//Route::get('contact', 'PostsController@contact');
//
//Route::get('post/{id}/{name}/{password}', 'PostsController@show_post');

/*
|--------------------------------------------------------------------------
| Application Raw SQL Queries
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::get('/insert', function(){
//   DB::insert('insert into posts(title, content) values(?, ?)', ['Laravel is awesome with Edwin', 'Laravel is the best that has happend to PHP, PERIOD']);
//});


//Route::get('/read', function() {
//   $results = DB::select('select * from posts where id = ?', [1]);
//
//   foreach ($results as $post) {
//       return $post->title;
//   }
//});


//Route::get('/update', function() {
//   $updated = DB::update('update posts set title = "Update title" where id = ?', [1]);
//});

//Route::get('/delete', function() {
//    $deleted = DB::delete('delete from posts where id = ?', [1]);
//});


/*
|--------------------------------------------------------------------------
| ELOQUENT
|--------------------------------------------------------------------------
*/

//Route::get('/read', function() {
//    $posts = Post::all();
//
//    foreach ($posts as $post) {
//        return $post->title;
//    }
//});
//
//Route::get('/find', function() {
//    $post = Post::find(2);
//
//    return $post->title;
//});


//Route::get('/findwhere', function() {
//    $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();
//
//    return $posts;
//});

//Route::get('/findmore', function() {
//   $posts = Post::findOrFail(1);
//
//   return $posts;
//
//
//});

Route::get('/basicinsert', function() {
   $post = new Post;

   $post->title = 'New Eloquent title insert';
   $post->content = 'New Content';

   $post->save();
});
//
//Route::get('/basicupdate', function() {
//    $post = Post::find(2) ;
//
//    $post->title = 'New Eloquent title insert 2';
//    $post->content = 'New Content 2';
//
//    $post->save();
//});

Route::get('/create', function() {
   Post::create(['title'=>'the create method', 'content'=>'WOW I\'am learningwith Edwin Diaz']);
});

Route::get('update', function() {
   Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'I like laravel']);
});

Route::get('/delete', function() {
   $post = Post::find(2);

   $post->delete();
});

//Route::get('/destroy', function() {
//    Post::destroy([4, 5]);
//
////    Post::where('is_admin', 0)->delete();
//});

Route::get('/softdelete', function() {
    Post::find(2)->delete();
});

Route::get('/readsoftdelete', function() {
//    $post = Post::find(1);
//
//    return $post;

//    $post = Post::withTrashed()->where('id', 1)->get();
//
//    return $post;

    $post = Post::onlyTrashed()->where('is_admin', 0)->get();

    return $post;

});

Route::get('/restore', function () {
    Post::withTrashed()->where('is_admin', 0)->restore();
});


Route::get('/forcedelete', function () {
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});

/*
|--------------------------------------------------------------------------
| ELOQUENT Relationships
|--------------------------------------------------------------------------
*/

Route::get('/user/{id}/post', function($id) {
    return User::find($id)->post->title;

});

Route::get('/post/{id}/user', function($id) {
   return Post::find($id)->user->name;
});

Route::get('/posts', function() {
    $user = User::find(1);

    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

Route::get('/user/{id}/role', function ($id) {
    $user = User::find($id);

    foreach ($user->roles as $role) {
        return $role->name;
    }
});

Route::get('user/pivot', function() {
    $user = User::find(1);

    foreach ($user->roles as $role) {
        return $role->pivot;
    }

});


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

Route::group(['middleware' => ['web']], function () {
    //
});
