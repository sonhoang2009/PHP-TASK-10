<?php

use Illuminate\Support\Facades\Route;

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

use App\Models\Posts;

Route::get('home','HomeController@showWelcome');
Route::get('about','AboutController@showDetails');

Route::get('profile/{name}','ProfileController@showProfile');

Route::get('/', function () {
    return view('welcome');
});

//Route::get('about',function (){
//    return 'About Content';
//});

Route::get('about/directions',function (){
    return 'Direction go here';
});

Route::any('submit-form',function (){
    return 'Process Form';
});

Route::get('about/{theSubject}','AboutController@showSubject');

//Route::get('about/{theSubject}',function ($theSubject){
//    return $theSubject. ' content here';
//});

Route::get('about/{theArt}/{thePrice}',function ($theArt,$thePrice){
    return "The product : $theArt and have price is $thePrice ";
});

Route::get('where',function (){
   return Redirect::to('about/directions');
});

Route::get('/insert',function (){
   DB::insert('insert into posts(title,body)values(?,?)',['PHP with Laravel','Laravel is the best framewok ! ']);
   return 'Done';
});

Route::get('/read',function (){
    $result = DB::select('select * from posts where id = ?',[1]);
    foreach ($result as $post)
    {
        return $post->body;
    }
});

Route::get('update',function (){
    $updated = DB::update('update posts set title = "New Title hihi" where id > ?',[1]);
    return $updated;
});

Route::get('delete',function (){
    $deleted = DB::delete('delete from posts where id = ? ',[3]);
    return $deleted;
});

Route::get('readAll',function (){
   $posts = Posts::all();
   foreach ($posts as $p)
   {
       echo $p->title . "". $p->body;
       echo "<br>";
   }
});

//Route::get('findId',function (){
//    $posts = Posts::where('id',2)
//    ->orderBy('id','desc')
//        ->take(1)
//    ->get();
//    foreach ($posts as $p)
//    {
//        echo $p->title . "". $p->body;
//        echo "<br>";
//    }
//});
Route::get('findId',function (){
    $posts = Posts::where('id','>=',1)
        ->where('title','like','%New%')
        ->where('body','like','%new%')
        ->take(10)
        ->get();
    foreach ($posts as $p)
    {
        echo $p->title . "";
        echo "<br>";
    }
});

Route::get('insertORM',function (){
    $p = new Posts();
    $p -> title = 'insertORM';
    $p -> body = 'INSERT done done ORM';
    $p -> save();
});

Route::get('updateORM',function (){
    $p =  Posts::where('id',5)->first();
    $p -> title = 'updated ORM';
    $p -> body = 'updated done done ORM';
    $p -> save();

});

Route::get('deletedORM',function (){
    Posts::where('id','>=',14)
        ->delete();
});

Route::get('destroyORM',function (){
    Posts::destroy([7,11]);

});
