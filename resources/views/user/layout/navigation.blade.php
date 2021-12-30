<nav class=" navbar-expand-lg navbar-light {{$data->warna_web}} sticky-top">
    <div class="container d-flex flex-column flex-lg-row justify-content-center align-items-center">
        <div class="pr-5 d-flex flex-sm-row">
            <a class="nav-link active text-white py-3 h4 px-5" href="/home">{{$data->nama_web}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white py-3 h4 px-3" href="/katalog/pria"><i
                            class="fas fa-male fa-lg m-2"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-white py-3 h4 px-3" href="/katalog/wanita"><i
                            class="fas fa-female fa-lg m-2"></i></a>
                </li>

                @if (\Session::has('user'))
                <li class="nav-item">
                    <a class="nav-link text-white py-3 h4 m-1" href="/keranjang"><i
                            class="fas fa-shopping-cart fa-sm m-2"></i></a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link text-white py-3 h4 m-1" href="/log"><i
                            class="fas fa-shopping-cart fa-sm"></i></a>
                </li>
                @endif

                @if (Session::get('user'))
                <li class="nav-item">
                    <a class="nav-link text-white py-3 h4 px-3 m-1" href="/dashboard-user">Dashboard</a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link text-white py-3 h4 m-1" href="/profil">Tentang Kami</a>
                </li>

            </ul>
            <span class="navbar-text py-3">
                @if (Session::has('user'))
                <a href="/logout"><button class="btn btn-warning ml-5 fs-4 px-3 py-2" type="submit">Logout</button></a>
                @else
                <a href="/log"><button class="btn btn-warning fs-4 px-3 py-2" type="submit">Login</button></a>
                @endif
            </span>
        </div>
    </div>
</nav>