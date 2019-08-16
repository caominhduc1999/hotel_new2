<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\KhachHang;
use Illuminate\Support\Facades\Auth;


class KhachHangController extends Controller
{

    // comment for admin to access data customer

//    public function __construct()
//    {
//        $this->middleware('auth:khachhang');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('test');
    }

    public function getSearch(Request $request)
    {
        $key = $request->key;
        $search = KhachHang::where('hoten','like','%'.$key.'%')->orwhere('quoctich','like','%'.$key.'%')->orwhere('diachi','like','%'.$key.'%')->get();
        return view('admin.khachhang.timkiem',['search'=>$search]);
    }

    public function getDanhSach()
    {
        $danhsachkhachhang = KhachHang::orderBy('id')->paginate(10);
        return view('admin.khachhang.danhsach',['danhsachkhachhang' => $danhsachkhachhang]);
    }

    public function getThem()
    {
        return view('admin.khachhang.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'hoten'  =>  'required',
                'sdt'  =>  'required',
                'cccd'  =>'numeric|nullable',
                'ngaysinh'  =>'before:today|nullable',
                'email' =>  'email|required|unique:khachhangs,email',
                'password'       =>  'required|min:6|max:32',
                'passwordAgain'  =>  'required|min:6|max:32|same:password',
            ],
            [
                'hoten.required'     =>  'Vui lòng nhập họ tên',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại',
                'email.required'     =>  'Vui lòng nhập email',
                'cccd.numeric'     =>  'Mời kiểm tra lại căn cước công dân',
                'ngaysinh.before'   =>  'Mời kiểm tra lại ngày sinh',
                'email.email' =>  'Email không đúng định dạng',
                'email.unique'  =>  'Email đã tồn tại',
                'password.required'          =>  'Vui lòng nhập mật khẩu',
                'password.min'               =>  'mật khẩu ít nhất 6 kí tự',
                'password.max'               =>  'mật khẩu nhiều nhất 32 kí tự',
                'passwordAgain.required'     =>  'Vui lòng nhập mật khẩu xác nhận',
                'passwordAgain.min'          =>  'pmật khẩu xác nhận ít nhất 6 kí tự',
                'password.Again.max'         =>  'pmật khẩu xác nhận nhiều nhất 32 kí tự',
                'passwordAgain.same'         =>  'pmật khẩu xác nhận không khớp',
            ]);

        $khachhang = new KhachHang();
        $khachhang->hoten = $request->hoten;
        $khachhang->gioitinh = $request->gioitinh;
        $khachhang->ngaysinh = $request->ngaysinh;
        $khachhang->sdt = $request->sdt;
        $khachhang->email = $request->email;
        $khachhang->password = bcrypt($request->password);
        $khachhang->diachi = $request->diachi;
        $khachhang->cccd = $request->cccd;
        $khachhang->quoctich = $request->quoctich;

        $khachhang->save();

        return redirect('admin/khachhang/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $khachhang = KhachHang::find($id);
        return view('admin.khachhang.sua',['khachhang'=>$khachhang]);
    }

    public function postSua(Request $request, $id)
    {
        $khachhang = KhachHang::find($id);

        $this->validate($request,
            [
                'hoten'  =>  'required',
                'sdt'  =>  'required',
                'cccd'  =>'required|numeric',
                'ngaysinh'  =>'before:today',
                'email' =>  'email|unique:khachhangs,email,'.$id.' '
            ],
            [
                'hoten.required'     =>  'Vui lòng nhập họ tên',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại',
                'cccd.required'     =>  'Vui lòng nhập căn cước công dân',
                'cccd.numeric'     =>  'Mời kiểm tra lại căn cước công dân',
                'ngaysinh.before'   =>  'Mời kiểm tra lại ngày sinh',
                'email.email' =>  'Email không đúng định dạng',
                'email.unique'  =>  'Email đã tồn tại'
            ]);

        $khachhang->hoten = $request->hoten;
        $khachhang->gioitinh = $request->gioitinh;
        $khachhang->ngaysinh = $request->ngaysinh;
        $khachhang->sdt = $request->sdt;
        $khachhang->email = $request->email;
        $khachhang->diachi = $request->diachi;
        $khachhang->cccd = $request->cccd;
        $khachhang->quoctich = $request->quoctich;
        $khachhang->save();

        return redirect('admin/khachhang/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $khachhang = KhachHang::find($id);

        //xoa cac hoa don cua khach hang day
        DB::table('hoadon')->where('id_khachhang',$khachhang->id)->delete();

        //xoa cac thue phong cua khach hang day
        DB::table('thuephong')->where('id_khachhang',$khachhang->id)->delete();

        $khachhang->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }


}

