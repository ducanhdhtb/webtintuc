<?php
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	//Admin/theloai/them
	Route::group(['prefix'=>'theloai'],function(){
		route::get('danhsach','TheLoaiController@getDanhSach');
		// Sửa thể loại
		route::get('sua/{id}','TheLoaiController@getSua');
		route::post('sua/{id}','TheLoaiController@postSua');

		route::get('them','TheLoaiController@getThem');
		route::post('them','TheLoaiController@postThem');

		route::get('xoa/{id}','TheLoaiController@getXoa');
		

	});
	//Admin/loaitin/them
	Route::group(['prefix'=>'loaitin'],function(){
		route::get('danhsach','LoaiTinController@getDanhSach');
		// Sửa thể loại
		route::get('sua/{id}','LoaiTinController@getSua');
		route::post('sua/{id}','LoaitinController@postSua');

		route::get('them','LoaiTinController@getThem');
		route::post('them','LoaiTinController@postThem');

		route::get('xoa/{id}','LoaiTinController@getXoa');

	});
		//Admin/tintuc/them
	Route::group(['prefix'=>'tintuc'],function(){
		route::get('danhsach','TinTucController@getDanhSach');
		//SỦa
		route::get('sua/{id}','TinTucController@getSua');
		route::post('sua/{id}','TinTucController@postSua');
		route::get('them','TinTucController@getThem');
		route::post('them','TinTucController@postThem');

		route::get('xoa/{id}','TinTucController@getXoa');

	});
	//Admin/user/them
			//Admin/tintuc/them
	Route::group(['prefix'=>'user'],function(){
		route::get('danhsach','UserController@getDanhSach');
		route::get('sua/{id}','UserController@getSua');
		route::post('sua/{id}','UserController@postSua');
		route::get('them','UserController@getThem');
		route::post('them','UserController@postThem');
		route::get('xoa/{id}','UserController@getXoa');

	});
	//slide
	Route::group(['prefix'=>'slide'],function(){
		route::get('danhsach','SlideController@getDanhSach');
		route::get('sua/{id}','SlideController@getSua');
		route::post('sua/{id}','SlideController@postSua');
		route::get('them','SlideController@getThem');
		route::post('them','SlideController@postThem');
		route::get('xoa/{id}','SlideController@getXoa');

	});

	//Route danh rieng cho ajax
	Route::group(['prefix'=>'ajax'],function(){
		route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	
		});

});

//---------------------------------giao dien
Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html','PagesController@tintuc');

Route::get('dangnhap','PagesController@getDangNhap');
Route::post('dangnhap','PagesController@postDangNhap');
Route::get('dangxuat','PagesController@getDangXuat');
Route::get('dangki','PagesController@getDangki');
Route::post('dangki','PagesController@postDangki');
Route::get('nguoidung','PagesController@getNguoidung');
Route::post('nguoidung','PagesController@postNguoidung');
//Comment
Route::post('comment/{id}','CommentController@postComment');
//quan ly nguoi dung
Route::post('timkiem','PagesController@timkiem');