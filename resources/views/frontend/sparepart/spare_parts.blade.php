@extends('frontend.layout.layout')
@section('content')
    <div class="container shop-page">
        <div class="text-center product-title">
            <h1>Spare parts</h1>
            <h3>All your spare car parts sorted</h3>
        </div>
        <div class="row shop-page-products">
            @foreach($spare_parts as $spare_part)
            <div class="col-sm-4">
                <div class="product">
                    <div class="product-image">
                        <a href="{{route('product.detail',$spare_part->id)}}"> <img src="{{Storage::disk('public')->exists('lg/'.$spare_part->image) ? Storage::disk('public')->url('lg/'.$spare_part->image) : Storage::disk('public')->url('default.png')}}" alt=""></a>
                    </div>
                    <h3>{{ $spare_part->title }}</h3>
                    <h5>${{ $spare_part->price }}</h5>
                    <a href="{{route('product.detail',$spare_part->id)}}" class="product-button">Add to Cart</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="find-parts-section">
        <div class="row">
            <div class="col-sm-6">
                <div class="find-part-shop">
                    <div class="find-shop-content container">
                        <h2>Find your spare part</h2>
                        <input type="text" value="Enter your REG">
                        <input type="submit" value="Submit">
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
@endsection
