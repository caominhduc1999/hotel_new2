<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    //
    public $timestamps = false;
    protected $table = 'phong';

    public function thuephong()
    {
        return $this->hasOne('App\ThuePhong', 'id_phong', 'id');
    }

    public function loaiphong()
    {
        return $this->belongsTo('App\LoaiPhong','id_loaiphong','id');
    }

    public function anh()
    {
        return $this->hasMany('App\Anh', 'id_phong', 'id');
    }

    public function phong()
    {
        return $this->hasMany('App\Comment', 'id_phong', 'id');
    }
}
