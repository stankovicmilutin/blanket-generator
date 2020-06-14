<div class="sidebar" data-color="blue" data-image="/img/full-screen-image-2.jpg">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/" class="simple-text logo-mini">
                BG
            </a>
            <a href="/" class="simple-text logo-normal">
                Blanket Generator
            </a>
        </div>

        <div class="user">
            <div class="photo">
                <img src="/img/margot.jpg"/>
            </div>
            <div class="info ">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>{{ auth()->user()->name }}</span>
                </a>
            </div>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{ route('blankets.index') }}">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Blankets</p>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Tasks</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{ route('templates.index') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Templates</p>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="{{ route('courses.index') }}">
                    <i class="nc-icon nc-ruler-pencil"></i>
                    <p>Courses</p>
                </a>
            </li>

            @if(auth()->user()->is_admin)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Users</p>
                    </a>
                </li>
            @endif

            <hr/>


            <li class="nav-item ">
                <a class="nav-link"  href="{{ route('home') }}">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Blanket database</p>
                </a>
            </li>

            <li>
                <hr/>
            </li>

        </ul>
    </div>
</div>
