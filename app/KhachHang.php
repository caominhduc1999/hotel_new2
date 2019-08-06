<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    //
    public $timestamps = false;
    protected $table = 'khachhang';

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon', 'id_khachhang', 'id');
    }

    public function thuephong()
    {
        return $this->hasMany('App\ThuePhong', 'id_khachhang', 'id');
    }

}
