@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Sửa Phòng

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

                    <form action="admin/phong/sua/{{$phong->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên Phòng</label>
                            <input class="form-control" name="tenphong" placeholder="Please Enter Room Name" value="{{$phong->tenphong}}" />
                            @if ($errors->has('tenphong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('tenphong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Loại Phòng</label>
                            <select class="form-control" name="id_loaiphong">
                                @foreach($loaiphong as $lp)
                                    <option
                                            @if($phong->id_loaiphong == $lp->id)
                                            {{'selected'}}
                                            @endif
                                            value="{{$lp->id}}">{{$lp->tenloaiphong}}
                                    </option>
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
                                <input name="tinhtrang" value="1"
                                       @if($phong->tinhtrang == 1)
                                               {{'checked'}}
                                       @endif
                                   type="radio">Đầy
                            </label>
                            <label class="radio-inline">
                                <input name="tinhtrang" value="0"
                                       @if($phong->tinhtrang == 0)
                                       {{'checked'}}
                                       @endif
                                   type="radio">Trống
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Thông Tin</label>
                            <textarea rows="5" id="demo" cols="15" class="form-control ckeditor" type="text" name="thongtin" placeholder="Please Enter Information" >{{$phong->thongtin}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Giá Tiền</label>
                            <input class="form-control" name="giatien" min="0" placeholder="Please Enter Room Price" value="{{$phong->giatien}}" />
                            @if ($errors->has('giatien'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('giatien') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ảnh Đại Diện</label>
                            <input class="form-control" name="anhdaidien" type="file" id="change_image" />

                            <div>
                                <p>Ảnh Cũ :</p>
                                <img width="300px" height="200px" src="anhdaidien/{{$phong->anhdaidien}}" alt="">
                            </div>
                            <br>
                            <div id="new_image">
                                <p>Ảnh Mới:</p>
                                <img src="" width="300px" height="200px" id="demo_image"  alt="">
                                <span id="X" style="color: red; cursor: pointer; font-size: 1.5em">X</span>
                            </div>
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
            $('#new_image').show();
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

        $('#X').click(function () {
            $('#new_image').hide();
            $('#change_image').val('');
        });

    </script>

@endsection