<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{(request()->segment(2) == '') ? 'active' : ''}}" aria-current="page"
                    href="{{route('dashboard.index')}}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(request()->segment(2) == 'blogs') ? 'active' : ''}}"
                    href="{{route('dashboard.blogs.index')}}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Blogs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(request()->segment(2) == 'categories') ? 'active' : ''}}"
                    href="{{route('dashboard.categories.index')}}">
                    <span data-feather="file" class="align-text-bottom"></span>
                    Categories
                </a>
            </li>
        </ul>

        {{-- <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Current month
                </a>
            </li>
        </ul> --}}
    </div>
</nav>