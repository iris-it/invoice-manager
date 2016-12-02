<header class="main-header">
    <a href="{{action('HomeController@index')}}" class="logo">
        <span class="logo-lg"><b>{{config('app.name')}}</b></span>
    </a>
    <nav class="navbar navbar-static-top">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{Auth::user()->name}} <span class="caret"></span></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <b>Déconnexion</b>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
