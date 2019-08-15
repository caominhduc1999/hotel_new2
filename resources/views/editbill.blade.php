@include('header')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-md-6 col-lg-offset-3">
            <form action="customer/bill/edit/{{$thuephong->id}}" method="POST">
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-group">
                    <label>Ngày Đến</label>
                    <input class="form-control" type="date" min="today" rows="3" name="ngayden" value="{{$thuephong->ngayden}}">
                </div>
                @if ($errors->has('ngayden'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ngayden') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Ngày Trả</label>
                    <input class="form-control" type="date" rows="3" min="today" name="ngaytra" value="{{$thuephong->ngaytra}}">
                </div>
                @if ($errors->has('ngaytra'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ngaytra') }}
                    </div>
            @endif
                <div class="form-group">
                    <label>Ghi Chú</label>
                        <textarea class="form-control"  rows="3" name="ghichu">{{$thuephong->ghichu}}</textarea>
                </div>
                <button type="submit" class="btn btn-default">Save</button>

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