<?php

namespace App\Http\Controllers;



use App\KhachHang;
use App\ThuePhong;
use Illuminate\Http\Request;
use App\LoaiPhong;
use App\Phong;
use App\Anh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function index()
    {
        return view('index');
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
        $comment = DB::table('comment')->where('id_phong','=',$phong->id)->get();
        $khachhang = DB::table('khachhangs')->get();
        return view('room_details',['anh'=>$anh, 'phong'=>$phong,'comment'=>$comment,'khachhang'=>$khachhang]);
    }

    public function book($id)
    {
        $phong = Phong::find($id);
        if (Auth::guard('khachhang')->check())
        {
            return view('book',['phong'=>$phong]);
        }
        else
            return redirect('customer/dangnhap');
    }

    public function getRegister()
    {
        return view('registercustomer');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request,
            [
                'hoten'  =>  'required',
                'sdt'  =>  'required',
                'email' =>  'email|required',
                'password'       =>  'required|min:6|max:32',
                'passwordAgain'  =>  'required|min:6|max:32|same:password',
            ],
            [
                'hoten.required'     =>  'Vui lòng nhập họ tên',
                'sdt.required'     =>  'Vui lòng nhập số điện thoại',
                'email.required'     =>  'Vui lòng nhập email',
                'email' =>  'Email không đúng định dạng',
                'password.required'          =>  'Vui lòng nhập mật khẩu',
                'password.min'               =>  'mật khẩu ít nhất 6 kí tự',
                'password.max'               =>  'mật khẩu nhiều nhất 32 kí tự',
                'passwordAgain.required'     =>  'Vui lòng nhập mật khẩu xác nhận',
                'passwordAgain.min'          =>  'mật khẩu xác nhận ít nhất 6 kí tự',
                'password.Again.max'         =>  'mật khẩu xác nhận nhiều nhất 32 kí tự',
                'passwordAgain.same'         =>  'mật khẩu xác nhận không khớp',
            ]);

        $khachhang = new KhachHang();
        $khachhang->hoten = $request->hoten;
        $khachhang->sdt = $request->sdt;
        $khachhang->email = $request->email;
        $khachhang->password = bcrypt($request->password);

        $khachhang->save();

        return redirect('customer/register')->with('thongbao','Đăng ký thành công');
    }

    public function getDetail($id)
    {
        $khachhang = KhachHang::find($id);
        return view('detailcustomer',['khachhang'=>$khachhang]);
    }

    public function postDetail(Request $request,$id)
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
                'email' =>  'Email không đúng định dạng',
                'email.unique'  =>  'Email đã tồn tại',
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

        return redirect()->back()->with('thongbao','Cập nhật thông tin thành công');
    }

    public function getBill($id)
    {
        $khachhang = KhachHang::find($id);
        $phong = Phong::all();
        $thuephong = DB::table('thuephong')->where('id_khachhang','=',$khachhang->id)->get();
        $tongtien = 0;
        foreach ($thuephong as $tp)
        {
            $tongtien += $tp->tongtien;
        }
        return view('billcustomer',['khachhang'=>$khachhang, 'thuephong'=>$thuephong, 'phong'=>$phong,'tongtien'=>$tongtien]);
    }

    public function getEditBill($id)
    {
        $thuephong = ThuePhong::find($id);
        $phong = Phong::where('id','=',$thuephong->id_phong)->first();
        return view('editbill',['thuephong'=>$thuephong,'phong'=>$phong]);
    }

    public function postEditBill(Request $request,$id)
    {
        $thuephong = ThuePhong::find($id);
        $id_khachhang = $thuephong->id_khachhang;
        $this->validate($request,
            [
                'ngayden'  =>  'required|after:today',
                'ngaytra'  =>  'after:ngayden',
            ],
            [
                'ngayden.required'     =>  'Vui lòng nhập ngày đến',
                'ngayden.after'   =>  'Mời kiểm tra lại ngày đến',
                'ngaytra.after'   =>  'Mời kiểm tra lại ngày trả',
            ]);

        $thuephong->ngayden = $request->ngayden;
        $thuephong->ngaytra = $request->ngaytra;
        $thuephong->tongtien = $request->tongtien;
        $thuephong->ghichu = $request->ghichu;

        $thuephong->save();

        return redirect('customer/bill/'.$id_khachhang)->with('thongbao','Sửa thành công');
    }

    public function getDeleteBill($id)
    {
        $thuephong = ThuePhong::find($id);
        $phong = Phong::where('id','=',$thuephong->id_phong)->first();
        $phong->tinhtrang = 0;
        $phong->save();
        $thuephong->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }


    public function getLogin()
    {
        return view('logincustomer');
    }

    //
    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'nhap username',
                'password.required' => 'nhap password',
            ]);

        if (Auth::guard('khachhang')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            echo "<script>window.history.go(-2);</script>";
//            return redirect('index');
        }
        else
        {
            return redirect('customer/dangnhap')->with('thongbao','Sai email hoặc mật khẩu');
        }
    }

    public function getLogout()
    {
        Auth::guard('khachhang')->logout();
        return redirect('index');
    }

}
