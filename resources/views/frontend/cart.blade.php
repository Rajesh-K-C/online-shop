@extends('layouts.base')

@section('title', 'Shopping Cart | ')
@section('meta')
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
@endsection

@section('content')

    <div class="container">
        @include('components.flash_message')
        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <form action="{{ route('carts.update') }}" id="form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="shoping__product">Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($data['carts'] as $cart)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <a href="{{route('product', $cart->product->slug)}}">
                                                    <img style="width: min(5rem, 100%); height: min(5rem, 100%);"
                                                         src="{{asset('assets/images/product/'.$cart->product->image)}}"
                                                         alt="">
                                                    <h5>{{$cart->product->name}}</h5>
                                                </a>
                                            </td>
                                            <td class="shoping__cart__price">
                                                Rs. {{ formatFloat(($cart->product->price/100) * (100 - $cart->product->discount_percent)) }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" min="0" data-cart-id="{{ $cart->id }}"
                                                               max="{{ $cart->product->stock }}"
                                                               data-product-id="{{ $cart->id }}"
                                                               data-max="{{ $cart->product->stock }}"
                                                               value="{{ $cart->quantity }}">
                                                        {{--                                                        <input type="hidden" name="cart_items[{{ $cart->id }}][id]"--}}
                                                        {{--                                                               value="{{ $cart->id }}">--}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                Rs. {{ formatFloat((($cart->product->price/100) * (100 - $cart->product->discount_percent)) * $cart->quantity) }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <form action="{{route('delete-cart', $cart->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            style="border: none; margin: 0; padding: 0; background-color: transparent"
                                                            class="icon_close"></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Your cart is empty.</td>
                                        </tr>
                                    @endforelse

                                    {{--                                    <tr>--}}
                                    {{--                                        <td colspan="5" class="text-right">--}}
                                    {{--                                            <button type="submit" class="btn btn-primary">Update Cart</button>--}}
                                    {{--                                        </td>--}}
                                    {{--                                    </tr>--}}

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="{{route('index')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                {{--                                <button type="submit" class="btn primary-btn cart-btn cart-btn-right">--}}
                                {{--                                                                        <span class="icon_loading"></span>--}}
                                {{--                                    Update Cart--}}
                                {{--                                </button>--}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="shoping__continue">
                                {{--                            <div class="shoping__discount">--}}
                                {{--                                <h5>Discount Codes</h5>--}}
                                {{--                                <form action="#">--}}
                                {{--                                    <input type="text" placeholder="Enter your coupon code">--}}
                                {{--                                    <button type="submit" class="site-btn">APPLY COUPON</button>--}}
                                {{--                                </form>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="shoping__checkout">
                            <form style="display: inline-block; margin-left: auto" id="checkout-form"
                                  action="{{route('order.create')}}" method="post">
                                @csrf
                                <h5>Cart Total</h5>
                                <ul>
                                    {{--                                                                    <li>Subtotal <span>$454.98</span></li>--}}
                                    <li>Total <span></span></li>
                                </ul>
                                <button type="submit" id="checkout" class="btn btn-dark">PROCEED TO CHECKOUT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shoping Cart Section End -->

    </div>
@endsection


@section('js')
    <script>
        let total = 0;
        calculateTotal()
        document.querySelectorAll('.pro-qty input').forEach(input => {
            const qty = input.parentNode;
            const all = qty.parentNode.parentNode.parentNode;
            const price = parseFloat(all.children[1].innerText.split(' ')[1]);

            qty.firstElementChild.addEventListener('click', () => {
                if (parseInt(input.value) > 0) {
                    input.value = parseInt(input.value) - 1;
                    all.children[3].innerText = 'Rs. ' + price * parseInt(input.value);
                    updateCart(input);
                }
            });
            qty.lastElementChild.addEventListener('click', () => {
                if (parseInt(input.value) < parseInt(input.dataset.max)) {
                    input.value = parseInt(input.value) + 1;
                    all.children[3].innerText = 'Rs. ' + price * parseInt(input.value);
                    updateCart(input);
                }
            });

        });

        function calculateTotal() {
            document.querySelectorAll('.shoping__cart__total').forEach(e => {
                total += parseFloat(e.innerText.split(' ')[1]);
            });
            document.querySelector('.shoping__checkout li span').innerText = 'Rs. ' + total;
            document.querySelector('#checkout').disabled = total <= 0;
        }

        function updateCart(input) {
            const cartId = input.dataset.cartId;
            const productId = input.dataset.productId;
            const quantity = input.value;

            // Validate quantity is within allowed range
            if (quantity < 0 || quantity > parseInt(input.getAttribute('max'))) {
                alert('Quantity must be between 0 and ' + parseInt(input.getAttribute('max')));
                return;
            }

            // Send the request to update the quantity
            fetch("{{ route('cart.update.quantity') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    product_id: productId,
                    quantity: quantity
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // document.querySelector(`.total-for-cart-${cartId}`).textContent = 'Rs. ' + data.new_total;
                    } else {
                        alert('Failed to update cart.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('An error occurred while updating the cart.');
                });
            total = 0;
            calculateTotal();
        }

        document.querySelector('#checkout-form').addEventListener('submit', evt => {
            evt.preventDefault();
            if (confirm('Are you sure?\nTotal amount: Rs. ' + total)) {
                evt.target.submit();
            }
        })
    </script>
@endsection
