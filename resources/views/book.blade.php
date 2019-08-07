@include('header')
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-5 col-md-6 col-lg-offset-3">
            <form action="{{route('datphongluon')}}" class="wowload fadeInRight" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="Name" name="hoten" value="{{old('hoten')}}">
                </div>
                @if ($errors->has('hoten'))
                    <div class="alert alert-danger">
                        {{ $errors->first('hoten') }}
                    </div>
                @endif
                <div class="form-group">
                    <input type="email" class="form-control"  placeholder="Email" name="email" value="{{old('email')}}">
                </div>
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <div class="form-group">
                    <input type="text" class="form-control"  placeholder="Phone" name="sdt" value="{{old('sdt')}}">
                </div>
                @if ($errors->has('sdt'))
                    <div class="alert alert-danger">
                        {{ $errors->first('sdt') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Phòng Bạn Đặt</label>
                    <img src="anhdaidien/{{$phong->anhdaidien}}" name="id_phongdat" alt="">
                </div>
                <div class="form-group">
                    <label>Giá Phòng / Đêm : ${{$phong->giatien}}</label>
                </div>
                <br>
                <div class="form-group">
                    <label>Book Date :</label>
                    <input type="date" min="today" onchange="calculate()" class="form-control" name="ngayden" id="date1" value="{{old('ngayden')}}">
                </div>
                @if ($errors->has('ngayden'))
                    <div class="alert alert-danger">
                        {{ $errors->first('ngayden') }}
                    </div>
                @endif
                <div class="form-group">
                    <label>Leave Date :</label>
                    <input type="date" min="today" onchange="calculate()" class="form-control" name="ngaytra" id="date2" value="{{old('ngaytra')}}">
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
                    <textarea class="form-control" name="ghichu" placeholder="Ghi chú" rows="5"></textarea>
                </div>
                <button class="btn btn-default" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<br>

<script type="text/javascript">
        function calculate(){
            var date1 = new Date($("#date1").val());
            var date2 = new Date($("#date2").val());

            var diffdate = parseInt((date2 - date1) / (24 * 3600 * 1000));
            var giatienphong = parseInt($('#giatienphong').val());

            var tongtien = diffdate * giatienphong;

            //check de tranh loi NaN
            if ($('#date1').val() != '' && $('#date2').val() != '')
            {
                $('#tongtien').val(tongtien);
            }
        }
</script>

@include('footer')

