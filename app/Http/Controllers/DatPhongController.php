<?php

namespace App\Http\Controllers;

use App\DatPhong;
use App\HoaDon;
use App\KhachHang;
use App\Phong;
use App\ThuePhong;
use Illuminate\Http\Request;

class DatPhongController extends Controller
{
    //

    public function postDatPhong(Request $request)
    {
        $this->validate($request,
            [
                'hoten' =>  'required',
                'sdt' =>  'required|numeric',
                'email' =>  'email',
                'ngayden' =>  'required|after:today',
                'ngaytra' =>  'required|after:today,ngayden'
            ],
            [
                'hoten.required'    =>  'Vui lòng nhập họ tên',
                'sdt.required'    =>  'Vui lòng nhập số điện thoại',
                'email.email'    =>  'Không đúng định dạng email',
                'ngayden.required'    =>  'Vui lòng nhập ngày đến',
                'ngayden.after'    =>  'Vui lòng kiểm tra lại ngày đến',
                'ngaytra.required'    =>  'Vui lòng nhập ngày đi',
                'ngaytra.after'    =>  'Vui lòng kiểm tra lại ngày đến',
            ]);

        $phong = Phong::find($request->id_phong);
        $phong->tinhtrang = 1;
        $phong->save();

        $thuephong = new ThuePhong();
        $thuephong->ngayden = $request->ngayden;
        $thuephong->ngaytra = $request->ngaytra;
        $thuephong->email = $request->email;
        $thuephong->id_khachhang = $request->id_khachhang;
        $thuephong->id_phong = $request->id_phong;
        $thuephong->tongtien = $request->tongtien;
        $thuephong->ghichu = $request->ghichu;

        $thuephong->save();


        $hoadon = HoaDon::where('id_khachhang','=',$request->id_khachhang)->first();
        if (! isset($hoadon))
        {
            $hoadon = new HoaDon();
            $hoadon->id_khachhang = $request->id_khachhang;
            $hoadon->save();
        }

        return redirect()->back()->with('thongbao','Đặt phòng thành công');
    }
}
