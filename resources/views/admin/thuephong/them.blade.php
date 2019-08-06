@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Thuê Phòng

                    </h1>
                </div>
                <!-- /.col-lg-12 -->

                <div class="col-lg-7" style="padding-bottom:120px">
                    {{--@if(count($errors) > 0)--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--@foreach($errors->all() as $err)--}}
                                {{--{{$err}}<br>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>

                    @endif

                    <form action="admin/thuephong/them" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ Tên Khách Hàng</label>
                            <input class="form-control" name="hoten" placeholder="Please Enter Username" value="{{old('hoten')}}" />
                            @if ($errors->has('hoten'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('hoten') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" placeholder="Please Enter email" value="{{old('email')}}" />
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" name="sdt" placeholder="Please Enter phone" value="{{old('sdt')}}" />
                            @if ($errors->has('sdt'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('sdt') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Phòng</label>
                            <select class="form-control" name="id_phong">
                                <option value="0">Chọn Phòng</option>
                                @foreach($phong as $p)
                                    <option  value="{{$p->id}}">{{$p->tenphong}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nhân Viên Quyết Toán</label>
                            <select class="form-control" name="id_nhanvien">
                                <option value="0">Chọn Nhân Viên</option>
                                @foreach($nhanvien as $nv)
                                    <option  value="{{$nv->id}}">{{$nv->hoten}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ngày Đến</label>
                            <input class="form-control" type="date" min="today" rows="3" name="ngayden" value="{{old('ngayden')}}">
                        </div>
                        @if ($errors->has('ngayden'))
                            <div class="alert alert-danger">
                                {{ $errors->first('ngayden') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Ngày Trả</label>
                            <input class="form-control" type="date" rows="3" min="today" name="ngaytra" value="{{old('ngaytra')}}">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea class="form-control" type="text" name="ghichu" >{{old('ngaytra')}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Save</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>

                </div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection