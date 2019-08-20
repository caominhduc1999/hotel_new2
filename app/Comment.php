<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public $timestamps = true;
    protected $table = 'comment';

    public function khachhang()
    {
        return $this->belongsTo('App\KhachHang','id_khachhang','id');
    }

    public function phong()
    {
        return $this->belongsTo('App\Phong','id_phong','id');
    }
}
