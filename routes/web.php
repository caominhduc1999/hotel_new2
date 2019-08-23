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

Route::get('/', function () {
    return view('welcome');
});


Route::get('index','PageController@index')->name('index');
Route::get('contact','PageController@contact');
Route::get('gallery','PageController@gallery');
Route::get('introduction','PageController@introduction');
Route::get('rooms_tariff','PageController@rooms_tariff');
Route::get('rooms_tariff/loaiphong/{id}','PageController@rooms_tariff_loaiphong');
Route::get('room_details/{id}','PageController@room_details');
Route::get('book/{id}','PageController@book');

Route::post('comment','CommentController@postComment');


Route::group(['prefix' =>  'customer','middleware'=>'customerLogin'],function (){
    Route::get('detail/{id}','PageController@getDetail');
    Route::post('detail/{id}','PageController@postDetail');

    Route::get('bill/{id}','PageController@getBill');
    Route::post('bill/{id}','PageController@postBill');

    Route::get('bill/edit/{id}','PageController@getEditBill');
    Route::post('bill/edit/{id}','PageController@postEditBill');

    Route::get('bill/delete/{id}','PageController@getDeleteBill');
});

Route::get('customer/dangnhap','PageController@getLogin');
Route::post('customer/dangnhap','PageController@postLogin');
Route::get('customer/dangxuat','PageController@getLogout');
Route::get('customer/register','PageController@getRegister');
Route::post('customer/register','PageController@postRegister');

Route::post('customer/password/email','Auth\KhachHangForgotPasswordController@sendResetLinkEmail')->name('send.to.email');
Route::get('customer/password/reset','Auth\KhachHangForgotPasswordController@showLinkRequestForm');
Route::post('customer/password/reset','Auth\KhachHangResetPasswordController@reset');
Route::get('customer/password/reset/{token}','Auth\KhachHangResetPasswordController@showResetForm')->name('password.reset.token');


Route::post('datphong','DatPhongController@postDatPhong')->name('datphongluon');


Route::get('admin/dangnhap','AdminController@getLogin');
Route::post('admin/dangnhap','AdminController@postLogin');
Route::get('admin/dangxuat','AdminController@getLogout');


Route::group(['prefix' =>'admin','middleware'=>'adminLogin'],function (){

    Route::group(['prefix'=>'danhsachadmin',], function (){
        Route::get('danhsach', 'AdminController@getDanhSach');

        Route::get('them','AdminController@getThem');
        Route::post('them', 'AdminController@postThem');

        Route::get('sua/{id}','AdminController@getSua');
        Route::post('sua/{id}','AdminController@postSua');

        Route::get('xoa/{id}','AdminController@getXoa');

        Route::get('timkiem','AdminController@getSearch');
    });

    Route::group(['prefix'=>'khachhang'], function (){
        Route::get('danhsach', 'KhachHangController@getDanhSach');

        Route::get('them','KhachHangController@getThem');
        Route::post('them', 'KhachHangController@postThem');

        Route::get('sua/{id}','KhachHangController@getSua');
        Route::post('sua/{id}','KhachHangController@postSua');

        Route::get('xoa/{id}','KhachHangController@getXoa');

        Route::get('timkiem','KhachHangController@getSearch');

    });

    Route::group(['prefix'=>'nhanvien'], function (){
        Route::get('danhsach', 'NhanVienController@getDanhSach');

        Route::get('them','NhanVienController@getThem');
        Route::post('them', 'NhanVienController@postThem');

        Route::get('sua/{id}','NhanVienController@getSua');
        Route::post('sua/{id}','NhanVienController@postSua');

        Route::get('xoa/{id}','NhanVienController@getXoa');

        Route::get('timkiem','NhanVienController@getSearch');

    });

    Route::group(['prefix'=>'loaiphong'], function (){
        Route::get('danhsach', 'LoaiPhongController@getDanhSach');

        Route::get('them','LoaiPhongController@getThem');
        Route::post('them', 'LoaiPhongController@postThem');

        Route::get('sua/{id}','LoaiPhongController@getSua');
        Route::post('sua/{id}','LoaiPhongController@postSua');

        Route::get('xoa/{id}','LoaiPhongController@getXoa');

        Route::get('timkiem','LoaiPhongController@getSearch');

    });

    Route::group(['prefix'=>'phong'], function (){
        Route::get('danhsach', 'PhongController@getDanhSach');

        Route::get('them','PhongController@getThem');
        Route::post('them', 'PhongController@postThem');

        Route::get('sua/{id}','PhongController@getSua');
        Route::post('sua/{id}','PhongController@postSua');

        Route::get('xoa/{id}','PhongController@getXoa');

        Route::get('timkiem','PhongController@getSearch');

    });

    Route::group(['prefix'=>'anh'], function (){
        Route::get('danhsach', 'AnhController@getDanhSach');

        Route::get('them','AnhController@getThem');
        Route::post('them', 'AnhController@postThem');

        Route::get('sua/{id}','AnhController@getSua');
        Route::post('sua/{id}','AnhController@postSua');

        Route::get('xoa/{id}','AnhController@getXoa');

        Route::get('timkiem','AnhController@getSearch');

    });

    Route::group(['prefix'=>'thuephong'], function (){
        Route::get('danhsach', 'ThuePhongController@getDanhSach');

        Route::get('them','ThuePhongController@getThem');
        Route::post('them', 'ThuePhongController@postThem');

        Route::get('sua/{id}','ThuePhongController@getSua');
        Route::post('sua/{id}','ThuePhongController@postSua');

        Route::get('xoa/{id}','ThuePhongController@getXoa');

        Route::get('timkiem','ThuePhongController@getSearch');

    });

    Route::group(['prefix'=>'hoadon'], function (){
        Route::get('danhsach', 'HoaDonController@getDanhSach');

        Route::get('sua/{id}','HoaDonController@getSua');
        Route::post('sua/{id}','HoaDonController@postSua');

        Route::get('xoa/{id}','HoaDonController@getXoa');

        Route::get('timkiem','HoaDonController@getSearch');

    });

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/admin/logout', 'Auth\LoginController@userLogout')->name('user.logout');
//
//Route::prefix('customer')->group(function (){
//    Route::get('/', 'KhachHangController@index')->name('khachhang.dashboard');
//    Route::get('/login','Auth\KhachHangLoginController@showLoginForm')->name('khachhang.login');
//    Route::post('/login','Auth\KhachHangLoginController@login')->name('khachhang.login.submit');
//    Route::get('/logout','Auth\KhachHangLoginController@logout')->name('khachhang.logout');
//
//    //Password Reset Routes
//    Route::post('password/email','Auth\KhachHangForgotPasswordController@sendResetLinkEmail')->name('khachhang.password.email');
//    Route::get('password/reset','Auth\KhachHangForgotPasswordController@showLinkRequestForm')->name('khachhang.password.request');
//    Route::post('/password/reset','Auth\KhachHangResetPasswordController@reset');
//    Route::get('/password/reset/{token}','Auth\KhachHangResetPasswordController@showResetForm')->name('khachhang.password.reset');
//});

