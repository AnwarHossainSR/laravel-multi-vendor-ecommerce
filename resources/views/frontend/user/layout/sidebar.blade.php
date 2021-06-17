<!-- Single Widget -->
<ul class="single-widget category categor-list">
    <h5 class="title"><a href="{{ route('customer') }}" class="{{ Request::is('user/dashboard') ? 'active' : '' }}">Dashboard</a></h5>
    <h5 class="title"><a href="{{ route('user.order') }}" class="{{ Request::is('user/order') ? 'active' : '' }}">Order</a></h5>
    <h5 class="title"><a href="{{ route('user.address') }}" class="{{ Request::is('user/address') ? 'active' : '' }}">Address</a></h5>
    <h5 class="title"><a href="{{ route('user.account') }}" class="{{ Request::is('user/account') ? 'active' : '' }}">Account Details</a></h5>
    <h5 class="title"><a href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">@csrf</form></h5>
</ul>

@push('styles')
    <style>
        ul h5 a:hover{
            text-align: center;
            color:#F7941D;
        }
        .active{
            color:#F7941D!important;
        }
    </style>
@endpush

