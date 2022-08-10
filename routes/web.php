<?php

use App\Http\Controllers\Darshik;
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

Route::get('/', [Darshik::class,'index']);
Route::get('/shop', [Darshik::class,'shop']);
Route::get('/detail/{id?}', [Darshik::class,'detail']);
Route::get('/cart', [Darshik::class,'cart']);
Route::get('/checkout', [Darshik::class,'checkout']);
Route::get('/contact', [Darshik::class,'contact']);

route::get('/signup',[Darshik::class,'signup']);
route::post('/addUser',[Darshik::class,'addUser']);
route::post('/logincheck',[Darshik::class,'logincheck']);

route::get('/Addproductform',[Darshik::class,'Productform']);
route::get('/ProductsTable',[Darshik::class,'ProductTable']);
route::get('/UsersTable',[Darshik::class,'UsersTable']);
route::post('/AddProduct',[Darshik::class,'AddProduct']);

route::get('/DeleteProduct/{id}',[Darshik::class,'DeleteProduct']);
route::get('/logout',[Darshik::class,'logout']);
route::post('/addtocart',[Darshik::class,'addtocart']);



route::get('/login',function(){
    return view('login');
});


