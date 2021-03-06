<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            {{-- <li class="text-center user-image-back"> --}}
            {{-- <img src="{{asset('img/user-image.jpg')}}" class="img-responsive"/> --}}
            {{-- </li> --}}

            <li>
                <a href="{{route('dashboard')}}"><i class="fa fa-desktop "></i>Dashboard</a>
            </li>

            <li>
                <a href="profile.html"><i class="fa fa-user"></i>My Profile</a>
            </li>

            <!--Categories-->
            @php($categories = App\Category::all())
            <li>
                <a href="#"><i class="fa fa-list"></i>Categories<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('categories')}}"><i class="fa fa-list"></i>All</a>
                    </li>
                    @foreach ($categories as $category)
                        <li title="{{ $category->title }}">
                            <a href="{{route('category.view', ucwords($category->name))}}">
                                <i class="fi {{ $category->icon }}"></i>{{ ucwords($category->name)}}
                            </a>
                        </li>
                    @endforeach
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
                        <a href="{{ route('post.published')}}">
                            <i class="fi-clipboard"></i>Published</a>
                    </li>
                    <li>
                        <a href="{{ route('post.deleted')}}">
                            <i class="fa fa-trash-o"></i>Deleted</a>
                    </li>
                    <li>
                        <a href="{{ route('post.scheduled')}}">
                            <i class="fi-clock"></i>Scheduled</a>
                    </li>
                </ul>
            </li>
            <!--Posts-->

            <li>
                <a href="pages.html"><i class="fa fa-book"></i>Pages</a>
            </li>

            <li>
                <a href="filemanager.html"><i class="fa fa-files-o"></i>File Manager</a>
            </li>

            <!--Settings-->
            <li>
                <a href="#"><i class="fa fa-medkit"></i>Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="settings-app.html"><i class="fa fa-medkit"></i>Edit Blog</a>
                    </li>
                    <li>
                        <a href="settings-cpanel"><i class="fa fa-medkit"></i>Edit Admin</a>
                    </li>
                </ul>
            </li>
            <!--Settings-->
        </ul>

        <div class="row footer">
            <div class="footer">
                &copy; {{date('Y')}}, {{env('APP_NAME')}}
            </div>
        </div>
    </div>

</nav>