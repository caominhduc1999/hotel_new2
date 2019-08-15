<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Anh;
use App\Phong;
use Illuminate\Support\Facades\DB;

class AnhController extends Controller
{
    //
    public function getSearch(Request $request)
    {
        $key = $request->key;

        $get_tenphong = Phong::where('tenphong','like','%'.$key.'%')->pluck('id')->all();


        foreach ($get_tenphong as $id_tenphong)
        {
            $search = Anh::where('id_phong','=',$id_tenphong)->get();
            if ($search)
            {
                return view('admin.anh.timkiem',['search'=>$search]);
            }
        }

        //co tinh tim id = -1 de tra ve 0 doi tuong tim kiem
        $search = Anh::where('id','=','-1')->get();
        return view('admin.anh.timkiem',['search'=>$search]);
    }

    public function getDanhSach()
    {
        $danhsachanh = Anh::orderBy('id')->paginate(5);
        return view('admin.anh.danhsach',['danhsachanh' => $danhsachanh]);
    }

    public function getThem()
    {
        $phong = Phong::all();
        return view('admin.anh.them',['phong'=>$phong]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'id_phong'  =>  'required',
                'tenanh'  =>  'required'
            ],
            [
                'id_phong.required'     =>  'Vui lòng nhập phòng chứa ảnh này',
                'tenanh.required'     =>  'Vui lòng nhập ảnh',

            ]);


        if ($request->hasFile('tenanh'))
        {
            $files = $request->file('tenanh');

            foreach ($files as $item) {

                $anh = new Anh();
                $anh->id_phong = $request->id_phong;

                $tenanh = rand().'.'.$item->getClientOriginalExtension();
                //dam bao khong random trung nhau
                while(file_exists('images/'.$tenanh))
                {
                    $tenanh = rand().'.'.$item->getClientOriginalExtension();
                }
                $item->move(public_path('images'), $tenanh);
                $anh->tenanh = $tenanh;

                $anh->save();
            }
        }



        return redirect('admin/anh/them')->with('thongbao','Thêm thành công');

    }

    public function getSua($id)
    {
        $anh = Anh::find($id);
        $phong = Phong::all();
        return view('admin.anh.sua',['anh'=>$anh, 'phong'=>$phong]);
    }

    public function postSua(Request $request, $id)
    {
        $anh = Anh::find($id);

        $this->validate($request,
            [
                'id_phong'  =>  'required',
            ],
            [
                'id_phong.required'     =>  'Vui lòng nhập phòng chứa ảnh này',

            ]);

        $anh->id_phong = $request->id_phong;
        $image_path = 'images/'.$anh->tenanh;

        //neu doi anh moi
        if ((request()->tenanh)){
            $tenanh = rand().'.'.request()->tenanh->getClientOriginalExtension();
            while(file_exists('images/'.$tenanh))
            {
                $tenanh = rand().'.'.request()->tenanh->getClientOriginalExtension();
            }
            request()->tenanh->move(public_path('images'), $tenanh);
            $anh->tenanh = $tenanh;

            //xoa anh cu
            unlink($image_path);
        }

        $anh->save();

        return redirect('admin/anh/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $anh = Anh::find($id);
        $image_path = 'images/'.$anh->tenanh;
        $anh->delete();
        if (isset($image_path))
        {
            unlink($image_path);
        }


        return redirect()->back()->with('thongbao', 'Xóa thành công');
    }


}

