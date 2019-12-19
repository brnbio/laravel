<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Laravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->getName() }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {{ html()->postlink(route('core.users.logout'), 'Logout', ['class' => 'dropdown-item']) }}
                    </div>
                </li>
            @endauth

            @guest
                <li class="nav-item">
                    {{ html()->link(route('core.users.login'), 'Login', ['class' => 'nav-link']) }}
                </li>
            @endguest

        </ul>
    </div>
</nav>