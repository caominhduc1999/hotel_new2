@include('header')


<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-md-6 col-lg-offset-3">
            <h2>Thông Tin Khách Hàng</h2>
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <form action="{{action('PageController@postDetail',['id'=>$khachhang->id])}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label>Họ Tên</label>
                    <input class="form-control" name="hoten" placeholder="Please Enter Username" value="{{$khachhang->hoten}}" />
                    @if ($errors->has('hoten'))
                        <div class="alert alert-danger">
                            {{ $errors->first('hoten') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input class="form-control" type="text" name="sdt" placeholder="Please Enter phone" value="{{$khachhang->sdt}}" />
                    @if ($errors->has('sdt'))
                        <div class="alert alert-danger">
                            {{ $errors->first('sdt') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Please Enter email" value="{{$khachhang->email}}" />
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input class="form-control" type="text" name="diachi" placeholder="Please Enter Address" value="{{$khachhang->diachi}}"/>
                </div>
                <div class="form-group">
                    <label>Căn cước công dân</label>
                    <input class="form-control" rows="3" name="cccd" value="{{$khachhang->cccd}}">
                </div>
                <div class="form-group">
                    <label>Quốc Tịch</label>
                    <input class="form-control" rows="3" name="quoctich" value="{{$khachhang->quoctich}}">
                </div>

                <div class="form-group">
                    <label>Giới tính</label>
                    <label class="radio-inline">
                        <input name="gioitinh" value="1"
                               @if($khachhang->gioitinh == 1)
                               {{'checked'}}
                               @endif
                               type="radio">Nam
                    </label>
                    <label class="radio-inline">
                        <input name="gioitinh" value="2"
                               @if($khachhang->gioitinh == 2)
                               {{'checked'}}
                               @endif
                               type="radio">Nữ
                    </label>
                </div>

                <div class="form-group">
                    <label>Ngày Sinh</label>
                    <input class="form-control" type="date" min="1950-01-01" max="2020-01-01" rows="3" name="ngaysinh" value="{{$khachhang->ngaysinh}}">
                    @if ($errors->has('ngaysinh'))
                        <div class="alert alert-danger">
                            {{ $errors->first('ngaysinh') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-default">Save</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@include('footer')