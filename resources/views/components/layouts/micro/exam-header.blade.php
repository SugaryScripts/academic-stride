<header id="home" style="min-height: 0; padding: 0">
    <!-- [ Nav ] start -->
    <!-- [ Nav ] start -->
    <nav class="navbar navbar-expand-md navbar-light default">
        <div class="container">
            <div class="d-inline-flex align-items-center">
                <a class="navbar-brand" href="{{ route('active-exam') }}">
                    <img src="{{ asset('logo/'.config('app.logo_dark')) }}" alt="logo" />
                </a>
                <a href="https://phoenixcoded.gitbook.io/able-pro/versioning" target="_blank">
                    <div class="badge text-bg-light border-1 border rounded-pill" data-bs-toggle="tooltip" data-bs-title="Product Version">v0.0.1</div>
                </a>
            </div>
            <button
                class="navbar-toggler rounded"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item px-1 tech-link">
                        <a class="nav-link" href="dashboard/index.html" target="_blank">Dashboard</a>
                    </li>
                    <li class="nav-item px-1 tech-link">
                        <a class="nav-link" href="elements/bc_alert.html" target="_blank">Exam</a>
                    </li>
                    <li class="nav-item px-1">
                        <a class="nav-link" href="https://phoenixcoded.gitbook.io/able-pro/" target="_blank">Example</a>
                    </li>
                    {{--<li class="nav-item">
                        <a class="btn btn btn-success btn-buy" target="_blank" href="https://1.envato.market/zNkqj6"
                        >Submit Now <i class="ti ti-external-link"></i
                            ></a>
                    </li>--}}
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Nav ] start -->
</header>
