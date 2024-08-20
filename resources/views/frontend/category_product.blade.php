@extends('layouts.base')

@section('title', $data['category']->name .' | ')

@section('content')
    <div class="container">
        <!-- Categories Section Begin -->
        <section class="categories">
            <h1 class="h3 mb-4 text-center text-gray-800">Category: {{$data['category']->name}}</h1>
            <div class="row">
                @forelse($data['records'] as $record)
                    <a href="{{route('product', $record->slug)}}">
                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                     data-setbg="{{asset('assets/images/product/'. $record->image)}}">
                                    @if($record->discount_percent > 0)
                                        <div class="product__discount__percent">
                                            -{{formatFloat($record->discount_percent)}}%
                                        </div>
                                    @endif
                                    {{--                                    <ul class="product__item__pic__hover">--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>--}}
                                    {{--                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>--}}
                                    {{--                                    </ul>--}}
                                </div>
                                <div class="product__discount__item__text">
                                    <h5><a href="#">{{$record->name}}</a></h5>
                                    <span>{{truncateText($record->short_description)}}</span>
                                    @if($record->discount_percent > 0)
                                        <div class="product__item__price">
                                            Rs. {{formatFloat(($record->price/100) * (100 - $record->discount_percent))}}
                                            <span>Rs. {{formatFloat($record->price)}}
                                        </span>
                                        </div>
                                    @else
                                        <div class="product__item__price">Rs. {{formatFloat($record->price)}}</div>
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
