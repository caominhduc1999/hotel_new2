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
                            <input class="form-control" type="file" id="upload_file" name="tenanh[]" onchange="preview_image();" multiple/>
                            {{-- 1 image: name = tenanh | multiple images : name = tenanh[]--}}
                            <br>
                            <span id="X" style="color: red; cursor: pointer; font-size: 1.2em; border: 1px red solid">Choose Images Again</span>
                            <br>
                            <div id="image_preview"></div>
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

    {{----------------------- For 1 image ----------------------------------------------}}

    {{--<script>--}}
        {{--function readURL(input) {--}}
            {{--if (input.files && input.files[0]) {--}}
                {{--var reader = new FileReader();--}}

                {{--reader.onload = function (e) {--}}
                    {{--$('#demo_image').attr('src', e.target.result);--}}
                {{--}--}}
                {{--reader.readAsDataURL(input.files[0]);--}}
            {{--}--}}

        {{--}--}}
        {{--$("#change_image").change(function(){--}}
            {{--readURL(this);--}}
            {{--$('#demo_image').show();--}}
        {{--});--}}


        {{--$('#X').click(function () {--}}
            {{--$('#demo_image').hide();--}}
            {{--$('#change_image').val('');--}}
        {{--});--}}

    {{--</script>--}}

    {{----------------------------------------------------------------------------------}}
    <script>
        function preview_image()
        {
            var total_file=document.getElementById("upload_file").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#image_preview').append("<br><img class='oneimage' width='200px' src='"+URL.createObjectURL(event.target.files[i])+"'><br><br>");
            }

            $('#X').click(function () {
                $('.oneimage').hide();
                $('#upload_file').val('');
            });
        }
    </script>
@endsection