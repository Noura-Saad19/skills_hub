<!-- Navigation -->
<nav id="nav">
    <form method="post" action="{{url('logout')}}" id="logout-form" style="display: none;">
        @csrf
    </form>
    <ul class="main-menu nav navbar-nav navbar-right">
        <li><a href="{{url('/')}}">@lang('web.home')</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">@lang('web.cats') <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($cats as $cat)
                    <li><a href="{{url("categories/show/$cat->id")}}">
                            {{$cat->name()}}
                        </a></li>
                @endforeach
            </ul>
        </li>

        <li><a href="{{url("contact")}}">@lang('web.contact')</a></li>
        @guest
            <li><a href="{{url('login')}}">@lang('web.signin')</a></li>
            <li><a href="{{url('register')}}">@lang('web.signup')</a></li>
        @endguest
        @auth
            @if(\Illuminate\Support\Facades\Auth::user()->role->name =='student')
            <li><a href="{{url('profile')}}" >@lang('web.profile')</a></li>
            @else
                <li><a href="{{url('dashboard')}}" >@lang('web.dashboard')</a></li>

            @endif
            <li><a href="{{url('login')}}" id="logout-link">@lang('web.logout')</a></li>
        @endauth
        @if(\Illuminate\Support\Facades\App::getLocale()=="ar")
            <li><a href="{{url('lang/set/en')}}">EN</a></li>

        @else
            <li><a href="{{url('lang/set/ar')}}">ع</a></li>

        @endif

    </ul>
</nav>
<!-- /Navigation -->
