<?php

namespace App\Http\Controllers;

use App\HoaDon;
use App\KhachHang;
use App\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HoaDonController extends Controller
{
    //
    public function getSearch(Request $request)
    {
        $khachhang = KhachHang::all();
        $nhanvien = NhanVien::all();

        $key = $request->key;

        $get_tenkhachhang = KhachHang::where('hoten','like','%'.$key.'%')->pluck('id')->all();
        $get_tennhanvien = NhanVien::where('hoten','like','%'.$key.'%')->pluck('id')->all();

        if ($get_tenkhachhang)
        {
            foreach ($get_tenkhachhang as $id_tenkhachhang)
            {
                $search = HoaDon::where('id_khachhang','=',$id_tenkhachhang)->paginate(10);
                if ($search)
                {
                    return view('admin.hoadon.timkiem',['search'=>$search,'khachhang'=>$khachhang, 'nhanvien'=>$nhanvien]);
                }
            }
        }

        if ($get_tennhanvien)
        {
            foreach ($get_tennhanvien as $id_tennhanvien)
            {
                $search = HoaDon::where('id_nhanvien','=',$id_tennhanvien)->paginate(10);
                if ($search)
                {
                    return view('admin.hoadon.timkiem',['search'=>$search,'khachhang'=>$khachhang, 'nhanvien'=>$nhanvien]);
                }
            }
        }
        $search = HoaDon::where('ngaythanhtoan','like','%'.$key.'%')->paginate(10);


        return view('admin.hoadon.timkiem',['search'=>$search,'khachhang'=>$khachhang, 'nhanvien'=>$nhanvien]);

    }

    public function getDanhSach()
    {
        $danhsachhoadon = HoaDon::orderBy('id')->paginate(10);
        foreach ($danhsachhoadon as $ds)
        {
            $thuephong = DB::table('thuephong')->where('id_khachhang','=',$ds->id_khachhang)->get();
            $tongtien = 0;
            foreach ($thuephong as $tp)
            {
                $tongtien += $tp->tongtien;
            }
            $ds->tongthanhtoan = $tongtien;
            $ds->save();
        }

        $khachhang = KhachHang::all();
        $nhanvien = NhanVien::all();
        return view('admin.hoadon.danhsach',['danhsachhoadon' => $danhsachhoadon, 'khachhang'=>$khachhang, 'nhanvien'=>$nhanvien]);
    }

    public function getSua($id)
    {
        $hoadon = HoaDon::find($id);
        $nhanvien = NhanVien::all();
        return view('admin.hoadon.sua',['hoadon'=>$hoadon, 'nhanvien'=>$nhanvien]);
    }

    public function postSua(Request $request, $id)
    {
        $hoadon = HoaDon::find($id);

        $this->validate($request,
            [
                'id_nhanvien'  => 'required',
                'ngaythanhtoan' => 'required'
            ],
            [
                'id_nhanvien.required' =>  'Vui lòng chọn nhân viên',
                'ngaythanhtoan.unique'   =>  'Vui lòng nhập Ngày thanh toán'
            ]);

        $hoadon->id_nhanvien = $request->id_nhanvien;
        $hoadon->ngaythanhtoan = $request->ngaythanhtoan;
        $hoadon->save();

        return redirect('admin/hoadon/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $hoadon = HoaDon::find($id);
        $hoadon->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }
}
