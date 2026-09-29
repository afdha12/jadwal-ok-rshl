<header class="sticky top-0 z-50 bg-[#F3EEEA] shadow-sm">
    <div class="navbar w-full">
        <!-- Sidebar Toggle -->
        <div class="flex-none">
            <button class="btn btn-square btn-ghost" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                aria-controls="offcanvasWithBothOptions">
                <i class="bi bi-list text-2xl"></i>
            </button>
        </div>

        <!-- Navbar Title -->
        <div class="flex-1 px-2 mx-2">
            <a href="{{ route('schedule.index') }}"
                class="text-xl font-bold font-mono tracking-tight hover:text-gray-700 transition">
                JADWAL OPERASI RUMAH SAKIT HERMINA LAMPUNG
            </a>
        </div>

        <!-- Logout Button -->
        @if (Route::currentRouteName() == 'schedule.index')
            <div class="flex-none">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-outline btn-error font-mono">
                        Logout <i class="bi bi-box-arrow-right ml-1"></i>
                    </button>
                </form>
            </div>
        @endif
    </div>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Jadwal OK</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('schedule.index') }}">Data
                        Operasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dokter.index') }}">Data Dokter
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dokter-anestesi.index') }}">Dokter
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
