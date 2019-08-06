@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Ảnh

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

                    <form action="admin/anh/them" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Chọn Phòng chứa Ảnh</label>
                            <select class="form-control" name="id_phong">
                                <option value="">Chọn Phòng</option>
                                @foreach($phong as $p)
                                    <option  value="{{$p->id}}">{{$p->tenphong}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_phong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('id_phong') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input class="form-control" name="tenanh" type="file" id="change_image"/>
                            <img src="" id="demo_image" width="200px" />
                            @if ($errors->has('tenanh'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('tenanh') }}
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