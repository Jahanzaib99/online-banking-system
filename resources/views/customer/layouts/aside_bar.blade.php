<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item"><a href="{{route('breaker.home')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('request.order')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Requested Order</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('supplier.offer.list')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Supplier Offer</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('purchase.item.list')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.dash.main">Purchased Item</span></a>
            </li>
            <li class=" nav-item"><a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                    <i class="ft-power"></i><span class="menu-title"
                                                  data-i18n="nav.morris_charts.main">Signout</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</div>



