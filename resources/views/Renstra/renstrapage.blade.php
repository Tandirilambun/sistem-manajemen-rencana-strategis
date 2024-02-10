@extends('main.index')

@section('index')

    @if (session()->has('status'))
        <div class="modal fade" tabindex="-1" id="search-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="alert alert-warning m-0" role="alert"
                            style="text-align: center; font-size:1rem; border-radius:0;">
                            {{ session('status') }}
                        </div>
                    </div>
                    <div class="modal-footer border-0" style="justify-content: center; align-items: center;">
                        <button type="button" class="btn modalBtn" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="d-flex p-3" style="gap:1%;">
        <aside class="col-2" id="side-nav">
            <nav class="card mb-3 p-3 scrollable-nav" id="nav-periode">
                <div class="nav nav-tabs tabsNav flex-column" id="myTab" role="tablist">
                    <div class="d-flex" style="padding: 5px 10px; position:sticky">
                        <i class="fa-solid fa-pager me-2" style="font-size: 20px"></i>
                        <div class="d-flex" style="font-size: 13px; align-items:center">
                            Jump To
                        </div>
                    </div>
                    @foreach ($periode_jump as $periode)
                        <a href="/renstrapage/{{ $periode->id_periode }}" class="btn btnNav my-1 d-flex"
                            style="align-items: center; ">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div style="line-height: 20px">
                                <p class="m-0">{{ $periode->roadmap }} </p>
                                <small style="font-size: 11px"><i class="fa-regular fa-calendar me-1"></i> &#8226;
                                    {{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }} </small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </nav>
            <nav class="card mb-3 p-3" style="border: none;">
                <div class="nav nav-tabs tabsNav flex-column" id="myTab" role="tablist">
                    @if ($strategi->flag_column_keterangan == 8)
                        <button class="nav-link btnNav active" id="general-tab" data-bs-toggle="tab"
                            data-bs-target="#general" role="tab" aria-controls="general" aria-selected="false"
                            name="jenis" style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">General Objective</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->general_objective) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="ultimate-tab" data-bs-toggle="tab" data-bs-target="#ultimate"
                            role="tab" aria-controls="ultimate" aria-selected="false" name="jenis"
                            style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Ultimate Objective</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->ultimate_objective) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="intermediate-tab" data-bs-toggle="tab"
                            data-bs-target="#intermediate" role="tab" aria-controls="intermediate"
                            aria-selected="false" name="jenis" style="display: flex; align-items:center; ">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Intermediate Objective</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->intermediate_objective) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="outcomes-tab" data-bs-toggle="tab"
                            data-bs-target="#outcomes" role="tab" aria-controls="outcomes" aria-selected="true"
                            style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Outcome</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->outcome) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="useofoutput-tab" data-bs-toggle="tab"
                            data-bs-target="#useofoutput" role="tab" aria-controls="useofoutput"
                            aria-selected="false" name="jenis" style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Use Of Output</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->use_of_output) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="outputs-tab" data-bs-toggle="tab" data-bs-target="#outputs"
                            role="tab" aria-controls="outputs" aria-selected="false" name="jenis"
                            style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Output</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->output) }} strategi</small>
                            </div>
                        </button>
                    @else
                        <button class="nav-link btnNav active" id="intermediate-tab" data-bs-toggle="tab"
                            data-bs-target="#intermediate" role="tab" aria-controls="intermediate"
                            aria-selected="false" name="jenis" style="display: flex; align-items:center; ">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Goal</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->intermediate_objective) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="outcomes-tab" data-bs-toggle="tab"
                            data-bs-target="#outcomes" role="tab" aria-controls="outcomes" aria-selected="true"
                            style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Outcome</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->outcome) }} strategi</small>
                            </div>
                        </button>
                        <button class="nav-link btnNav" id="outputs-tab" data-bs-toggle="tab" data-bs-target="#outputs"
                            role="tab" aria-controls="outputs" aria-selected="false" name="jenis"
                            style="display: flex; align-items:center">
                            <div class="roadmap-cover d-flex me-2">
                                <img src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="logo satunama"
                                    style="width: 30px; height:30px">
                            </div>
                            <div>
                                <p class="m-0" style="font-size: 11px">Output</p>
                                <small style="font-size:11px"><i class="fa-solid fa-clipboard me-1"></i>&#8226;
                                    {{ count($strategi->output) }} strategi</small>
                            </div>
                        </button>
                    @endif
                </div>
            </nav>
        </aside>
        <div class="col" id="col-content">
            <div class="tab-content">
                <div class="keterangan-roadmap mb-3 py-3">
                    <div class="col ps-5">
                        <h6 class="m-0"> Table</h6>
                        <h5 class="mb-2"> {{ $strategi->roadmap }} </h5>
                        <h5 class="mb-2" style="font-size: 30px;"> Tahun {{ $strategi->tahun_awal }} -
                            {{ $strategi->tahun_akhir }} </h5>
                    </div>
                </div>
                @include('Renstra.general-objective.general')
                @include('Renstra.ultimate-objective.ultimate')
                @include('Renstra.intermediate-objective.intermediate')
                @include('Renstra.outcome.outcome')
                @include('Renstra.use-of-output.useofoutput')
                @include('Renstra.output.output')
            </div>
        </div>
    </div>
@endsection
