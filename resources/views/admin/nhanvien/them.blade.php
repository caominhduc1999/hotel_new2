@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Nhân Viên

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

                    <form action="admin/nhanvien/them" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Họ Tên</label>
                            <input class="form-control" name="hoten" placeholder="Please Enter Username" value="{{old('hoten')}}" />
                            @if ($errors->has('hoten'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('hoten') }}
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
                            <label>Địa chỉ</label>
                            <input class="form-control" type="text" name="diachi" placeholder="Please Enter Address" value="{{old('diachi')}}"/>
                        </div>
                        <div class="form-group">
                            <label>Căn cước công dân</label>
                            <input class="form-control" rows="3" name="cccd" value="{{old('cccd')}}">
                        </div>
                        <div class="form-group">
                            <label>Giới tính</label>
                            <label class="radio-inline">
                                <input name="gioitinh" value="1"  checked="" type="radio">Nam
                            </label>
                            <label class="radio-inline">
                                <input name="gioitinh" value="2" type="radio">Nữ
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Ngày Sinh</label>
                            <input class="form-control" type="date" min="1950-01-01" max="2020-01-01" rows="3" name="ngaysinh" value="{{old('ngaysinh')}}">
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection