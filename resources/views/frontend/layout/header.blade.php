<!-- ======= Header ======= -->
<nav>
    <div class="logo">
        <a href="{{route('home')}}"><img src="{{asset('public/frontend/assets/img/logo 2.png')}}" alt=""></a>
    </div>
    <input type="checkbox" id="click" class="menu-checkbox">
    <label for="click" class="menu-btn">
        <i class="bi bi-list"></i>
    </label>
    <ul>
        <li><a class="active" href="{{route('find.parts')}}">Find a Part</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="{{route('contact')}}">Contact Us</a></li>
        <li><a href="{{route('about')}}">About Us</a></li>
        <li><a href="{{route('supplier.join')}}">Become a Supplier</a></li>
        @if(auth()->check())
        <li><a href="{{route('breaker.home')}}">{{auth()->user()->name}}</a></li>
        @else
        <li><a href="{{route('login')}}">Breaker Login</a></li>
        @endif
    </ul>
    <div>
        <a href="{{route('cart.items')}}"><i class="bi bi-cart"><span class='counter'>7</span></i></a>
    </div>
</nav>
    <!-- End Header -->
