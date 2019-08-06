<?php

namespace App\Http\Controllers;

use App\DatPhong;
use App\KhachHang;
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
                'ngaytra' =>  'required|after:today'
            ],
            [
                'hoten.required'    =>  'Vui lòng nhập họ tên',
                'sdt.required'    =>  'Vui lòng nhập số điện thoại',
                'email.email'    =>  'Không đúng định dạng email',
                'ngayden.required'    =>  'Vui lòng nhập ngày đến',
                'ngayden.after'    =>  'Vui lòng kiểm tra lại ngày đến',
                'ngaytra.required'    =>  'Vui lòng nhập ngày đến',
                'ngaytra.after'    =>  'Vui lòng kiểm tra lại ngày đến'
            ]);

        $khachhang = new KhachHang();
        $khachhang->hoten = $request->hoten;
        $khachhang->sdt = $request->sdt;
        $khachhang->save();

        $thuephong = new ThuePhong();
        $thuephong->email = $request->email;
        $thuephong->ngayden = $request->ngayden;
        $thuephong->ngaytra = $request->ngaytra;
        $thuephong->id_khachhang = $khachhang->id;
        $thuephong->save();


        return redirect('index')->with('thongbao','Chúng tôi đã nhận đc yêu cầu. Vui lòng chờ xác nhận');
    }
}
