<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\KhachHangResetPasswordNotification;


class KhachHang extends Authenticatable
{

    use Notifiable;
    protected $guarded = 'khachhang';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hoten', 'email', 'password','sdt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $timestamps = false;
    protected $table = 'khachhangs';

    public function hoadon()
    {
        return $this->hasMany('App\HoaDon', 'id_khachhang', 'id');
    }

    public function thuephong()
    {
        return $this->hasMany('App\ThuePhong', 'id_khachhang', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new KhachHangResetPasswordNotification($token));
    }

    public function comment()
    {
        return $this->hasMany('App\Comment', 'id_khachhang', 'id');
    }
}
