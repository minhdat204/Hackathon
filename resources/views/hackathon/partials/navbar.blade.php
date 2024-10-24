<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img class="logo ms-3" src="img/banner/logov2.png" alt="Logo" width="250" />
        </a>

        <!-- Toggle button for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center navbarCustom">
                <!-- Greeting button -->
                <li class="nav-item me-3">
                    <div>
                        @if (session('user_name'))
                            <form action={{ route('admin.accounts.edit', $data['user']->id) }} method="POST">
                                @csrf
                                @method('GET')
                                <div class="button-wrapper" data-tippy-content="Click to copy button 89">
                                    <button class="button-89" role="button">Chào!
                                        {{ session('user_name') }}</button>
                                </div>
                            </form>
                        @else
                            <button class="btn btn-primary" type="submit">Hi someone!</button>
                        @endif
                    </div>
                </li>

                <!-- Logout button -->
                <li class="nav-item me-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="button-86" role="button" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
