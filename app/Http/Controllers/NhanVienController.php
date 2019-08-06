<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\NhanVien;

class NhanVienController extends Controller
{
    //

    public function getSearch(Request $request)
    {
        $key = $request->key;
        $search = NhanVien::where('hoten','like','%'.$key.'%')->orwhere('diachi','like','%'.$key.'%')->get();
        return view('admin.nhanvien.timkiem',['search'=>$search]);
    }

    public function getDanhSach()
    {
        $danhsachnhanvien = nhanvien::orderBy('id')->paginate(10);
        return view('admin.nhanvien.danhsach',['danhsachnhanvien' => $danhsachnhanvien]);
    }

    public function getThem()
    {
        return view('admin.nhanvien.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'hoten'  =>  'required',
                'sdt'  =>  'required',
                'diachi'    =>'required',
                'cccd'  =>  'required|numeric',
                'ngaysinh'  =>'before:today'

            ],
            [
                'hoten.required'     =>  'Vui lòng nhập họ tên',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại',
                'cccd.required'     =>  'Vui lòng nhập căn cước công dân',
                'diachi.required'   =>  'Vui lòng nhập địa chỉ',
                'cccd.numeric'     =>  'Mời kiểm tra lại căn cước công dân',
                'ngaysinh.before'   =>  'Mời kiểm tra lại ngày sinh'

            ]);

        $nhanvien = new NhanVien();
        $nhanvien->hoten = $request->hoten;
        $nhanvien->gioitinh = $request->gioitinh;
        $nhanvien->ngaysinh = $request->ngaysinh;
        $nhanvien->sdt = $request->sdt;
        $nhanvien->diachi = $request->diachi;
        $nhanvien->cccd = $request->cccd;
        $nhanvien->save();

        return redirect('admin/nhanvien/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $nhanvien = NhanVien::find($id);
        return view('admin.nhanvien.sua',['nhanvien'=>$nhanvien]);
    }

    public function postSua(Request $request, $id)
    {
        $nhanvien = NhanVien::find($id);

        $this->validate($request,
            [
                'hoten'  =>  'required',
                'sdt'  =>  'required',
                'diachi'    =>'required',
                'cccd'  =>  'required|numeric',
                'ngaysinh'  =>'before:today'

            ],
            [
                'hoten.required'     =>  'Vui lòng nhập họ tên',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại',
                'diachi.required'   =>  'Vui lòng nhập địa chỉ',
                'cccd.required'     =>  'Vui lòng nhập căn cước công dân',
                'cccd.numeric'     =>  'Mời kiểm tra lại căn cước công dân',
                'ngaysinh.before'   =>  'Mời kiểm tra lại ngày sinh'

            ]);

        $nhanvien->hoten = $request->hoten;
        $nhanvien->gioitinh = $request->gioitinh;
        $nhanvien->ngaysinh = $request->ngaysinh;
        $nhanvien->sdt = $request->sdt;
        $nhanvien->diachi = $request->diachi;
        $nhanvien->cccd = $request->cccd;
        $nhanvien->save();

        return redirect('admin/nhanvien/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $nhanvien = nhanvien::find($id);

        //xoa cac hoa don cua nhan vien day
        DB::table('hoadon')->where('id_nhanvien',$nhanvien->id)->delete();

        //xoa cac thue phong cua nhan vien day
        DB::table('thuephong')->where('id_nhanvien',$nhanvien->id)->delete();

        $nhanvien->delete();

        return redirect('admin/nhanvien/danhsach')->with('thongbao', 'Xóa thành công');
    }


}


