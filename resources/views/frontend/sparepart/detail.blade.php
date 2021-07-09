@extends('frontend.layout.layout')
@section('content')
    <div class="container single-product">
        <div class="row">
            <div class="col-sm-5">
                <div class="side-image">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Spare Car Parts</a></li>
                    </ul>
                    <img src="{{Storage::disk('public')->exists('lg/'.$spare_part->image) ? Storage::disk('public')->url('lg/'.$spare_part->image) : Storage::disk('public')->url('default.png')}}" alt="">
                </div>
            </div>
            <div class="col-sm-7">
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
                <div class="single-product-dis">
                    <h2>{{$spare_part->title}}</h2>
                    <div class="price-button">
                        <h3>${{$spare_part->price}}</h3>
                        <a href="{{route('add.to.cart',$spare_part->id)}}" class="quantity">Add to cart</a>
                    </div>
                    <p>{{$spare_part->description}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container product-features">
        <div class="delivery-feature">
            <img src="{{asset('public/frontend/assets/img/certificate.png')}}" alt="">
            <h3>Delivery available</h3>
        </div>
        <div class="delivery-feature">
            <img src="{{asset('public/frontend/assets/img/certificate.png')}}" alt="">
            <h3>Click and collect</h3>
        </div>
        <div class="delivery-feature">
            <img src="{{asset('public/frontend/assets/img/certificate.png')}}" alt="">
            <h3>UK delivery</h3>
        </div>
    </div>
    <div class="others-part-divider container">
        <h2 class="right-divider"><span class="divider-span">Other parts you may need</span></h2>
    </div>
    <div class="container related-product-section">
        <div class="row">
            @if(!empty($suggestion))
                @foreach($suggestion as $parts)
            <div class="col-sm-4">
                <div class="related-product">
                    <a href="{{route('product.detail',$parts->id)}}"> <img src="{{Storage::disk('public')->exists('md/'.$parts->image) ? Storage::disk('public')->url('md/'.$parts->image) : Storage::disk('public')->url('default.png')}}" alt=""></a>
                    <h3>{{$parts->title}}</h3>
                    <h3>${{$parts->price}}</h3>
                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="find-parts-section">
        <div class="row">
            <div class="col-sm-6">
                <div class="find-part-shop">
                    <div class="find-shop-content container">
                        <h2>Find your spare part</h2>
                        <form method="post" action="{{route('find.model')}}" name="registrationform">
                            @csrf
                        <input type="text" placeholder="Enter your REG" name="registrationNumber">
                        <input type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="need-any-help">
                    <div class="need-any-help-content">
                        <h1>Need any help?</h1>
                        <h4>Call us to ask any questions</h4>
                        <a href="#" class="help-buttton">CALL 01234 567 898</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Hero ======= -->
@endsection

