<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SATUNAMA | Rencana Strategis</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Web Icon -->
    <link rel="icon" type="png" href="{{ asset('img/logo/Logo_SN_noText.png') }}">

    <!-- Local CSS -->
    <link rel="stylesheet" href="/css/index.css">

    <!-- Bootstrap 5.3.0 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Google Nunito Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&display=swap" rel="stylesheet">

    <!-- Google Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Bootstrap Poopper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <!-- Bootstrap 5.3.0 js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>

    <!-- Jquery for Ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1bb83af319.js" crossorigin="anonymous"></script>

    <!-- SweetAlert -->
    {{-- source = https://sweetalert2.github.io/#examples --}}
    <link rel="stylesheet" href="/css/animate.min.css">
    <link rel="stylesheet" href="/css/sweetalert2.min.css">
    <script src="/js/sweetalert2.min.js"></script>

</head>

<body style="background: #F8FAFB;">
    @include('Component.navbar')
    @if (session()->has('success') || session()->has('status'))
        <div id="body-html" data-value="true">
            @yield('index')
        </div>
    @else
        <div id="body-html" data-value="false">
            @yield('index')
        </div>
    @endif
</body>
<!--Toast for Notification-->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" class="rounded me-2" alt="logo sistem"
                style="width:18px; height:18px">
            <strong class="me-auto">Notification</strong>
            <small> {{ now()->diffForHumans() }} </small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body px-0">
            <div class="body-time mb-3 mx-3" style="text-align:start">
                <small>{{ now()->format('l') }}, {{ now()->format('d F Y') }}
                    ({{ now()->format('H:i') }})</small>
            </div>
            <div class="body-message alert alert-info mb-0" role="alert" style="border-radius: 0; border:0;">
                <div style="display: inline; font-size: 12px">
                    @if (session()->has('success'))
                        <i class="bi bi-check2-circle" style="margin-right: 1rem"></i>{{ session('success') }}
                    @elseif(session()->has('status'))
                        <i class="bi bi-check2-circle" style="margin-right: 1rem"></i>{{ session('status') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Renstra -->
<div class="modal fade" id="modal-renstra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
        <div class="modal-content border border-0">
            <div class="modal-header" style="background: #008800">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white; font-weight:bold">Rencana
                    Strategis</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="d-flex flex-row justify-content-center align-items-center" style="gap:2%;">
                    <div class="card card-wrapper border border-0 rounded rounded-5"
                        style="background:#008800;width:240px; height:140px;">
                        <a href="/create/periode" data-bs-toggle="modal" data-bs-target="#validateCreate"
                            class="card-body card-self py-5 border border-0 rounded rounded-5"
                            style="width:auto; height:auto; text-decoration: none;">
                            <h5 class="card-title"
                                style="font-size: 20px; font-weight:bold; text-align:center; color:white;">
                                Add Data Rencana Strategis</h5>
                        </a>
                    </div>
                    <div class="card card-wrapper border border-0 rounded rounded-5"
                        style="background:#008800;width:240px; height:140px;">
                        <a href="/data-page" class="card-body card-self py-5 rounded rounded-5"
                            style=" width:auto; height:auto; text-decoration: none;">
                            <h5 class="card-title"
                                style="font-size: 20px; font-weight:bold; text-align:center; color:white;">
                                Arsip Data Rencana Strategis
                            </h5>
                        </a>
                    </div>
                    <div class="card card-wrapper border border-0 rounded rounded-5"
                        style="background:#008800;width:240px; height:140px;">
                        <a data-bs-toggle="modal" data-bs-target="#modal-mpp-periode"
                            class="card-body card-self py-5 rounded rounded-5 d-flex align-items-center justify-content-center"
                            style=" width:auto; height:auto; text-decoration: none; ">
                            <h5 class="card-title m-0"
                                style="font-size: 20px; font-weight:bold; text-align:center; color:white;">
                                MPP Data Page
                            </h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas for notification -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body custom-scroll-container">
        <div class="mb-3">
            <h3 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fa-solid fa-bell me-3"
                    style="font-size: 2rem"></i>Notifikasi</h3>
        </div>
        @php
            $notif_new = App\Models\RequestForm::with('users')
                ->where('req_show', '=', 'displayed')
                ->where('request_status', '=', 'pending')
                ->orderBy('created_at', 'desc')
                ->get();
            $notif_pending = App\Models\RequestForm::with('users')
                ->where('request_status', '=', 'pending')
                ->where('req_show', '=', 'archived')
                ->orderBy('created_at', 'desc')
                ->get();
            $notif_staff = App\Models\RequestForm::with('reviewer')
                ->where('id_user', '=', Auth::user()->id_user)
                ->whereNot('request_status', '=', 'pending')
                ->orderBy('created_at', 'desc')
                ->limit(7)
                ->get();
        @endphp
        @cannot('staff')
            <nav class="mb-4">
                <div class="nav nav-pills" id="nav-tab" role="tablist">
                    <button class="nav-link notif-tabs active mx-2 position-relative" id="nav-new-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-new" type="button" role="tab"
                        aria-controls="nav-new" aria-selected="true">New
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($notif_new) }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    <button class="nav-link notif-tabs mx-2 position-relative" id="nav-pending-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-pending" type="button" role="tab" aria-controls="nav-pending"
                        aria-selected="false">Pending
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($notif_pending) }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab"
                    tabindex="0">
                    <div class="notification accordion accordion-flush" id="accordionFlushNotification">
                        @foreach ($notif_new as $item)
                            <div class="accordion-item notif-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button accor-btn collapsed px-3 notif-item rounded rounded-2"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#notif-flush-{{ $item->id_request }}" aria-expanded="false"
                                        aria-controls="notif-flush-{{ $item->id_request }}"
                                        style="background:transparent;">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle" style="font-size:2rem;color:#d2d2d2"></i>
                                        </div>
                                        <div>
                                            <p class="m-0" style="font-size: 12px;">
                                                {{ $item->users->name }} send you request for
                                                {{ $item->request_type }} at {{ $item->req_loc }}
                                            </p>
                                            <small class="req-time">
                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </small>
                                        </div>
                                    </button>
                                </h2>
                                <div id="notif-flush-{{ $item->id_request }}" class="accordion-collapse collapse mt-1"
                                    data-bs-parent="#accordionFlushNotification" style="background:transparent;">
                                    <div class="accordion-body">
                                        <p class="mb-1" style="font-weight: bold;"><i
                                                class="fa-solid fa-person-circle-question me-2"></i> Request item : </p>
                                        <p>{{ $item->request_item }}</p>
                                        <p class="mb-1" style="font-weight: bold;"><i
                                                class="bi bi-chat-left-quote-fill me-2"></i>
                                            Message : </p>
                                        <p>{{ $item->message }}</p>
                                        <div class="d-flex justify-content-center button-status">
                                            <form action="/home/request_form/{{ $item->id_request }}" method="post">
                                                @method('put')
                                                @csrf
                                                <button type="submit" class="btn btn-primary" name="btn_acc"
                                                    value="accepted">Accept</button>
                                            </form>
                                            <button class="btn btn-primary ms-2" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse-reason-rej-new-{{ $item->id_request }}"
                                                aria-expanded="false"
                                                aria-controls="collapse-reason-rej-new-{{ $item->id_request }}">
                                                Reject
                                            </button>
                                        </div>
                                        <div class="collapse mt-2" id="collapse-reason-rej-new-{{ $item->id_request }}">
                                            <form action="/home/request_form/{{ $item->id_request }}" method="POST"
                                                class="row" style="gap:1%;">
                                                @method('put')
                                                @csrf
                                                <textarea class="col form-control" required placeholder="Can you tell us why?" name="reject_reason"
                                                    id="reject_reason_{{ $item->id_request }}"></textarea>
                                                <button type="submit" class="col-md-2 btn btn-light" name="btn_acc"
                                                    value="rejected"><i class="bi bi-send-fill"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab"
                    tabindex="0">
                    <div class="notification accordion accordion-flush" id="accordionFlushNotification">
                        @foreach ($notif_pending as $item)
                            <div class="accordion-item notif-item mb-2 border-0">
                                <h2 class="accordion-header">
                                    <button class="accordion-button accor-btn collapsed px-3 notif-item rounded rounded-2"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#notif-flush-{{ $item->id_request }}" aria-expanded="false"
                                        aria-controls="notif-flush-{{ $item->id_request }}"
                                        style="background:transparent;">
                                        <div class="me-3">
                                            <i class="bi bi-person-circle" style="font-size:2rem;color:#d2d2d2"></i>
                                        </div>
                                        <div>
                                            <p class="m-0" style="font-size: 12px;">
                                                {{ $item->users->name }} send you request for
                                                {{ $item->request_type }} at {{ $item->req_loc }}
                                            </p>
                                            <small class="req-time">
                                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </small>
                                        </div>
                                    </button>
                                </h2>
                                <div id="notif-flush-{{ $item->id_request }}" class="accordion-collapse collapse mt-1"
                                    data-bs-parent="#accordionFlushNotification" style="background:transparent;">
                                    <div class="accordion-body">
                                        <p class="mb-1" style="font-weight: bold;"><i
                                                class="fa-solid fa-person-circle-question me-2"></i> Request item : </p>
                                        <p>{{ $item->request_item }}</p>
                                        <p class="mb-1" style="font-weight: bold;"><i
                                                class="bi bi-chat-left-quote-fill me-2"></i>
                                            Message : </p>
                                        <p>{{ $item->message }}</p>
                                        <div class="d-flex justify-content-center button-status">
                                            @if ($item->request_status == 'pending')
                                                <form action="/home/request_form/{{ $item->id_request }}" method="post">
                                                    @method('put')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary" name="btn_acc"
                                                        value="accepted">Accept</button>
                                                </form>
                                                <button class="btn btn-primary ms-2" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-reason-rej-pending-{{ $item->id_request }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapse-reason-rej-pending-{{ $item->id_request }}">
                                                    Reject
                                                </button>
                                            @endif
                                        </div>
                                        <div class="collapse mt-2"
                                            id="collapse-reason-rej-pending-{{ $item->id_request }}">
                                            <form action="/home/request_form/{{ $item->id_request }}" method="POST"
                                                class="row" style="gap:1%;">
                                                @method('put')
                                                @csrf
                                                <textarea class="col form-control" required placeholder="Can you tell us why?" name="reject_reason"
                                                    id="reject_reason_{{ $item->id_request }}"></textarea>
                                                <button type="submit" class="col-md-2 btn btn-light" name="btn_acc"
                                                    value="rejected"><i class="bi bi-send-fill"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                        @endforeach
                    </div>
                </div>
            </div>
        @endcannot
        @can('staff')
            {{-- @dd($notif_staff) --}}
            <div class="mb-3">
                <a href="/request-log" class="req-history-link ">
                    <i class="bi bi-clock-history me-1"></i> See your request history
                </a>
            </div>
            <div class="notification accordion accordion-flush" id="accordionFlushNotification">
                @foreach ($notif_staff as $item)
                    <div class="accordion-item notif-item mb-2 border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button accor-btn collapsed px-3 notif-item rounded rounded-2"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#notif-flush-{{ $item->id_request }}" aria-expanded="false"
                                aria-controls="notif-flush-{{ $item->id_request }}" style="background:transparent;">
                                <div class="me-3">
                                    <i class="bi bi-person-circle" style="font-size:2rem;color:#d2d2d2"></i>
                                </div>
                                <div>
                                    <p class="m-0" style="font-size: 11px;">
                                        Your request for {{ $item->request_type }} the {{ $item->req_loc }} has been
                                        {{ $item->request_status }} by {{ $item->reviewer->name }}
                                    </p>
                                </div>
                            </button>
                        </h2>
                        <div id="notif-flush-{{ $item->id_request }}" class="accordion-collapse collapse mt-1"
                            data-bs-parent="#accordionFlushNotification" style="background:transparent;">
                            <div class="accordion-body">
                                <p class="mb-1" style="font-weight: bold;"><i
                                        class="fa-solid fa-person-circle-question me-2"></i> Request item : </p>
                                <p>{{ $item->request_item }}</p>
                                <p class="mb-1" style="font-weight: bold;"><i class="bi bi-envelope-fill me-2"></i>
                                    Message : </p>
                                <p>{{ $item->message }}</p>
                                @if ($item->request_status == 'rejected')
                                    <p class="mb-1" style="font-weight: bold;"><i
                                            class="bi bi-chat-left-quote-fill me-2"></i>
                                        Reason : </p>
                                    <p>{{ $item->reason_reject }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">
                @endforeach
            </div>
        @endcan
    </div>
</div>

<div class="modal fade" id="modal-mpp-periode" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">MPP Renstra SATUNAMA</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $periodes_all = App\Models\Periode::all();
                @endphp
                <div class="row">
                    @foreach ($periodes_all as $periode)
                        <div class="col-4">
                            <div class="card card-wrapper border border-0 rounded rounded-5 my-3"
                                style="background:#008800;width:auto; height:auto; ">
                                <a href="/mpp_data_page/{{ $periode->id_periode }}"
                                    class="card-body card-self rounded rounded-5"
                                    style=" width:auto; height:auto; text-decoration: none;">
                                    <h5 class="card-title m-0"
                                        style="font-size: 13px; font-weight:bold; text-align:center; color:white;">
                                        {{ $periode->roadmap }} <br>
                                        {{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }} <br>
                                        {{ $periode->flag_column_keterangan }} tingkat
                                    </h5>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="validateCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="validateCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center align-items-center" style="gap:2%;">
                    <div class="col">
                        <div class="card card-wrapper border border-0 rounded rounded-5"
                            style="background:#008800; width:auto; height:auto;">
                            <a href="/create-4/periode"class="card-body card-self py-5 border border-0 rounded rounded-5"
                                style="width:auto; height:auto; text-decoration: none;">
                                <h5 class="card-title"
                                    style="font-size: 20px; font-weight:bold; text-align:center; color:white;">
                                    4 Tingkat</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-wrapper border border-0 rounded rounded-5"
                            style="background:#008800;width:auto; height:auto; ">
                            <a href="/create/periode" class="card-body card-self py-5 rounded rounded-5"
                                style=" width:auto; height:auto; text-decoration: none;">
                                <h5 class="card-title"
                                    style="font-size: 20px; font-weight:bold; text-align:center; color:white;">
                                    8 Tingkat
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Local JavaScript -->
<script src="/js/index.js"></script>

</html>
