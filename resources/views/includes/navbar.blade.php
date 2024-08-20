<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a class="text-black-50 font-weight-bold" href="{{route('index')}}">
            <!-- {{$data['setting']->website_name}} -->
            <img style="height: 4rem" src="{{asset('assets/images/setting/' . $data['setting']->logo)}}" alt="">
            {{-- <img src="{{asset('assets/frontend/img/logo.png')}}" alt="">--}}
        </a>
    </div>
    @if(Auth::check() && Auth::user()->hasPermissionTo('order'))
        <div class="humberger__menu__cart">
            <ul>
{{--                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>--}}
                <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i></a></li>
            </ul>
{{--            <div class="header__cart__price">item: <span>$150.00</span></div>--}}
        </div>
    @endif
    <div class="humberger__menu__widget">
        {{-- <div class="header__top__right__language">--}}
        {{-- <img src="{{asset('assets/frontend/img/language.png')}}" alt="">--}}
        {{-- <div>English</div>--}}
        {{-- <span class="arrow_carrot-down"></span>--}}
        {{-- <ul>--}}
        {{-- <li><a href="#">Spanis</a></li>--}}
        {{-- <li><a href="#">English</a></li>--}}
        {{-- </ul>--}}
        {{-- </div>--}}
        <div class="header__top__right__auth">
            @auth
                {{--                <a href="{{ route('home') }}"> Dashboard </a>--}}
                <form action="{{route('logout')}}" style="display: inline-block" method="post">
                    @csrf
                    <button type="submit" title="Logout" style="margin: 0; padding: 0; outline: none; border: none;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
            @endauth
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{route('index')}}">Home</a></li>
            <li><a href="{{route('products')}}">Products</a></li>
{{--            <li><a href="#">Pages</a>--}}
{{--                <ul class="header__menu__dropdown">--}}
{{--                    <li><a href="#">Shop Details</a></li>--}}
{{--                    --}}{{--                    <li><a href="#">Shopping Cart</a></li>--}}
{{--                    <li><a href="#">Check Out</a></li>--}}
{{--                    <li><a href="#">Blog Details</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li><a href="{{route('contact')}}">Contact</a></li>
            @if(Auth::check())
                @if(Auth::user()->hasRole('user'))
                    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                @else
                    <li><a href="{{route('home')}}">Dashboard</a></li>
                @endif
            @endif
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        @if($data['setting']->facebook_link)
            <a href="{{$data['setting']->facebook_link }}" target="_break"><i class="fa fa-facebook"></i></a>
        @endif
        @if($data['setting']->twitter_link)
            <a href="{{$data['setting']->twitter_link }}" target="_break"><i class="fa fa-twitter"></i></a>
        @endif
        @if($data['setting']->instagram_link)
            <a href="{{$data['setting']->instagram_link }}" target="_break"><i class="fa fa-instagram"></i></a>
        @endif
        @if($data['setting']->youtube_link)
            <a href="{{$data['setting']->youtube_link }}" target="_break"><i class="fa fa-youtube"></i></a>
        @endif
        <!-- @if($data['setting']->instagram_link)
            <a href="{{$data['setting']->instagram_link }}" target="_break"><i class="fa fa-instagram"></i></a>
        @endif -->
        <!-- <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a> -->
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{$data['setting']->email}}</li>
{{--            <li>Free Shipping for all Order of $99</li>--}}
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{$data['setting']->email}}</li>
{{--                            <li>Free Shipping for all Order of $99</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            @if($data['setting']->facebook_link)
                                <a href="{{$data['setting']->facebook_link }}" target="_break"><i
                                        class="fa fa-facebook"></i></a>
                            @endif
                            @if($data['setting']->twitter_link)
                                <a href="{{$data['setting']->twitter_link }}" target="_break"><i
                                        class="fa fa-twitter"></i></a>
                            @endif
                            @if($data['setting']->instagram_link)
                                <a href="{{$data['setting']->instagram_link }}" target="_break"><i
                                        class="fa fa-instagram"></i></a>
                            @endif
                            @if($data['setting']->youtube_link)
                                <a href="{{$data['setting']->youtube_link }}" target="_break"><i
                                        class="fa fa-youtube"></i></a>
                            @endif
                        </div>
                        {{-- <div class="header__top__right__language">--}}
                        {{-- <img src="{{asset('assets/frontend/img/language.png')}}" alt="">--}}
                        {{-- <div>English</div>--}}
                        {{-- <span class="arrow_carrot-down"></span>--}}
                        {{-- <ul>--}}
                        {{-- <li><a href="#">Spanis</a></li>--}}
                        {{-- <li><a href="#">English</a></li>--}}
                        {{-- </ul>--}}
                        {{-- </div>--}}
                        <div class="header__top__right__auth">
                            @auth
                                {{--                                <a href="{{ route('home') }}"> Dashboard </a>--}}
                                <form action="{{route('logout')}}" style="display: inline-block" method="post">
                                    @csrf
                                    <button type="submit" title="Logout"
                                            style="margin: 0; padding: 0; outline: none; border: none;">Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a class="text-black-50 font-weight-bold" href="{{route('index')}}">
                        {{$data['setting']->website_name}}
                        {{-- <img src="{{asset('assets/frontend/img/logo.png')}}" alt="">--}}
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li><a href="{{route('products')}}">Products</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        @if(Auth::check())
                            @if(Auth::user()->hasRole('user'))
                                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                            @else
                                <li><a href="{{route('home')}}">Dashboard</a></li>
                            @endif
                        @endif
                    </ul>
                </nav>
            </div>
            @if(Auth::check() && Auth::user()->hasPermissionTo('order'))
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
{{--                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>--}}
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-bag"></i></a></li>
                        </ul>
{{--                        <div class="header__cart__price">item: <span>$150.00</span></div>--}}
                    </div>
                </div>
            @endif
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
