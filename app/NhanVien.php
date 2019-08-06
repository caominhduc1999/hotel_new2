<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    //
    public $timestamps = false;
    protected $table = 'nhanvien';

    public function thuephong()
    {
        return $this->hasMany('App\ThuePhong', 'id_nhanvien', 'id');
    }

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon', 'id_nhanvien', 'id');
    }
}
