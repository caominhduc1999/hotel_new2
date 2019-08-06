<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    //
    public $timestamps = false;
    protected $table = 'hoadon';

    public function khachhang()
    {
        return $this->belongsTo('App\KhachHang', 'id_khachhang', 'id');
    }

    public function nhanvien()
    {
        return $this->belongsTo('App\NhanVien', 'id_nhanvien', 'id');
    }
}
