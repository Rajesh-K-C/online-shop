@extends('layouts.base')

@section('title', "Contact Us")

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Contact Us</h1>
    @include('components.flash_message')
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p>{{$setting->phone}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p>{{$setting->address}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Open time</h4>
                        <p>{{$setting->opening_hours}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{$setting->email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
    @if($setting->google_map_link)
        <!-- Map Begin -->
        <div class="map">
            <iframe src="{{$setting->google_map_link}}}" height="500" style="border:0;" allowfullscreen=""
                aria-hidden="false" tabindex="0"></iframe>
            <div class="map-inside">
                <i class="icon_pin"></i>
                <div class="inside-widget">
                    <h4>New York</h4>
                    <ul>
                        <li>Phone: +12-345-6789</li>
                        <li>Add: 16 Creek Ave. Farmingdale, NY</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Map End -->
    @endif
    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="{{route('contact')}}" method="post">
                @csrf
                <div class="row">
                    @if(!Auth::check())
                        <div class="col-lg-6 col-md-6">
                            <label for="name">Name:
                                @include('components.form_element_error', ['field' => 'name'])</label>
                            <input type="text" id="name" name="name" placeholder="Your name">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <label for="email">Email:
                                @include('components.form_element_error', ['field' => 'email'])</label>
                            <input type="text" name="email" placeholder="Your Email">
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <label for="message">Message:
                            @include('components.form_element_error', ['field' => 'message'])</label>
                        <textarea placeholder="Your message" name="message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
</div>

@endsection