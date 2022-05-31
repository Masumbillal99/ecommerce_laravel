@extends('layouts.frontend_master')

@section('frontend_content')

<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form method="post" action="{{ url('checkout/post') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Full Name</p>
                                <input type="text" value="{{ Auth::user()->name }}" name="full_name">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" value="{{ Auth::user()->email }}" name="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phoe_number">
                            </div>
                            <div class="col-12">
                                <p>Country *</p>
                                <input type="text" name="country">
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="post_code">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <input type="text" name="city">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="notes"
                                    placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @php
                        $sub_total = 0;
                        @endphp
                        @foreach($carts as $cart)
                        <li>Subtotal {{ App\Product::find($cart->product_id)->product_name}} * {{ $cart->quantity }} <span class="pull-right"><strong>${{ App\Product::find($cart->product_id)->product_price * $cart->quantity }}</strong></span></li>
                        @php
                        $sub_total = $sub_total + (App\Product::find($cart->product_id)->product_price * $cart->quantity);
                        @endphp
                        @endforeach
                        <li>Subtotal <span class="pull-right"><strong>${{ $sub_total }}</strong></span></li>
                        <li>Total<span class="pull-right">$380.00</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="bank" type="radio" name="payment_option" value="1" checked>
                            <label for="bank">Cash on Delivery</label>
                        </li>
                        <li>
                            <input id="delivery" type="radio" name="payment_option" value="2">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button>Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
<!-- start social-newsletter-section -->
<section class="social-newsletter-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="newsletter text-center">
                    <h3>Subscribe Newsletter</h3>
                    <div class="newsletter-form">
                        <form>
                            <input type="text" class="form-control" placeholder="Enter Your Email Address...">
                            <button type="submit"><i class="fa fa-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->

    @endsection
