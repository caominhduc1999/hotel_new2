<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    //
    public $timestamps = false;
    protected $table = 'anh';

    public function phong()
    {
        return $this->belongsTo('App\Phong', 'id_phong', 'id');
    }
}
