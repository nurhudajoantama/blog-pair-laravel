<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">Blog Post</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{(request()->is('/')) ? 'active' : ''}}" aria-current="page"
                        href="{{route('index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(1) == 'blogs') ? 'active' : ''}}"
                        href="{{route('blogs.index')}}">Blogs</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link nav-link" type="button" data-bs-toggle="collapse"
                        data-bs-target="#categoryNavbar" aria-expanded="false" aria-controls="categoryNavbar">
                        Category
                    </button>
                </li>
            </ul>
            <ul class='navbar-nav ml-auto'>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i>
                                Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button type='submit' class='dropdown-item'><i class="bi bi-box-arrow-right"></i>
                                    Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}"><i
                            class="bi bi-box-arrow-in-right"></i>Login</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="accordion accordion-flush mt-3 mt-2" id="accordionFlushExample">
        <div class="accordion-item">
            <div id="categoryNavbar" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <h5 class="mb-2">
                        Category
                    </h5>
                    <div class="row">
                        @foreach (App\Models\Category::all() as $category)
                        <a class="col-md-3 mb-1 text-dark" href="{{route('blogs.index',[
                            'category' => $category->name
                        ])}}">
                            {{ $category->name }}</a>
                        @endforeach
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>
</div>