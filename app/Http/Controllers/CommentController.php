<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function postComment(Request $request)
    {
        $this->validate($request,
            [
                'id_khachhang'  =>  'required',
                'id_phong'  =>  'required',
                'noidung'   =>  'nullable'
            ],
            [
                'id_khachhang.required' => 'Mời chọn khách hàng',
                'id_phong.required' => 'Mời chọn phòng',
            ]);

        $comment = new Comment();
        $comment->id_khachhang = $request->id_khachhang;
        $comment->id_phong = $request->id_phong;
        $comment->noidung = $request->noidung;
        $comment->save();

        return redirect()->back();
    }

}
