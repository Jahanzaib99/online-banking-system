@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->
    <div class="container contact-main-container">
        <h1>GET IN TOUCH</h1>
        <div class="contact-info">
            <div class="contact-item">
                <i class="bi bi-geo-alt"></i>
                <h3>Address</h3>
                <p>Lorem ipsum dolor, sit amet consectetur</p>
            </div>
            <div class="contact-item">
                <i class="bi bi-phone"></i>
                <h3>Phone</h3>
                <p>+44 12345678</p>
            </div>
            <div class="contact-item">
                <i class="bi bi-envelope"></i>
                <h3>Email</h3>
                <p>info@Sparecarpart</p>
            </div>
        </div>
        <div class="contact-form">
            <form action="">
                <input type="text" name="" id="" placeholder="Enter Your Name">
                <input type="text" name="" id="" placeholder="Enter Your Email Address">
                <textarea name="" id="" placeholder="Your Message here"></textarea>
                <input type="submit" value="Send">

            </form>
        </div>
    </div>
@endsection
