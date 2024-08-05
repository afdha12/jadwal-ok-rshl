<header class="fixed-top" style="background-color: #F3EEEA">
    {{-- <nav class="navbar sticky-top" style="background-color: #F3EEEA"> --}}
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <div class="px-2">
                <button class="btn btn-outline" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                    aria-controls="offcanvasWithBothOptions"><i class="bi bi-list fs-3"></i></button>
            </div>
            <a href="{{ route('schedule.index') }}" class="text-decoration-none text-reset">
                <div class="align-self-center font-monospace fs-4 fw-bold">JADWAL OPERASI RUMAH SAKIT HERMINA LAMPUNG
                </div>
            </a>
            <div class="ms-auto me-2 px-2 justify-content-end">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger font-monospace">Logout <i
                            class="bi bi-box-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="d-flex">
        <div class="p-2">Flex item</div>
        <div class="p-2">Flex item</div>
        <div class="ms-auto p-2 justify-content-end">Flex item</div>
    </div> --}}

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Jadwal OK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('schedule.create') }}">Tambah Data
                        Operasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dokter.index') }}">Jadwal Dokter
                        Anestesi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('display') }}" target="blank">Link Display</a>
                </li>
                {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
            </ul>
            {{-- <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> --}}
        </div>
    </div>
    {{-- </nav> --}}
</header>
