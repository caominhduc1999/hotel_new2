@include('header')

    

<div class="container">

    <h1 class="title">Contact </h1>


    <!-- form -->
    <div class="contact">
        @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}}
        </div>
          @endif


        <div class="row">

            <div class="col-sm-12">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9933.460884430251!2d-0.13301252240929382!3d51.50651527467666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2snp!4v1414314152341" width="100%" height="300" frameborder="0"></iframe>
                </div>

 @section('content')
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="spacer">

                        <h4>Write to us</h4>
                    <form role="form" action="{{action('ContactController@postthem')}}" method="POST" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" placeholder="Name" name='name' value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                             @endif
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name='email' placeholder="Enter email"value="{{old('mail')}}">
                                @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                 @endif
                            </div>
                            <div class="form-group">
                                <input type="phone" class="form-control" id="phone" name='sdt' placeholder="Phone" value="{{old('phone')}}">
                                @if ($errors->has('sdt'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('sdt') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea type="text" class="form-control" name="content" placeholder="Message" rows="4" value="{{old('content')}}"></textarea>
                                @if ($errors->has('text'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            </div>

                            <button type="submit" class="btn btn-default">Send</button>
                        </form>
                    </div>


                </div>





            </div>
        </div>
    </div>
    <!-- form -->

</div>
@show
@include('footer')