<?php

namespace App\Http\Controllers;


use App\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ThuePhong;
use App\KhachHang;
use App\Phong;

class ThuePhongController extends Controller
{
    //

    public function getSearch(Request $request)
    {
        $key = $request->key;
        $phong = Phong::all();

        $get_tenphong = Phong::where('tenphong','like','%'.$key.'%')->pluck('id')->all();
        $get_tenkhachhang = KhachHang::where('hoten','like','%'.$key.'%')->pluck('id')->all();
        $get_tennhanvien = NhanVien::where('hoten','like','%'.$key.'%')->pluck('id')->all();

        if ($get_tenphong)
        {
            foreach ($get_tenphong as $id_tenphong)
            {
                $search = ThuePhong::where('id_phong','=',$id_tenphong)->get();
                if ($search)
                {
                    return view('admin.thuephong.timkiem',['search'=>$search,'phong'=>$phong]);
                }
            }
        }

        if ($get_tenkhachhang)
        {
            foreach ($get_tenkhachhang as $id_tenkhachhang)
            {
                $search = ThuePhong::where('id_khachhang',$id_tenkhachhang)->get();
                if ($search)
                {
                    return view('admin.thuephong.timkiem',['search'=>$search,'phong'=>$phong]);
                }
            }
        }

        if ($get_tennhanvien)
        {
            foreach ($get_tennhanvien as $id_tennhanvien)
            {
                $search = ThuePhong::where('id_nhanvien',$id_tennhanvien)->get();
                if ($search)
                {
                    return view('admin.thuephong.timkiem',['search'=>$search,'phong'=>$phong]);
                }
            }
        }

        //co tinh tra ve 0 doi tuong
        $search = ThuePhong::where('id','=','-1')->get();
        return view('admin.thuephong.timkiem',['search'=>$search, 'phong'=>$phong]);

    }

    public function getDanhSach()
    {
        $danhsachthuephong = ThuePhong::orderBy('id')->paginate(10);
        $phong = Phong::all();
        return view('admin.thuephong.danhsach',['danhsachthuephong' => $danhsachthuephong, 'phong'=>$phong]);
    }

    public function getThem()
    {
        $phong = Phong::all();
        $nhanvien = NhanVien::all();
        return view('admin.thuephong.them',['phong'=>$phong, 'nhanvien'=>$nhanvien]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'ngayden'  =>  'required|after:today',
                'hoten' =>  'required',
                'sdt' =>  'required',
                'id_phong' =>  'required',
                'email' =>  'required|email'
            ],
            [
                'ngayden.required'     =>  'Vui lòng nhập ngày đặt',
                'ngayden.after'   =>  'Mời kiểm tra lại ngày đặt',
                'hoten.required'     =>  'Vui lòng nhập họ tên khách hàng',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại khách hàng',
                'id_phong.required'     =>  'Vui lòng chọn phòng',
                'email.required'     =>  'Vui lòng nhập email',
                'email.email'     =>  'Email không đúng định dạng',
            ]);

        $khachhang = new KhachHang();
        $khachhang->hoten = $request->hoten;
        $khachhang->sdt = $request->sdt;
        $khachhang->save();

        $thuephong = new ThuePhong();
        $thuephong->ngayden = $request->ngayden;
        $thuephong->id_khachhang = $khachhang->id;
        $thuephong->id_phong = $request->id_phong;
        $thuephong->ngaytra = $request->ngaytra;
        $thuephong->id_nhanvien = $request->id_nhanvien;
        $thuephong->email = $request->email;
        $thuephong->save();



        return redirect('admin/thuephong/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $thuephong = ThuePhong::find($id);
        $khachhang = KhachHang::find($thuephong->id_khachhang);
        $phong = Phong::all();
        $nhanvien = NhanVien::all();
        return view('admin.thuephong.sua',['thuephong'=>$thuephong,'khachhang'=>$khachhang,'phong'=>$phong,'nhanvien'=>$nhanvien]);
    }

    public function postSua(Request $request, $id)
    {
        $thuephong = ThuePhong::find($id);
        $khachhang = KhachHang::find($thuephong->id_khachhang);

        $this->validate($request,
            [
                'ngayden'  =>  'required|after:today',
                'ngaytra'  =>  'after:ngayden',
                'hoten' =>  'required',
                'sdt' =>  'required',
                'id_phong' =>  'required',
                'email' =>  'required|email'
            ],
            [
                'ngayden.required'     =>  'Vui lòng nhập ngày đặt',
                'ngayden.after'   =>  'Mời kiểm tra lại ngày đặt',
                'ngaytra.after'   =>  'Mời kiểm tra lại ngày đặt',
                'hoten.required'     =>  'Vui lòng nhập họ tên khách hàng',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại khách hàng',
                'id_phong.required'     =>  'Vui lòng chọn phòng',
                'email.required'     =>  'Vui lòng nhập email',
                'email.email'     =>  'Email không đúng định dạng',
            ]);

        $khachhang->hoten = $request->hoten;
        $khachhang->sdt = $request->sdt;
        $khachhang->save();

        $thuephong->ngayden = $request->ngayden;
        $thuephong->id_khachhang = $khachhang->id;
        $thuephong->id_phong = $request->id_phong;
        $thuephong->ngaytra = $request->ngaytra;
        $thuephong->id_nhanvien = $request->id_nhanvien;
        $thuephong->email = $request->email;
        $thuephong->save();

        return redirect('admin/thuephong/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $thuephong = ThuePhong::find($id);

        $thuephong->delete();

        return redirect('admin/thuephong/danhsach')->with('thongbao', 'Xóa thành công');
    }


}


