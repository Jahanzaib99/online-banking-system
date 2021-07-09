<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('customer.layouts.head')
<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@include('customer.layouts.header')
@include('customer.layouts.aside_bar')
@section('content')
@show
@include('customer.layouts.footer')
@include('customer.layouts.footer_script')
</body>
</html>
