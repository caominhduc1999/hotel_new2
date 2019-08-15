<?php

namespace App\Http\Controllers;

use App\Phong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\LoaiPhong;
use App\Anh;

class LoaiPhongController extends Controller
{
    //

    public function getSearch(Request $request)
    {
        $key = $request->key;
        $search = LoaiPhong::where('tenloaiphong','like','%'.$key.'%')->get();
        return view('admin.loaiphong.timkiem',['search'=>$search]);
    }

    public function getDanhSach()
    {
        $danhsachloaiphong = LoaiPhong::orderBy('id')->paginate(10);
        return view('admin.loaiphong.danhsach',['danhsachloaiphong' => $danhsachloaiphong]);
    }

    public function getThem()
    {
        return view('admin.loaiphong.them');
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'tenloaiphong'  => 'required|unique:loaiphong,tenloaiphong'
            ],
            [
                'tenloaiphong.required' =>  'Vui lòng nhập tên loại phòng',
                'tenloaiphong.unique'   =>  'Tên loại phòng đã tồn tại'
            ]);

        $loaiphong = new LoaiPhong();
        $loaiphong->tenloaiphong = $request->tenloaiphong;
        $loaiphong->save();

        return redirect('admin/loaiphong/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $loaiphong = LoaiPhong::find($id);
        return view('admin.loaiphong.sua',['loaiphong'=>$loaiphong]);
    }

    public function postSua(Request $request, $id)
    {
        $loaiphong = LoaiPhong::find($id);

        $this->validate($request,
            [
                'tenloaiphong'  => 'required|unique:loaiphong,tenloaiphong,'.$id.' '
            ],
            [
                'tenloaiphong.required' =>  'Vui lòng nhập tên loại phòng',
                'tenloaiphong.unique'   =>  'Tên loại phòng đã tồn tại'
            ]);

        $loaiphong->tenloaiphong = $request->tenloaiphong;
        $loaiphong->save();

        return redirect('admin/loaiphong/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $loaiphong = LoaiPhong::find($id);

        //mang chua id cua phong thuoc loai phong vua xoa
        $array_id_phong = Phong::where('id_loaiphong','=',$loaiphong->id)->pluck('id')->all();

        foreach ($array_id_phong as $id_phong)
        {
            //xoa anh trong file public/images
            $array_id_anh = Anh::where('id_phong' ,'=' ,$id_phong)->pluck('id')->all();  //pluck return array

            foreach ($array_id_anh as $id_anh)
            {
                //tim id cua doi tuong anh can xoa <=> find(value)
                $anh = DB::table('anh')->where('id','=',$id_anh)->first();     // First for single data. Get for lots of data
                $image_path = 'images/'.$anh->tenanh;
                unlink($image_path);
            }

            //xoa cac doi tuong anh thuoc phong vua xoa
            DB::table('anh')->where('id_phong',$id_phong)->delete();
        }


        //xoa anh trong file public/anhdaidien
        foreach ($array_id_phong as $id_phong)
        {
            $phong = DB::table('phong')->where('id','=',$id_phong)->first();
            if ($phong->anhdaidien)
            {
                $image_path2 = 'anhdaidien/'.$phong->anhdaidien;
                unlink($image_path2);
            }
        }

        //xoa cac phong thuoc loai phong vua xoa
        DB::table('phong')->where('id_loaiphong',$loaiphong->id)->delete();

        $loaiphong->delete();

        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }


}

