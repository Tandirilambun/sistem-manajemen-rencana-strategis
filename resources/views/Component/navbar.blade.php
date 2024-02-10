@php
    $notif_item = App\Models\RequestForm::with('users')
        ->where('request_status', '=', 'pending')
        ->orWhere('req_show', '=', 'displayed')
        ->orderBy('created_at', 'desc')
        ->get();
    $notif_count = count($notif_item);
@endphp
<nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background: #008800; position:sticky; top:0%; z-index:999;">
    <div class="container-fluid">
        <img src="{{ asset('img/logo/Logo_SN_Text.png') }}" alt="My Image" style="width:35px; height:35px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav" style="width:auto; column-gap: 2%">
                @auth
                    <a class="btn navigateBtn p-0 d-flex" aria-current="page" href="/home"
                        style="background-color: transparent; border:none; color:white; align-items:center; width:10rem">
                        <li class="nav-item nvg-item p-2" style="width: 100%">
                            Home
                        </li>
                    </a>
                    <a class="btn navigateBtn p-0 d-flex" href="/home/create" data-bs-toggle="modal"
                        data-bs-target="#modal-renstra"
                        style="background-color: transparent; border:none; color:white; align-items:center; width:10rem">
                        <li class="nav-item nvg-item p-2" style="width: 100%">
                            Data
                        </li>
                    </a>
                    <a class="btn navigateBtn p-0 d-flex" aria-current="page" href="/activity-log"
                        style="background-color: transparent; border:none; color:white; align-items:center; width:10rem">
                        <li class="nav-item nvg-item p-2" style="width: 100%">
                            Activity Log
                        </li>
                    </a>
                    <button class="btn navigateBtn mb-0 p-0 position-relative" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="color: white">
                        <i class="bi bi-bell-fill" style="font-size: 20px"></i>
                        @if ($notif_count > 0)
                            <span
                                class="position-absolute mt-2 top-0 start-100 translate-middle p-2 bg-danger rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                    </button>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color:white;">
                            <i class="bi bi-person-badge" style="font-size: 20px"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li class="dropdown-item mb-0"> <i class="bi bi-person-fill me-2"></i>
                                {{ auth()->user()->name }}</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"> <i
                                            class="fa-solid fa-right-from-bracket me-2"></i> Logout </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <a class="btn navigateBtn p-0 d-flex" aria-current="page" href="/login"
                        style="background-color: transparent; border:none; color:white; align-items:center; width:10rem">
                        <li class="nav-item p-2" style="width: 100%">
                            <i class="bi bi-door-open"></i> Login
                        </li>
                    </a>
                @endauth
            </ul>
        </div>
    </div>
</nav>
