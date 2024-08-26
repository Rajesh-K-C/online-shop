@extends('layouts.base')

@section('title', 'Products page')

@section('content')
    <div class="container">
        <!-- Categories Section Begin -->
        <section class="categories">
            <h1 class="h3 mb-4 text-center text-gray-800">Products</h1>
            <div class="row">
                @forelse($data['products'] as $product)
                    <a href="{{route('product', $product->slug)}}">
                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                     data-setbg="{{asset('assets/images/product/'. $product->image)}}">
                                    @if($product->discount_percent > 0)
                                        <div class="product__discount__percent">
                                            -{{formatFloat($product->discount_percent)}}%
                                        </div>
                                    @endif
                                    {{--                                    <ul class="product__item__pic__hover">--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    {{--                                    </ul>--}}
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="#">{{$product->name}}</a></h5>
                                    @if($product->discount_percentage > 0)
                                        <div class="product__item__price">
                                            Rs. {{formatFloat(($product->price/100) * (100 - $product->discount_percentage))}}
                                            <span>Rs. {{formatFloat($product->price)}}
                                        </span>
                                        </div>
                                    @else
                                        <div class="product__item__price">Rs. {{formatFloat($product->price)}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Products are not available</p>
                @endforelse
            </div>
        </section>
        <!-- Categories Section End -->
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
