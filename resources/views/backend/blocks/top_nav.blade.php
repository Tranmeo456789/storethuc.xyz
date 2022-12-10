<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #212529;"></i></a>
        </li>
        <li class="nav-item d-none d-md-block">
            <a class="nav-link text-uppercase"><strong>{{$pageTitle}}</strong></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <!-- <ul class="navbar-nav ml-auto">
        @if (Session::has('user'))
            @php
                $user = Session::get('user');
                $fullName = $user->fullname;
            @endphp
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <span class="d-none d-md-inline">{{$fullName}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <a class="dropdown-item" href="{{route('user.logout')}}">Thoát</a>
                </ul>
            </li>
        @endif
    </ul> -->
    <ul class="navbar-nav ml-auto">
        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
        </button>
        <!-- <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Tài khoản</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div> -->
    </ul>
</nav>