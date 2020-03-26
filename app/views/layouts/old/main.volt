
{{ sidebar.getMenu() }}

<div id="wrapper" class="column">
    <div class="wrap margin-left-250">
        <nav class="navigation-bar blue">
            <nav class="navigation-bar-content">
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
                <span class="element place-right">{{ user['fullname'] }}</span>
            </nav>
        </nav>
        <div class="wrap padding-top-60">
            <div class="content-wrapper">
                {{ flash.output() }}
                {{ content() }}
            </div>
        </div>
    </div>
</div>
</div>