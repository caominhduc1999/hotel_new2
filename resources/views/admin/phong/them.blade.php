@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Phòng

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

                    <form action="admin/phong/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên Phòng</label>
                            <input class="form-control" type="text" name="tenphong" placeholder="Please Enter Rooom Name" value="{{old('tenphong')}}" />
                            @if ($errors->has('tenphong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('tenphong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Loại Phòng</label>
                            <select class="form-control" name="id_loaiphong">
                                <option value="">Chọn Loại Phòng</option>
                                @foreach($loaiphong as $lp)
                                    <option  value="{{$lp->id}}">{{$lp->tenloaiphong}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_loaiphong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('id_loaiphong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tình Trạng</label>
                            <label class="radio-inline">
                                <input name="tinhtrang" value="1"  checked="" type="radio"
                                @if(old('tinhtrang') == 1)
                                    {{'checked'}}
                                @endif
                                >Đầy
                            </label>
                            <label class="radio-inline">
                                <input name="tinhtrang" value="2" type="radio"
                                @if(old('tinhtrang') == 2)
                                    {{'checked'}}
                                        @endif
                                >Trống
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Thông Tin</label>
                            <textarea rows="5" id="demo" cols="15" class="form-control ckeditor" type="text" name="thongtin" placeholder="Please Enter Information" >{{old('thongtin')}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Giá Tiền / Đêm</label>
                            <input class="form-control" type="number" min="0" name="giatien" placeholder="Please Enter Rooom Price" value="{{old('giatien')}}" />
                            @if ($errors->has('giatien'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('giatien') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ảnh Đại Diện</label>
                            <input class="form-control" name="anhdaidien" type="file" id="change_image"/>
                            <img src="" id="demo_image" width="200px" />
                            @if ($errors->has('anhdaidien'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('anhdaidien') }}
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

@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#demo_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }

        }
        $("#change_image").change(function(){
            readURL(this);
        });
    </script>

@endsection