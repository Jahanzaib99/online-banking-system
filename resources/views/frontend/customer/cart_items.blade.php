@extends('frontend.layout.layout')
@section('content')

    <div class="cart-area bg-gray pt-160 pb-160">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif
                </div>
            @endif
            <form action="{{route('save.order')}}" method="post">
                @csrf
                <div class="cart-table-content">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th class="th-text-center"> Price</th>
                                <th class="th-text-center">Quantity</th>
                                <th class="th-text-center">Total Prce</th>
                                <th class="th-text-center">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($cart)
                                @foreach($cart as $spare_part)
                            <tr>
                                <td class="cart-product">
                                    <div class="product-img-info-wrap">
                                        <div class="product-img">
                                            <a href="#"><img src="{{Storage::disk('public')->exists('xs/'.$spare_part['image']) ? Storage::disk('public')->url('xs/'.$spare_part['image']) : Storage::disk('public')->url('default.png')}}" alt=""></a>
                                        </div>
                                        <div class="product-info">
                                            <h4><a href="#">{{isset($spare_part['title']) ?$spare_part['title'] : 'product_name'}}</a></h4>
                                            {{--<span>Color :  Black</span>
                                            <span>Size :     SL</span>--}}
                                        </div>
                                    </div>
                                </td>
                                <input type="hidden" name="product_id[]" value="{{$spare_part['product_id']}}">
                                <td class="product-price"><span class="amount">${{$spare_part['price']}}</span></td>
                                <td class="cart-quality">
                                    <div class="pro-details-quality">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box plus-minus-width-inc" type="text" name="{{$spare_part['product_id']}}" value="{{$spare_part['quantity']}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="product-total"><span>${{($spare_part['price'] * $spare_part['quantity'])}}</span></td>
                                <td class="product-remove"><a href="#"><img class="inject-me" src="{{asset('public/frontend/assets/img/close.svg')}}" alt=""></a></td>
                            </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="cart-shiping-update-wrapper">
                        <input type="submit" name="Check Out" value="Check Out">
                        <a href="#">Update Cart</a>
                        <a href="#">Clear Cart</a>
                    </div>
                </div>
            </form>
           {{-- <div class="row">
                <div class="apply-code-container">
                    <div class="discount-code-wrapper discount-tax-wrap">
                        <h4>Coupon Code </h4>
                        <div class="discount-code">
                            <p>Enter your coupon code if you have one!</p>
                            <form>
                                <input type="text" required="" placeholder="Enter your code here." name="name">
                                <button type="submit">Apply Coupon </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
    <!-- ======= End Hero ======= -->
@endsection

