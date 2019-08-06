<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThuePhong extends Model
{
    //
    public $timestamps = true;
    protected $table = 'thuephong';

    public function phong()
    {
        return $this->belongsTo('App\Phong', 'id_loaiphong','id');
    }

    public function nhanvien()
    {
        return $this->belongsTo('App\NhanVien', 'id_nhanvien', 'id');
    }

    public function khachhang()
    {
        return $this->belongsTo('App\KhachHang', 'id_khachhang', 'id');
    }

}
