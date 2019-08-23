@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Sửa Hoá Đơn

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

                    <form action="admin/hoadon/sua/{{$hoadon->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Nhân Viên Quyết Toán</label>
                            <select class="form-control" name="id_nhanvien">
                                <option value="">Chọn Nhân Viên</option>
                                @foreach($nhanvien as $nv)
                                    <option
                                            @if($hoadon->id_nhanvien == $nv->id)
                                            {{'selected'}}
                                            @endif
                                            value="{{$nv->id}}">{{$nv->hoten}}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_nhanvien'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('id_nhanvien') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ngày Thanh Toán</label>
                            <input type="date" min="today" class="form-control" name="ngaythanhtoan" value="{{old('ngaythanhtoan')}}">
                        </div>
                        @if ($errors->has('ngaythanhtoan'))
                            <div class="alert alert-danger">
                                {{ $errors->first('ngaythanhtoan') }}
                            </div>
                        @endif

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