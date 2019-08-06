@extends('admin.layout.index')


@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Sửa Admin

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

                    <form action="admin/danhsachadmin/sua/{{$admin->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input class="form-control" rows="3" name="fullname" value="{{$admin->fullname}}">
                            @if ($errors->has('fullname'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fullname') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Please Enter Email" value="{{$admin->email}}" />
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" rows="3" name="phone" value="{{$admin->phone}}">
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>



                        <button id="save" type="submit" class="btn btn-default">Save</button>
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

