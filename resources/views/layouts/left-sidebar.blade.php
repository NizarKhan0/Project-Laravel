    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('template/img/logo/logo2.png') }}">
            </div>
            <div class="sidebar-brand-text mx-3">RuangAdmin</div>
        </a>
        <hr class="sidebar-divider my-0">
        @if (Auth::user())
            @if (Auth::user()->role_id == 1)
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    Admin
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                        aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Book</span>
                    </a>
                    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Book</h6>
                            {{-- <a class="collapse-item" href="books">Add Books</a>
                        <a class="collapse-item" href="categories">Categories</a> --}}
                            <a class="collapse-item {{ request()->route()->uri == 'books.public' || request()->route()->uri == 'booklist-deleted' ? 'active' : '' }}"
                                href="{{ route('books.public') }}">Public</a>
                            <a class="collapse-item {{ request()->route()->uri == 'booklist' || request()->route()->uri == 'booklist-deleted' ? 'active' : '' }}"
                                href="{{ route('booklist') }}">Modify</a>
                            <a class="collapse-item {{ request()->route()->uri == 'booklist' || request()->route()->uri == 'booklist-deleted' ? 'active' : '' }}"
                                href="{{ route('book.rent') }}">Rent</a>
                            <a class="collapse-item" href="{{ route('book.return') }}">Return</a>
                            <a class="collapse-item {{ request()->route()->uri == 'categories' || request()->route()->uri == 'categories-deleted' ? 'active' : '' }}"
                                href="{{ route('categories') }}">Genre</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                        aria-expanded="true" aria-controls="collapseTable">
                        <i class="fas fa-fw fa-users"></i>
                        <span>User</span>
                    </a>
                    <div id="collapseTable" class="collapse" aria-labelledby="headingTable"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">User</h6>
                            <a class="collapse-item {{ request()->route()->uri == 'active.users' || request()->route()->uri == 'booklist-deleted' ? 'active' : '' }}"
                                href="{{ route('active.users') }}">Active</a>
                            <a class="collapse-item {{ request()->route()->uri == 'registered.users' || request()->route()->uri == 'categories-deleted' ? 'active' : '' }}"
                                href="{{ route('registered.users') }}">Pending</a>
                            <a class="collapse-item {{ request()->route()->uri == 'banned.users' || request()->route()->uri == 'categories-deleted' ? 'active' : '' }}"
                                href="{{ route('banned.users') }}">Banned</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ request()->route()->uri == 'rent-logs' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('rent-logs') }}">
                        <i class="fas fa-fw fa-file"></i>
                        <span>Rent Log</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                <a class="nav-link" href="users">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rent-logs">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Rent Log</span>
                </a>
            </li> --}}
            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Profile</span></a>
                </li>

                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    User
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                        aria-expanded="true" aria-controls="collapseBootstrap">
                        <i class="far fa-fw fa-window-maximize"></i>
                        <span>Profile</span>
                    </a>
                    <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Profile</h6>
                            <a class="collapse-item" href="{{ route('books.public') }}">Book List</a>
                            <a class="collapse-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>
                </li>
            @endif
        @else
            <li class="nav-item {{ request()->route()->uri == 'rent-logs' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Login</span>
                </a>
            </li>
        @endif
    </ul>
