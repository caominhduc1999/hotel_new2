@include('header')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-md-6 col-lg-offset-3">
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                    <br>
                    <?php
                        echo '<script type="text/javascript">setTimeout(function(){window.location="customer/dangnhap"} , 1000);</script>';
                    ?>
                </div>
            @endif
            <form action="{{action('PageController@postRegister')}}" class="wowload fadeInRight" method="post">
                @csrf
                <form action="admin/khachhang/them" method="POST">
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
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Please Enter email" value="{{old('email')}}" />
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Please Enter Password"/>
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password Again</label>
                        <input class="form-control" type="password" name="passwordAgain" placeholder="Please Enter Password"/>
                        @if ($errors->has('passwordAgain'))
                            <div class="alert alert-danger">
                                {{ $errors->first('passwordAgain') }}
                            </div>
                        @endif
                    </div>

                    <button class="btn btn-default" type="submit">Submit</button>
                </form>

            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>


@include('footer')

