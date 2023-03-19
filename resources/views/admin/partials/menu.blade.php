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
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.souvenirs') ? 'actived' : '' }}" href="{{ route(ADMIN . '.souvenirs.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.souvenirs') ? 'c-blue-500 ti-shopping-cart' : 'c-brown-500 ti-shopping-cart' }}
            "></i>
        </span>
        <span class="title">Souvenirs</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.packages') ? 'actived' : '' }}" href="{{ route(ADMIN . '.packages.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.packages') ? 'c-blue-500 ti-package' : 'c-brown-500 ti-package' }}
            "></i>
        </span>
        <span class="title">Packages</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.events') ? 'actived' : '' }}" href="{{ route(ADMIN . '.events.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.events') ? 'c-blue-500 ti-cup' : 'c-brown-500 ti-cup' }}
            "></i>
        </span>
        <span class="title">Events</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.tickets') ? 'actived' : '' }}" href="{{ route(ADMIN . '.tickets.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.tickets') ? 'c-blue-500 ti-receipt' : 'c-brown-500 ti-receipt' }}
            "></i>
        </span>
        <span class="title">Tickets</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.reviews') ? 'actived' : '' }}" href="{{ route(ADMIN . '.reviews.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.reviews') ? 'c-blue-500 ti-comments' : 'c-brown-500 ti-comments' }}
            "></i>
        </span>
        <span class="title">Reviews</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.orders') ? 'actived' : '' }}" href="{{ route(ADMIN . '.orders.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.orders') ? 'c-blue-500 ti-folder' : 'c-brown-500 ti-folder' }}
            "></i>
        </span>
        <span class="title">Orders</span>
    </a>
</li>
@if(Auth::user()->roles->first()->name == 'super-admin')
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
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.recommendations') ? 'actived' : '' }}" href="{{ route(ADMIN . '.recommendations.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.recommendations') ? 'c-blue-500 ti-star' : 'c-brown-500 ti-star' }}
            "></i>
        </span>
        <span class="title">Recommendations</span>
    </a>
</li>
<li class="nav-item">
    <a class="sidebar-link {{ Str::startsWith($route, 'admin.categories') ? 'actived' : '' }}" href="{{ route(ADMIN . '.categories.index') }}">
        <span class="icon-holder">
            <i class="
            {{ Str::startsWith($route, 'admin.categories') ? 'c-blue-500 ti-bookmark' : 'c-brown-500 ti-bookmark' }}
            "></i>
        </span>
        <span class="title">Categories</span>
    </a>
</li>

@endif
