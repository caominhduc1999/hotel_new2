@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Admin

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

                    <form action="admin/danhsachadmin/them" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input class="form-control" rows="3" name="fullname" value="{{old('fullname')}}">
                            @if ($errors->has('fullname'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('fullname') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Please Enter Email" value="{{old('email')}}" />
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="Please Enter Password"  />
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password Again</label>
                            <input class="form-control" type="password" name="passwordAgain" placeholder="Please Enter Password Again" />
                            @if ($errors->has('passwordAgain'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('passwordAgain') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" rows="3" name="phone" value="{{old('phone')}}">
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('phone') }}
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