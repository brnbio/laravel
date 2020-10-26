<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ml-auto">

                @auth
                    <li class="nav-item">
                        {{ html()->link(route('profile.notifications'), html()->icon('fas fa-bell') . ' (' . auth()->user()->unreadNotifications()->count() . ')', ['class' => 'nav-link']) }}
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{ html()->link(route('profile'), __('Profile'), ['class' => 'dropdown-item']) }}
                            {{ html()->postlink(route('logout'), __('Logout'), ['class' => 'dropdown-item']) }}
                        </div>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        {{ html()->link(route('login'), __('Login'), ['class' => 'nav-link']) }}
                    </li>
                @endguest

            </ul>
        </div>

    </div>
</nav>