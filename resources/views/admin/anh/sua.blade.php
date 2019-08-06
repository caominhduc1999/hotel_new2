@extends('admin.layout.index')


@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Sửa Ảnh

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

                    <form action="admin/anh/sua/{{$anh->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Phòng chứa ảnh</label>
                            <select class="form-control" name="id_phong">
                                @foreach($phong as $p)
                                    <option
                                            @if($anh->id_phong == $p->id)
                                            {{'selected'}}
                                            @endif
                                            value="{{$p->id}}">{{$p->tenphong}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_loaiphong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('id_loaiphong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input class="form-control" name="tenanh" type="file" id="change_image" />

                            <div>
                                <p>Ảnh Cũ :</p>
                                <img width="300px" height="200px" src="images/{{$anh->tenanh}}" alt="">
                            </div>
                            <br>
                            <div id="new_image">
                                <p>Ảnh Mới:</p>
                                <img src="" width="300px" height="200px" id="demo_image"  alt="">
                                <span id="X" style="color: red; cursor: pointer; font-size: 1.5em">X</span>
                            </div>
                        </div>

                        <button id="save" type="submit" class="btn btn-default">Save</button>
                        <button type="reset" id="reset" class="btn btn-default">Reset</button>

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