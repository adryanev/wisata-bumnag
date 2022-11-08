@php
$r = \Route::current()->getAction();
$route = (isset($r['as'])) ? $r['as'] : '';
@endphp

<li class="nav-item mT-30">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.users') ? 'actived' : '' }}" href="{{ route(ADMIN . '.users.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.users') ? 'c-blue-500 ti-user' : 'c-brown-500 ti-user' }}
            "></i>
        </span>
        <span class="title">Users</span>
    </a>
</li>

<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.destinations') ? 'actived' : '' }}" href="{{ route(ADMIN . '.destinations.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.destinations') ? 'c-blue-500 ti-target' : 'c-brown-500 ti-target' }}
            "></i>
        </span>
        <span class="title">Destinations</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.adbanners') ? 'actived' : '' }}" href="{{ route(ADMIN . '.adbanners.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.adbanners') ? 'c-blue-500 ti-image' : 'c-brown-500 ti-image' }}
            "></i>
        </span>
        <span class="title">Ad Banners</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.souvenirs') ? 'actived' : '' }}" href="{{ route(ADMIN . '.souvenirs.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.souvenirs') ? 'c-blue-500 ti-shopping-cart' : 'c-brown-500 ti-shopping-cart' }}
            "></i>
        </span>
        <span class="title">Souvenirs</span>
    </a>
</li>
