<div class="nav-fixed">
    <nav id="nav-wrap">
        <div class="main">
            <div id="menu-icon">
                <div>Main Navigation</div>
            </div>
            <ul id="nav">
                @if (!\Auth::guest() && \Request::path()!="/")
                    @include('template.breadcrumb')
                    <li class="navbar-right">
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span>
                            Logout
                        </a>
                        <form id="logout-form"
                              action="{{ url('/logout') }}"
                              method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <li class="navbar-right"><a href="javascript:void(0);"><span class="glyphicon glyphicon-user"></span>{{ucwords(\Auth::user()->first_name . " " . \Auth::user()->last_name)}}</a></li>
               @endif
            </ul>
            <div class="clear"></div>
        </div>
    </nav>
</div>