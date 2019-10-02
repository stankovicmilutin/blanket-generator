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
                    <span>{{ auth()->user()->name }}<b class="caret"></b></span>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a class="profile-dropdown" href="#pablo">
                                <span class="sidebar-mini">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="profile-dropdown" href="#pablo">
                                <span class="sidebar-mini">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Blankets <b class="caret"></b></p>
                </a>
                <div class="collapse " id="componentsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('blankets.index') }}">
                                <span class="sidebar-mini"></span>
                                <span class="sidebar-normal">Show Blankets</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('blankets.create') }}">
                                <span class="sidebar-mini"></span>
                                <span class="sidebar-normal">Create Blanket</span>
                            </a>
                        </li>
                    </ul>
                </div>
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


            <li class="nav-item ">
                <a class="nav-link" href="/">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Reports</p>
                </a>
            </li>

            <li>
                <hr/>
            </li>

{{--            <li class="nav-item ">--}}
{{--                <a class="nav-link" href="{{ route('settings.index') }}">--}}
{{--                    <i class="nc-icon nc-settings-gear-64"></i>--}}
{{--                    <p>Settings</p>--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>
    </div>
</div>