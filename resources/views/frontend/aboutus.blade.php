@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->
    <!-- ======= Hero Section ======= -->
    <div class="about-hero">
        <h1>About Us</h1>
    </div>
    <div class="who-we-are">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 who-we-are-content-container">
                    <div class="who-we-are-content">
                        <h2>Who We Are</h2>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At repudiandae ratione nostrum quasi, facere vel harum iste sed consectetur sapiente! Accusantium, voluptatem! Doloremque molestias eos, numquam illum consequuntur labore ratione.</p>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="who-we-are-image">
                        <img src="{{asset('public/frontend/assets/img/chad-kirchoff-xe-e69j6-Ds-unsplash.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="what-we-do">
        <div class="container">
            <div class="row what-we-do-container">
                <div class="col-sm-7">
                    <div class="what-we-do-image">
                        <img src="{{asset('public/frontend/assets/img/jamie-street-JtP_Dqtz6D8-unsplash.png')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-5 what-we-do-content-container">
                    <div class=" what-we-do-content">
                        <h2>What We Do</h2>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. At repudiandae ratione nostrum quasi, facere vel harum iste sed consectetur sapiente! Accusantium, voluptatem! Doloremque molestias eos, numquam illum consequuntur labore ratione.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
