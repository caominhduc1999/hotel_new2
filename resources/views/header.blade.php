<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Holiday Crown | Best hotel in Dubai</title>

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>

    <!-- font awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <base href="{{asset('')}}">

    <!-- bootstrap -->
    <link rel="stylesheet" href="hotel_asset/assets/bootstrap/css/bootstrap.min.css" />

    <!-- uniform -->
    <link type="text/css" rel="stylesheet" href="hotel_asset/assets/uniform/css/uniform.default.min.css" />

    <!-- animate.css -->
    <link rel="stylesheet" href="hotel_asset/assets/wow/animate.css" />


    <!-- gallery -->
    <link rel="stylesheet" href="hotel_asset/assets/gallery/blueimp-gallery.min.css">


    <!-- favicon -->
    <link rel="shortcut icon" href="hotel_asset/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="hotel_asset/images/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="hotel_asset/assets/style.css">

</head>

<body id="home">


<!-- top
  <form class="navbar-form navbar-left newsletter" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Your Email Id Here">
        </div>
        <button type="submit" class="btn btn-inverse">Subscribe</button>
    </form>
 top -->

<!-- header -->
<nav class="navbar  navbar-default" role="navigation">
    <div class="container" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index"><img src="hotel_asset/images/logo.png"  alt="holiday crown"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <div style="position: relative; display:flex;justify-content: flex-end">
                @if(Auth::guard('khachhang')->check())
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary">Hello&nbsp;&nbsp;<a style="color: blue;" href="customer/detail/{{Auth::guard('khachhang')->user()->id}}">{{Auth::guard('khachhang')->user()->hoten}}</a></button>
                        <button type="button" class="btn btn-secondary"><div><a style="color: green; " href="customer/bill/{{Auth::guard('khachhang')->user()->id}}">Đặt Phòng Của Bạn</a></div></button>
                        <button type="button" class="btn btn-secondary"><div><a style="color: red" href="customer/dangxuat">LogOut</a></div></button>
                    </div>
                @else
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <div><a style="color: grey;" href="customer/dangnhap"><button type="button" class="btn btn-secondary">Login</button></a></div>
                    </div>
                @endif
            </div>

            <ul class="nav navbar-nav">
                <li><a href="index">Home </a></li>
                <li><a href="rooms_tariff">Rooms & Tariff</a></li>
                <li><a href="introduction">Introduction</a></li>
                <li><a href="gallery">Gallery</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>


        </div><!-- Wnavbar-collapse -->
    </div><!-- container-fluid -->
</nav>
<!-- header -->

