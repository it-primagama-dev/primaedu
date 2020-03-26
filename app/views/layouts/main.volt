
<nav class="navigation-bar blue">
    <nav class="navigation-bar-content">
        <span class="element logo"><img src="{{ url('img/logo_new_putih_web.png') }}"></span>
        <span class="element-divider"></span>
        <a class="element brand" href="#">PRIMA EDU</a>
        <span class="element-divider"></span>
        <span class="element">{{ kodecabang~' - '~namacabang }}</span>
        <span class="element-divider"></span>
        <ul class="element-menu place-right">
            <li>
                <a class="dropdown-toggle icon-cog" href="#"></a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="{{ url('chpass/index') }}">Ganti Password</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url.get('session/end') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
        <span class="element-divider place-right"></span>
        <span class="element place-right">{{ user['fullname'] }}</span>
        <span class="element-divider place-right"></span>
    </nav>
</nav>
<div class="container">
    {{ sidebar.getMenu() }}

    <div id="wrapper" class="column">
        <div class="wrap margin-left-250">
            <div class="wrap">
                <div class="content-wrapper">
                    <div class="content">
                        {{ flash.output() }}
                        {{ content() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>