<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function getSearch(Request $request)
    {
        $key = $request->key;
        $search = User::where('fullname','like','%'.$key.'%')->orwhere('email','like','%'.$key.'%')->get();
        return view('admin.danhsachadmin.timkiem',['search'=>$search]);
    }

    public function getDanhSach()
    {
        $danhsachadmin = User::orderBy('id')->paginate(10);
        return view('admin.danhsachadmin.danhsach',['danhsachadmin' => $danhsachadmin]);
    }


    public function getThem()
    {
        return view('admin.danhsachadmin.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'password'       =>  'required|min:6|max:32',
                'passwordAgain'  =>  'required|min:6|max:32|same:password',
                'fullname'  =>  'required',
                'phone'     =>  'required|numeric',
                'email'     =>  'required|email|unique:admin,email'
            ],
            [
                'password.required'          =>  'Vui lòng nhập mật khẩu',
                'password.min'               =>  'mật khẩu ít nhất 6 kí tự',
                'password.max'               =>  'mật khẩu nhiều nhất 32 kí tự',
                'passwordAgain.required'     =>  'Vui lòng nhập mật khẩu xác nhận',
                'passwordAgain.min'          =>  'pmật khẩu xác nhận ít nhất 6 kí tự',
                'password.Again.max'         =>  'pmật khẩu xác nhận nhiều nhất 32 kí tự',
                'passwordAgain.same'         =>  'pmật khẩu xác nhận không khớp',
                'fullname.required'     =>  'Vui lòng nhập fullname',
                'phone.required'        =>  'Vui lòng nhập phone',
                'phone.numeric'        =>  'Vui lòng kiểm tra lại phone',
                'email.required'        =>  'Vui lòng nhập email',
                'email.email'           =>  'không đúng định dạng email',
                'email.unique'          =>  'email đã tồn tại',
            ]);

        $admin = new User();
        $admin->password = bcrypt($request->password);
        $admin->fullname = $request->fullname;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->save();

        return redirect('admin/danhsachadmin/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $admin = User::find($id);
        return view('admin.danhsachadmin.sua',['admin'=>$admin]);
    }

    public function postSua(Request $request, $id)
    {
        $admin = User::find($id);

        $this->validate($request,
            [
                'fullname'  =>  'required',
                'phone'     =>  'required',
                'email'     =>  'required|email|unique:admin,email,'.$id.''     //Forcing A Unique Rule To Ignore A Given ID
            ],
            [
                'fullname.required'     =>  'Vui lòng nhập fullname',
                'phone.required'        =>  'Vui lòng nhập phone',
                'email.required'        =>  'Vui lòng nhập email',
                'email.email'           =>  'không đúng định dạng email',
                'email.unique'          =>  'email đã tồn tại',
            ]);

        $admin->fullname = $request->fullname;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->save();

        return redirect('admin/danhsachadmin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $admin = User::find($id);
        $admin->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }


    public function getLogin()
    {
        return view('admin.dangnhap');
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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('admin/danhsachadmin/danhsach');
        }
        else
        {
            return redirect('admin/dangnhap')->with('thongbao','Sai email hoặc mật khẩu');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
