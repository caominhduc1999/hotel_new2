<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\LoaiPhong;
use App\Phong;
use App\Anh;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function logincustomer()
    {
        return view('logincustomer');
    }

    public function contact()
    {
        return view('contact');
    }

    public function gallery()
    {
        $anh = Anh::all();
        return view('gallery',['anh'=>$anh]);
    }

    public function introduction()
    {
        return view('introduction');
    }

    public function rooms_tariff()
    {
        $loaiphong = LoaiPhong::all();
        $phong = Phong::orderBy('id')->paginate(8);
        return view('rooms_tariff',['loaiphong'=>$loaiphong,'phong'=>$phong]);
    }

    public function rooms_tariff_loaiphong($id)
    {
//        $phong_filter = Phong::find($id);
        $loaiphong = LoaiPhong::all();
        $phong = Phong::where('id_loaiphong','=',$id)->orderBy('id')->paginate(8);
        return view('rooms_tariff',['loaiphong'=>$loaiphong,'phong'=>$phong]);
    }

    public function room_details($id)
    {
        $phong = Phong::find($id);
        $anh = DB::table('anh')->where('id_phong','=',$phong->id)->get();
        return view('room_details',['anh'=>$anh, 'phong'=>$phong]);
    }

    public function book($id)
    {
        $phong = Phong::find($id);
        return view('book',['phong'=>$phong]);
    }
}
