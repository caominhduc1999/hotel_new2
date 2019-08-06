<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiPhong extends Model
{
    //
    public $timestamps = false;

    protected $table = 'loaiphong';

    public function phong()
    {
        return $this->hasMany('App\Phong', 'id_loaiphong', 'id');
    }
}
