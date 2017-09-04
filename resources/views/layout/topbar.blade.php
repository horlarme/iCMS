<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="adjust-nav">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="{{asset('storage/logo.png')}}" class="navbar-brand img-responsive"/>
        </div>
        <li class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(!Auth::guest())
                    <li class="dropdown">
                        <a href="javascript://" class="dropdown-toggle" type="button"
                           data-toggle="dropdown">{{ Auth::user()->email }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-left" style="width: 100%;">
                            <li class="user-image-box">
                                <img src="{{ asset('img/' . Auth::user()->image)}}" class="user-image-icon">
                            </li>
                            <li><a href="{{ route('profile') }}">My Profile</a></li>
                            <div class="divider"></div>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{route('dashboard')}}">See Website</a></li>
                @else
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                @endif

            </ul>
    </div>

</div>
</div>