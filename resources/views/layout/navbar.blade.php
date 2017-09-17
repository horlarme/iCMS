<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            {{--<li class="text-center user-image-back">--}}
            {{--<img src="{{asset('storage/avatar-male.png')}}" class="img-responsive"/>--}}
            {{--</li>--}}

            <li>
                <a href="{{route('dashboard')}}"><i class="fa fa-desktop "></i>Dashboard</a>
            </li>

            <li>
                <a href="{{route('profile')}}"><i class="fa fa-user"></i>My Profile</a>
            </li>

            <!--Categories-->
            <li>
                <a href="#"><i class="fa fa-list"></i>Categories<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('categories')}}"><i class="fa fa-list"></i>All</a>
                    </li>
                    <li>
                        <a href="{{route('category.new')}}">
                            <i class="fi fi-clipboard-pencil"></i>New
                        </a>
                    </li>
                </ul>
            </li>
            <!--Categories-->

            <!--Posts-->
            <li>
                <a href="#"><i class="fi-clipboard-notes"></i>Posts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('post.new')}}">
                            <i class="fi-clipboard-pencil"></i>New Post</a>
                    </li>
                    <li>
                        <a href="{{ route('post.view', 'published')}}">
                            <i class="fi-clipboard"></i>Published</a>
                    </li>
                    <li>
                        <a href="{{ route('post.view', 'deleted')}}">
                            <i class="fa fa-trash-o"></i>Deleted</a>
                    </li>
                    <li>
                        <a href="{{ route('post.view', 'scheduled')}}">
                            <i class="fi-clock"></i>Scheduled</a>
                    </li>
                </ul>
            </li>
            <!--Posts-->

            <!--Pages-->
            <li>
                <a href="#"><i class="fa fa-book"></i>Pages<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('pages')}}">
                            <i class="fa fa-list"></i>All Pages</a>
                    </li>
                    <li>
                        <a href="{{route('page.new')}}">
                            <i class="fi-clipboard-pencil"></i>New Page</a>
                    </li>
                    <li>
                        <a href="{{ route('page.deleted')}}">
                            <i class="fa fa-trash-o"></i>Deleted</a>
                    </li>
                </ul>
            </li>
            <!--Pages-->

            <li>
                <a href="{{route('storage') }}"><i class="fa fa-files-o"></i>File Manager</a>
            </li>

            <!--Settings-->
            <li>
                <a href="#"><i class="fa fa-medkit"></i>Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    @php($settingList = \App\Admin\SettingList::all())
                    @foreach($settingList as $setting)
                        <li>
                            <a href="{{route('setting', $setting->name)}}"><i
                                        class="fa fa-medkit"></i>{{ $setting->value }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <!--Settings-->
        </ul>

        <div class="row footer">
            <div class="footer">
                &copy; {{date('Y')}}, {{strtoupper(setting('name', settingParent('app')))}}
            </div>
        </div>
    </div>

</nav>