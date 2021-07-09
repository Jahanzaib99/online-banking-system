<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('frontend.layout.head')
@include('frontend.layout.header')
<body>
@section('content')
@show
@include('frontend.layout.footer')
@include('frontend.layout.footer_script')
</body>
</html>
