@include('header')
<div class="container">

    <h1 class="title">Gallery</h1>
    <div class="row gallery">
        @foreach($anh as $a)
            <div class="col-sm-4 wowload fadeInUp"><a href="images/{{$a->tenanh}}" title="Travel" class="gallery-image" data-gallery><img src="images/{{$a->tenanh}}" class="img-responsive"></a></div>
        @endforeach
    </div>
</div>
@include('footer')