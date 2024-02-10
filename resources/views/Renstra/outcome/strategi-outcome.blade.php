<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/renstrapage/{{$id}}">Roadmap</a></li>
        <li class="breadcrumb-item active" aria-current="page">Outcome</li>
    </ol>
</nav>
<!-- Section untuk Tabel Roadmap -->
<div class="container shadow-sm" style="border-radius:20px; border:none; background:white;">
    <div class=" strategi-header mb-5 p-4 pt-5 d-flex ">
        <div class="col-2 d-flex justify-content-center align-items-center">
            <div>
                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="company_gif" style="width: 80px; height:80px;">
            </div>
        </div>
        <div class="col px-3 d-flex align-items-end">
            <div>
                <h5 class="mb-1" style="font-weight:bold; font-size:10px;">Intermediate Objective</h5>
                <p class="mb-4" style="font-size:12px">{{$parent_intermediate}}</p>
                <h5 class="mb-1" style="font-weight:bold; font-size:12px;">Outcome</h5>
                <p class="mb-4" style="font-size:20px">{{ $outcome->strategi_outcome }}</p>
                <p class="m-0" style="font-weight:light; font-size:11px;"><i class="bi bi-clipboard-check-fill"></i>
                    &#8226; {{ count($outcome->indikator_outcome) }} datas </p>
            </div>
        </div>
    </div>
    <div class="px-4 mb-5">
        <div class="d-flex align-items-center">
            <div class="icon-bar px-3">
                <i class="fa-solid fa-bars-progress"></i>
            </div>
            <div class="container px-0">
                <div class="progress_container">
                    <div class="progress">
                        <div class="progress_item">
                            <h3 class="progress_title pt-0">Progress Now</h3>
                            <div class="progress_bar">
                                <div class="bar" data-value="{{ round($avg_outcome) }}"
                                    data-text="{{ round($avg_outcome) }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-3">
        <div class="px-3">
            <h5 style="font-weight:bold; font-size:20px;"> Indikator </h5>
            <p style="font-weight:light; font-size:11px;">Indikator yang bersangkutan dengan strategi
                {{ $outcome->strategi_outcome }}</p>
        </div>
        <div class="container">
            @foreach ($indikators as $indikator_outcome)
                <div class="overview-list my-3 mx-2 border px-3 py-1">
                    <a href="/renstrapage/{{$id}}/outcome/{{$outcome -> id_outcome}}/indikator-outcome/{{ $indikator_outcome->id_indikator_outcome }}"
                        style="text-decoration: none; color:black;">
                        <p class="m-0 py-3" style="font-size:12px;">
                            {{ $indikator_outcome->deskripsi_indikator_outcome }}
                        </p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
{{-- <div class="container-box">
    <button class="toggleBox">
        <span class="icon"></span>
    </button>
    <ul class="navItem">
        <li>
            <button id="toggle-edit" onclick="showBtnEdit()">
                <i class="bi bi-pencil" style="--i:1"></i>
            </button>
        </li>
    </ul>
</div> --}}
