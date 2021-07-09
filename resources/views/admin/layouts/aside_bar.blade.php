<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if(auth()->user()->user_type === 'user')
                <li class=" nav-item"><a href="{{route('user.home')}}"><i class="la la-home"></i><span
                            class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('beneficiary.index')}}"><i class="la la-home"></i><span
                            class="menu-title" data-i18n="nav.dash.main">Payment Transfer</span></a>
                </li>
{{--                <li class=" nav-item"><a href="{{route('offer.list')}}"><i class="la la-home"></i><span--}}
{{--                            class="menu-title" data-i18n="nav.dash.main">Offer Sent</span></a>--}}
{{--                </li>--}}
            @endif
            @if(auth()->user()->user_type === 'admin')
                <li class=" nav-item"><a href="{{route('admin.home')}}"><i class="la la-home"></i><span
                            class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin.user')}}"><i class="la la-users"></i><span
                            class="menu-title" data-i18n="nav.dash.main">User</span></a>
                </li>
                {{--                        <li class=" nav-item"><a href="{{route('admin.sales')}}"><i class="la la-shopping-cart"></i><span--}}
                {{--                                    class="menu-title" data-i18n="nav.dash.main">Sales</span></a>--}}
                {{--                        </li>--}}
            @endif
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



