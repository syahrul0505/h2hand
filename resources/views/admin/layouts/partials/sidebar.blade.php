<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo/logo-vmond.png') }}" class="navbar-logo" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="{{ route('dashboard') }}" class="nav-link"> Rajendra Project POS </a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevrons-left">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>


            <li class="menu {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Pengguna</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('admin.posters.*') ? 'active' : '' }}">
                <a href="{{ route('admin.posters.manage') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        <span>Manajemen Poster</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('clubs.index') ? 'active' : '' }}">
                <a href="{{ route('clubs.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        {{-- Icon: Users (untuk Club) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Club</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('my-club.index') ? 'active' : '' }}">
                <a href="{{ route('my-club.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        {{-- Icon: User (untuk My Club) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M4 21v-2a4 4 0 0 1 3-3.87"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>My Club</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('class.index') ? 'active' : '' }}">
                <a href="{{ route('class.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        {{-- Icon: Book (untuk Class) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-book">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M4 4.5A2.5 2.5 0 0 1 6.5 7H20"></path>
                            <path d="M20 22V2H6.5A2.5 2.5 0 0 0 4 4.5v15z"></path>
                        </svg>
                        <span>Class</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('jerseys.index') ? 'active' : '' }}">
                <a href="{{ route('jerseys.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        {{-- Icon: Shirt (custom untuk Jersey) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-shirt">
                            <path d="M4 4L8 2l4 2 4-2 4 2v6l-2 12H6L4 10z"></path>
                            <line x1="4" y1="10" x2="20" y2="10"></line>
                        </svg>
                        <span>Jersey</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('race-event-numbers.*') ? 'active' : '' }}">
                <a href="{{ route('race-event-numbers.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-list">
                            <line x1="8" y1="6" x2="21" y2="6"></line>
                            <line x1="8" y1="12" x2="21" y2="12"></line>
                            <line x1="8" y1="18" x2="21" y2="18"></line>
                            <line x1="3" y1="6" x2="3.01" y2="6"></line>
                            <line x1="3" y1="12" x2="3.01" y2="12"></line>
                            <line x1="3" y1="18" x2="3.01" y2="18"></line>
                        </svg>
                        <span>Race Event</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('events.*') ? 'active' : '' }}">
                <a href="{{ route('events.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-calendar">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>Event</span>
                    </div>
                </a>
            </li>
            <li class="menu {{ request()->routeIs('registration-events.*', 'my-participations.*') ? 'active' : '' }}">
                <a href="#competition" data-bs-toggle="collapse"
                    aria-expanded="{{ request()->routeIs('registration-events.*', 'my-participations.*') ? 'true' : 'false' }}"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 17 17 23 15.79 13.88"></polyline>
                        </svg>
                        <span>Perlombaan</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->routeIs('registration-events.*', 'my-participations.*') ? 'show' : '' }}"
                    id="competition" data-bs-parent="#accordionExample">
                    <li class="{{ request()->routeIs('registration-events.*') ? 'active' : '' }}">
                        <a href="{{ route('registration-events.index') }}"> Daftar </a>
                    </li>
                    <li class="{{ request()->routeIs('my-participations.*') ? 'active' : '' }}">
                        <a href="{{ route('my-participations.index') }}"> Partisipasi </a>
                    </li>
                </ul>
            </li>
            <li class="menu {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                <a href="{{ route('invoices.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-file-text">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Tagihan</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
                <a href="{{ route('expenses.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>Expenses</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-shield">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <span>Tugas</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>