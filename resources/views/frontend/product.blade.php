@extends('layouts.base')

@section('title', $data['product']->name . ' | ')

@section('content')
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        @include('components.flash_message')
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{asset('assets/images/product/' . $data['product']->image)}}" alt="">
                    </div>
                    {{-- <div class="product__details__pic__slider owl-carousel">--}}
                        {{-- <img data-imgbigurl="img/product/details/product-details-2.jpg" --}} {{--
                            src="img/product/details/thumb-1.jpg" alt="">--}}
                        {{-- <img data-imgbigurl="img/product/details/product-details-3.jpg" --}} {{--
                            src="img/product/details/thumb-2.jpg" alt="">--}}
                        {{-- <img data-imgbigurl="img/product/details/product-details-5.jpg" --}} {{--
                            src="img/product/details/thumb-3.jpg" alt="">--}}
                        {{-- <img data-imgbigurl="img/product/details/product-details-4.jpg" --}} {{--
                            src="img/product/details/thumb-4.jpg" alt="">--}}
                        {{-- </div>--}}
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$data['product']->name}}</h3>
                    {{-- <div class="product__details__rating">--}}
                        {{-- <i class="fa fa-star"></i>--}}
                        {{-- <i class="fa fa-star"></i>--}}
                        {{-- <i class="fa fa-star"></i>--}}
                        {{-- <i class="fa fa-star"></i>--}}
                        {{-- <i class="fa fa-star-half-o"></i>--}}
                        {{-- <span>(18 reviews)</span>--}}
                        {{-- </div>--}}
                    @if($data['product']->discount_percentage > 0)
                        <div class="product__item__price product__details__price">
                            Rs.
                            {{formatFloat(($data['product']->price / 100) * (100 - $data['product']->discount_percentage))}}
                            <span style="text-decoration: line-through">
                                Rs. {{formatFloat($data['product']->price)}}
                            </span>
                        </div>
                    @else
                        <div class="product__item__price product__details__price">
                            Rs. {{formatFloat($data['product']->price)}}</div>
                    @endif
                    {{-- <div class="product__details__price">Rs. 50.00</div>--}}
                    <p>{{$data['product']->short_description}}</p>
                    <form action="{{route('add-to-cart')}}" method="post">
                        @csrf
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="quantity" id="quantity" readonly
                                        value="{{$data['product']->stock > 0 ? '1' : '0'}}" min="1"
                                        max="{{$data['product']->stock}}">
                                    <input type="hidden" name="product_id" value="{{$data['product']->id}}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn primary-btn">ADD TO CART</button>
                    </form>
                    {{-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>--}}
                    <ul>
                        <li><b>Availability</b> <span>
                                @if ($data['product']->stock > 0)
                                    In Stock
                                @else
                                    <span class='text-danger'> Out of Stock</span>
                                @endif
                            </span>
                        </li>
                        <li><b>Shipping</b> <span>01 day shipping. </span></li>
                        <!-- <li><b>Total</b> <span>0.5 kg</span></li> -->
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <!-- <h6>Products Infomation</h6> -->
                                <p style="white-space: pre-wrap;">{{ $data['product']->description }}</p>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
@endsection