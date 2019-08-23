<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Phong;
use App\LoaiPhong;
use Illuminate\Support\Facades\DB;
use App\Anh;

class PhongController extends Controller
{
    //

    public function getSearch(Request $request)
    {
        $key = $request->key;

        $get_tenloaiphong = LoaiPhong::where('tenloaiphong','like','%'.$key.'%')->pluck('id')->all();

        if ($get_tenloaiphong)
        {
            foreach ($get_tenloaiphong as $id_tenloaiphong)
            {
                $search = Phong::where('id_loaiphong','=',$id_tenloaiphong)->orwhere('tenphong','like','%'.$key.'%')->orwhere('giatien','=',number_format(intval($key)))->get();
                if ($search)
                {
                    return view('admin.phong.timkiem',['search'=>$search]);
                }
            }
        }
        $search = Phong::where('tenphong','like','%'.$key.'%')->orwhere('giatien','=',$key)->get();

        return view('admin.phong.timkiem',['search'=>$search]);

    }

    public function getDanhSach()
    {
        $danhsachphong = Phong::orderBy('id')->paginate(10);
        return view('admin.phong.danhsach',['danhsachphong' => $danhsachphong]);
    }

    public function getThem()
    {
        $loaiphong = LoaiPhong::all();
        return view('admin.phong.them', ['loaiphong'=>$loaiphong]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'tenphong'  =>  'required|unique:phong,tenphong',
                'id_loaiphong'  =>'required',
                'giatien'   =>  'required|numeric|min:0',
            ],
            [
                'tenphong.required'     =>  'Vui lòng nhập tên phòng',
                'id_loaiphong.required'     =>  'Vui lòng chọn loại phòng',
                'tenphong.unique'     =>  'Tên phòng đã tồn tại',
                'giatien.required'     =>  'Vui lòng nhập giá tiền',
                'giatien.numeric'   =>  'Vui lòng kiểm tra lại định dạng',
                'giatien.min'   => 'Vui lòng kiểm tra lại giá tiền',
            ]);

        $phong = new Phong();
        $phong->tenphong = $request->tenphong;
        $phong->id_loaiphong = $request->id_loaiphong;
        $phong->tinhtrang = $request->tinhtrang;
        $phong->thongtin = $request->thongtin;
        $phong->giatien = $request->giatien;

        //xu li anh dai dien
        $anhdaidien = rand().'.'.request()->anhdaidien->getClientOriginalExtension();
        //dam bao khong random trung nhau
        while(file_exists('anhdaidien/'.$anhdaidien))
        {
            $anhdaidien = rand().'.'.request()->anhdaidien->getClientOriginalExtension();
        }
        request()->anhdaidien->move(public_path('anhdaidien'), $anhdaidien);
        $phong->anhdaidien = $anhdaidien;
        $phong->save();

        return redirect('admin/phong/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $phong = Phong::find($id);
        $loaiphong = LoaiPhong::all();
        return view('admin.phong.sua',['loaiphong'=>$loaiphong,'phong'=>$phong]);
    }

    public function postSua(Request $request, $id)
    {
        $phong = Phong::find($id);

        $this->validate($request,
            [
                'tenphong'  =>  'required|unique:phong,tenphong,'.$id.' ',
                'id_loaiphong'  =>'required',
                'giatien'   =>  'required|numeric|min:0'
            ],
            [
                'tenphong.required'     =>  'Vui lòng nhập tên phòng',
                'id_loaiphong.required'     =>  'Vui lòng chọn loại phòng',
                'tenphong.unique'     =>  'Tên phòng đã tồn tại',
                'giatien.required'     =>  'Vui lòng nhập giá tiền',
                'giatien.numeric'   =>  'Vui lòng kiểm tra lại định dạng',
                'giatien.min'   => 'Vui lòng kiểm tra lại giá tiền',
            ]);

        $phong->tenphong = $request->tenphong;
        $phong->id_loaiphong = $request->id_loaiphong;
        $phong->tinhtrang = $request->tinhtrang;
        $phong->thongtin = $request->thongtin;
        $phong->giatien = $request->giatien;

        //neu doi anh moi
        $image_path = 'anhdaidien/'.$phong->anhdaidien;

        if ((request()->anhdaidien)){
            $anhdaidien = rand().'.'.request()->anhdaidien->getClientOriginalExtension();
            while(file_exists('anhdaidien/'.$anhdaidien))
            {
                $anhdaidien = rand().'.'.request()->anhdaidien->getClientOriginalExtension();
            }
            request()->anhdaidien->move(public_path('anhdaidien'), $anhdaidien);
            $phong->anhdaidien = $anhdaidien;

            //xoa anh cu
            unlink($image_path);
        }

        $phong->save();

        return redirect('admin/phong/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $phong = Phong::find($id);

        //xoa anh trong file public/images
        $array_id_anh = Anh::where('id_phong' ,'=' ,$phong->id)->pluck('id')->all();  //pluck return array

        foreach ($array_id_anh as $id_anh)
        {
            //tim id cua doi tuong anh can xoa <=> find(value)
            $anh = DB::table('anh')->where('id',$id_anh)->first();     // First for single data. Get for lots of data
            $image_path = 'images/'.$anh->tenanh;
            unlink($image_path);
        }


        //xoa cac doi tuong anh thuoc phong vua xoa
        DB::table('anh')->where('id_phong',$phong->id)->delete();

        DB::table('thuephong')->where('id_phong',$phong->id)->delete();

        DB::table('comment')->where('id_phong',$phong->id)->delete();

        if ($phong->anhdaidien)
        {
            $image_path = 'anhdaidien/'.$phong->anhdaidien;
            unlink($image_path);
        }

        $phong->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }

}


