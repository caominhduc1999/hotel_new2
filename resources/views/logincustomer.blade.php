@include('header')


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login Customer</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            @if(session('thongbao'))
                                <div class="alert alert-danger">
                                    {{session('thongbao')}}
                                </div>

                            @endif
                            <button type="submit" class="btn btn-lg btn-success btn-block">Đăng Nhập</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('footer')