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
                    <input class="form-control" onchange="calculate()" type="date" min="today" rows="3" name="ngayden" id="date1" value="{{$thuephong->ngayden}}">
                </div>
                @if ($errors->has('ngayden'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ngayden') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Ngày Trả</label>
                    <input class="form-control" onchange="calculate()" type="date" rows="3" min="today" name="ngaytra" id="date2" value="{{$thuephong->ngaytra}}">
                </div>
                @if ($errors->has('ngaytra'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ngaytra') }}
                    </div>
                @endif
                <div class="form-group">
                    <input type="hidden" id="giatienphong" value="{{intval($phong->giatien)}}">
                    <div>
                        Tổng Tiền Thanh Toán Dự Tính: $ <input style="background-color: transparent;
border: 0px solid;
height: 20px;
width: 160px;
color: gray;
font-size: 1.5em" readonly id="tongtien" name="tongtien">
                        {{--use readonly instead of disabled (disabled will not submit data)--}}
                    </div>
                </div>
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

<script type="text/javascript">
    function calculate(){
        var date1 = new Date($("#date1").val());
        var date2 = new Date($("#date2").val());

        var diffdate = parseInt((date2 - date1) / (24 * 3600 * 1000));

        if (diffdate < 0)
        {
            tongtien = 0;
        }
        else{
            var giatienphong = parseInt($('#giatienphong').val());

            var tongtien = diffdate * giatienphong;
        }


        //check de tranh loi NaN
        if ($('#date1').val() != '' && $('#date2').val() != '')
        {
            $('#tongtien').val(tongtien);
        }
    }
</script>