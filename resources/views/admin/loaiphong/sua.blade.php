@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Sửa Loại Phòng

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

                    <form action="admin/loaiphong/sua/{{$loaiphong->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Tên Loại Phòng</label>
                            <input class="form-control" name="tenloaiphong" placeholder="Please Enter Room Type" value="{{$loaiphong->tenloaiphong}}" />
                            @if ($errors->has('loaiphong'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('loaiphong') }}
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