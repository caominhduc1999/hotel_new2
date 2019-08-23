<?php

namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\KhachHangController;
class ContactController extends Controller
{
    public function getdanhsach()
    {
        $contact=Contact::paginate(5);
        return view('admin.contact.danhsach',['contact'=>$contact]);
    }
    public function getthem()
    {
       return view('contact');
    }
    public function getxoa($id)
    {
        $contact= Contact::find($id);
        DB::table('contacts')->where('id',$contact->id)->delete();
        $contact->delete();
        return redirect()->back()->with('thông báo','xóa thành công');
    }
    public function postthem(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'sdt'=>'required',
            'content'=>'required'
        ],[
            'name.required'=>'bạn chưa nhập tên',
            'email.required'=>'bạn chưa nhập email',
            'email.email'=>'kiểm tra lại email của bạn',
            'sdt.required'=>'bạn chưa nhập số điện thoại',
            'content.required'=>'bạn chưa nhập content',
        ]);
        $contact= new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->sdt=$request->sdt;
        $contact->content=$request->content;
        $contact->save();
        return redirect()->back()->with('thongbao','Chúng tôi đã nhận đc yêu cầu. Vui lòng chờ xác nhận');
    }
    
}
