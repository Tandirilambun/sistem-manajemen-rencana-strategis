{{-- @dump($periodes); --}}
@extends('main.index')

@section('index')
    <div class="container py-5">
        <nav class="mb-4">
            <div class="nav nav-tabs tabsNav" id="nav-tab" role="tablist">
                <button class="nav-link active btnNav mx-2" id="nav-goal-tab" data-bs-toggle="tab" data-bs-target="#nav-goal"
                    type="button" role="tab" aria-controls="nav-goal" aria-selected="false">Periode</button>
                <button class="nav-link btnNav mx-2" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general"
                    type="button" role="tab" aria-controls="nav-general" aria-selected="false">General
                    Objective</button>
                <button class="nav-link btnNav mx-2" id="nav-ultimate-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-ultimate" type="button" role="tab" aria-controls="nav-ultimate"
                    aria-selected="false">Ultimate Objective</button>
                <button class="nav-link btnNav mx-2" id="nav-intermediate-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-intermediate" type="button" role="tab" aria-controls="nav-intermediate"
                    aria-selected="false">Intermediate Objective</button>
                <button class="nav-link btnNav mx-2" id="nav-outcome-tab" data-bs-toggle="tab" data-bs-target="#nav-outcome"
                    type="button" role="tab" aria-controls="nav-outcome" aria-selected="false">Outcome</button>
                <button class="nav-link btnNav mx-2" id="nav-useofoutput-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-useofoutput" type="button" role="tab" aria-controls="nav-useofoutput"
                    aria-selected="false">Use Of Output</button>
                <button class="nav-link btnNav mx-2" id="nav-output-tab" data-bs-toggle="tab" data-bs-target="#nav-output"
                    type="button" role="tab" aria-controls="nav-output" aria-selected="false">Output</button>
            </div>
        </nav>
        <div class="card card-container shadow-sm" style="border-radius:15px; border-color: transparent;">
            <div class="px-3 py-2">
                <h5 style="font-weight:bold; font-size:24px;">Tambah Data Rencana Strategis</h5>
                <p style="font-weight:light; font-size:11px; margin:0%;">Tambah Data untuk Periode</p>
            </div>
            <hr size="3" width="100%" color="red" class="m-1">
            <div class="tabs">
                <div class="tab-content" id="nav-tabContent">
                    <!--Goal/Periode-->
                    <div class="tab-pane fade show active" id="nav-goal" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <form method="POST" action="/periode">
                                @csrf
                                <div class="mb-3">
                                    <label for="inputRoadmap">Roadmap</label>
                                    <input type="text"
                                        class="form-control @error('inputRoadmap') is-invalid @enderror" id="inputRoadmap"
                                        placeholder="Roadmap" name="inputRoadmap" style="width: auto">
                                    @error('inputRoadmap')
                                        <div class="invalid-feedback mb-2"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahunAwal">Tahun Awal</label>
                                    <input type="number"
                                        class="form-control @error('tahunAwal') is-invalid @enderror" id="tahunAwal"
                                        placeholder="Tahun Awal" name="tahunAwal" style="width: auto">
                                    @error('tahunAwal')
                                        <div class="invalid-feedback mb-2"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahunAkhir">Tahun Akhir</label>
                                    <input type="number"
                                        class="form-control @error('tahunAkhir') is-invalid @enderror" id="tahunAkhir"
                                        placeholder="Tahun Akhir" name="tahunAkhir" style="width: auto">
                                    @error('tahunAkhir')
                                        <div class="invalid-feedback mb-2"> {{ $message }} </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="input-ket">Keterangan Roadmap</label>
                                    <div id="input-ket" class="d-flex" style="gap:1%;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flag_keterangan"
                                                id="select-ket-4" value=4>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                4 Tingkat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flag_keterangan"
                                                id="select-ket-8" value=8 checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                8 Tingkat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btnAdd"
                                    style="background:#008800; color:white;">
                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-general" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-general-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-general-strategi" type="button"
                                        role="tab" aria-controls="nav-general-strategi" aria-selected="false">General
                                        Objective Strategi</button>
                                    <button class="nav-link btnNav mx-2" id="nav-general-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-general-indikator" type="button"
                                        role="tab" aria-controls="nav-general-indikator"
                                        aria-selected="false">General
                                        Objective Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-general-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> General
                                                Objective </p>
                                            <form action="/general-objective" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-1">Periode</label>
                                                    <select id="select-periode-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_general">General Objective</label>
                                                    <textarea id="input_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                        name="input_general" placeholder="Masukkan Strategi..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-general-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                                                General
                                                Objective
                                            </p>
                                            <div class="mb-3">
                                                <label for="select-periode-7">Periode</label>
                                                <select id="select-periode-7" class="form-select mb-3"
                                                    aria-label=".form-select-lg example"
                                                    style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                    <option selected value="">Select Periode...</option>
                                                    @foreach ($periodes as $periode)
                                                        <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                            ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                            <br>
                                                            *{{ $periode->flag_column_keterangan }} tingkat
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <form action="/indikator-general" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-general-1">General Objective</label>
                                                    <select id="select-general-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectGeneral" required>
                                                        <option selected value="" required>Select General
                                                            Objective...
                                                        </option>
                                                        @foreach ($generals as $general)
                                                            <option value={{ $general->id_general }}>
                                                                {{ $general->strategi_general }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_general">Indikator</label>
                                                    <textarea id="input_indikator_general" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_general" placeholder="Masukkan Indikator..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-ultimate" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-ultimate" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-ultimate-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-ultimate-strategi" type="button"
                                        role="tab" aria-controls="nav-ultimate-strategi"
                                        aria-selected="false">Ultimate
                                        Objective Strategi</button>
                                    <button class="nav-link btnNav mx-2" id="nav-ultimate-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-ultimate-indikator" type="button"
                                        role="tab" aria-controls="nav-ultimate-indikator"
                                        aria-selected="false">Ultimate
                                        Objective Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-ultimate-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Ultimate
                                                Objective
                                            </p>
                                            <form action="/ultimate-objective" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-2">Periode</label>
                                                    <select id="select-periode-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>
                                                                {{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-general-2">General Objective</label>
                                                    <select id="select-general-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectGeneral" required>
                                                        <option selected value="">Select General Objective...
                                                        </option>
                                                        @foreach ($generals as $general)
                                                            <option value={{ $general->id_general }}>
                                                                {{ $general->strategi_general }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_ultimate">Ultimate Objective</label>
                                                    <textarea class="form-control " id="input_ultimate" aria-label="With textarea" style="width: 80%;"
                                                        name="input_ultimate" placeholder="Masukkan Strategi..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-ultimate-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                                                Ultimate Objective
                                            </p>
                                            <div class="mb-3">
                                                <label for="select-periode-8">Periode</label>
                                                <select id="select-periode-8" class="form-select mb-3"
                                                    aria-label=".form-select-lg example"
                                                    style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                    <option selected value="">Select Periode...</option>
                                                    @foreach ($periodes as $periode)
                                                        <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                            ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                            <br>
                                                            *{{ $periode->flag_column_keterangan }} tingkat
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <form action="/indikator-ultimate" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-ultimate-1">Ultimate Objective</label>
                                                    <select id="select-ultimate-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectUltimate"
                                                        required>
                                                        <option selected value="">Select Ultimate Objective...
                                                        </option>
                                                        @foreach ($ultimates as $ultimate)
                                                            <option value={{ $ultimate->id_ultimate }}>
                                                                {{ $ultimate->strategi_ultimate }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_ultimate">Indikator</label>
                                                    <textarea id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_ultimate" placeholder="Masukkan Indikator..." required></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-intermediate" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-intermediate" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-intermediate-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-intermediate-strategi" type="button"
                                        role="tab" aria-controls="nav-intermediate-strategi"
                                        aria-selected="false">Intermediate
                                        Objective Strategi</button>
                                    <button class="nav-link btnNav mx-2" id="nav-intermediate-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-intermediate-indikator" type="button"
                                        role="tab" aria-controls="nav-intermediate-indikator"
                                        aria-selected="false">Intermediate
                                        Objective Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-intermediate-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;">Intermediate
                                                Objective </p>
                                            <form action="/intermediate-objective" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-3">Periode</label>
                                                    <select id="select-periode-3" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>
                                                                {{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-ultimate-2">Ultimate Objective</label>
                                                    <select id="select-ultimate-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectUltimate">
                                                        <option selected value="">Select Ultimate Objective...
                                                        </option>
                                                        @foreach ($ultimates as $ultimate)
                                                            <option value={{ $ultimate->id_ultimate }}>
                                                                {{ $ultimate->strategi_ultimate }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_intermediate">Intermediate Objective</label>
                                                    <textarea required class="form-control" id="input_intermediate" aria-label="With textarea" style="width: 80%;"
                                                        name="input_intermediate" placeholder="Masukkan Strategi..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-intermediate-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                                                Intermediate
                                                Objective </p>
                                                <div class="mb-3">
                                                    <label for="select-periode-9">Periode</label>
                                                    <select id="select-periode-9" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <form action="/indikator-intermediate" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-intermediate-1">Intermediate Objective</label>
                                                    <select required id="select-intermediate-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectIntermediate">
                                                        <option selected value="">Select Intermediate Objective...
                                                        </option>
                                                        @foreach ($intermediates as $intermediate)
                                                            <option value={{ $intermediate->id_intermediate }}>
                                                                {{ $intermediate->strategi_intermediate }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_intermediate">Indikator</label>
                                                    <textarea required id="input_indikator_intermediate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_intermediate" placeholder="Masukkan Indikator..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-outcome" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-outcome" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-outcome-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-outcome-strategi" type="button"
                                        role="tab" aria-controls="nav-outcome-strategi"
                                        aria-selected="false">Outcome</button>
                                    <button class="nav-link btnNav mx-2" id="nav-outcome-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-outcome-indikator" type="button"
                                        role="tab" aria-controls="nav-outcome-indikator"
                                        aria-selected="false">Outcome Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-outcome-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Outcome </p>
                                            <form action="/outcome" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-4">Periode</label>
                                                    <select required id="select-periode-4" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>
                                                                {{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-intermediate-2">Intermediate Objective</label>
                                                    <select required id="select-intermediate-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectIntermediate">
                                                        <option selected value="">Select Intermediate Objective...
                                                        </option>
                                                        @foreach ($intermediates as $intermediate)
                                                            <option value={{ $intermediate->id_intermediate }}>
                                                                {{ $intermediate->strategi_intermediate }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_outcome">Outcome</label>
                                                    <textarea required class="form-control" id="input_outcome" aria-label="With textarea" style="width: 80%;"
                                                        name="input_outcome" placeholder="Masukkan Strategi..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-outcome-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                                                Outcome </p>
                                                <div class="mb-3">
                                                    <label for="select-periode-10">Periode</label>
                                                    <select id="select-periode-10" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <form action="/indikator-outcome" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-outcome-1">Outcome</label>
                                                    <select required id="select-outcome-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectOutcome">
                                                        <option selected value="">Select Outcome...</option>
                                                        @foreach ($outcomes as $outcome)
                                                            <option value={{ $outcome->id_outcome }}>
                                                                {{ $outcome->strategi_outcome }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_outcome">Indikator</label>
                                                    <textarea required id="input_indikator_outcome" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_outcome" placeholder="Masukkan Indikator..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-useofoutput" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-useofoutput" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-useofoutput-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-useofoutput-strategi" type="button"
                                        role="tab" aria-controls="nav-useofoutput-strategi" aria-selected="false">Use
                                        Of Output</button>
                                    <button class="nav-link btnNav mx-2" id="nav-useofoutput-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-useofoutput-indikator" type="button"
                                        role="tab" aria-controls="nav-useofoutput-indikator"
                                        aria-selected="false">Use Of Output Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-useofoutput-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;">Use Of Output
                                            </p>
                                            <form action="/use-of-output" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-5">Periode</label>
                                                    <select required id="select-periode-5" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>
                                                                {{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-outcome-2">Outcome</label>
                                                    <select required id="select-outcome-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectOutcome">
                                                        <option selected value="">Select Outcome...</option>
                                                        @foreach ($outcomes as $outcome)
                                                            <option value={{ $outcome->id_outcome }}>
                                                                {{ $outcome->strategi_outcome }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_useofoutput">Use of Output</label>
                                                    <textarea required class="form-control" id="input_useofoutput" aria-label="With textarea" style="width: 80%;"
                                                        name="input_useofoutput" placeholder="Masukkan Strategi..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-useofoutput-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                                                Use Of Output </p>
                                                <div class="mb-3">
                                                    <label for="select-periode-11">Periode</label>
                                                    <select id="select-periode-11" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <form action="/indikator-use-of-output" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-useofoutput-1">Use of Output</label>
                                                    <select required id="select-useofoutput-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectUseofoutput">
                                                        <option selected value="">Select Use of Output...</option>
                                                        @foreach ($use_of_outputs as $use_of_output)
                                                            <option value={{ $use_of_output->id_use_of_output }}>
                                                                {{ $use_of_output->strategi_use_of_output }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_useofoutput">Indikator</label>
                                                    <textarea required id="input_indikator_useofoutput" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_useofoutput" placeholder="Masukkan Indikator..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-output" role="tabpanel" aria-labelledby="nav-goal-tab">
                        <div class="container p-3">
                            <nav class="mb-4 d-flex justify-content-center">
                                <div class="nav nav-tabs tabsNav" id="nav-tab-output" role="tablist">
                                    <button class="nav-link btnNav mx-2 active" id="nav-output-strategi-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-output-strategi" type="button"
                                        role="tab" aria-controls="nav-output-strategi"
                                        aria-selected="false">Output</button>
                                    <button class="nav-link btnNav mx-2" id="nav-output-indikator-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-output-indikator" type="button"
                                        role="tab" aria-controls="nav-output-indikator" aria-selected="false">Output
                                        Indikator</button>
                                </div>
                            </nav>
                            <div class="tabs">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-output-strategi" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;">Output </p>
                                            <form action="/output" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-periode-6">Periode</label>
                                                    <select required id="select-periode-6" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                        <option selected value="">Select Periode...</option>
                                                        @foreach ($periodes as $periode)
                                                            <option value={{ $periode->id_periode }}>
                                                                {{ $periode->roadmap }}
                                                                ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                                <br>
                                                                *{{ $periode->flag_column_keterangan }} tingkat
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-outcome-3">Outcome</label>
                                                    <select id="select-outcome-3" class="form-select"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectOutcome">
                                                        <option selected value="">Select Outcome...</option>
                                                        @foreach ($outcomes as $outcome)
                                                            <option value={{ $outcome->id_outcome }}>
                                                                {{ $outcome->strategi_outcome }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div id="passwordHelpBlock" class="form-text">
                                                        Abaikan field ini jika data yang diinputkan adalah data 4 tingkat
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="select-useofoutput-2">Use of Output</label>
                                                    <select id="select-useofoutput-2" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectUseofoutput">
                                                        <option selected value="">Select Use of Output...</option>
                                                        @foreach ($use_of_outputs as $use_of_output)
                                                            <option value={{ $use_of_output->id_use_of_output }}>
                                                                {{ $use_of_output->strategi_use_of_output }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_output">Output</label>
                                                    <textarea required class="form-control" id="input_output" aria-label="With textarea" style="width: 80%;" name="input_output"
                                                        placeholder="Masukkan Strategi..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="nav-output-indikator" role="tabpanel"
                                        aria-labelledby="nav-tab-general">
                                        <div>
                                            <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator Output
                                            </p>
                                            <div class="mb-3">
                                                <label for="select-periode-12">Periode</label>
                                                <select id="select-periode-12" class="form-select mb-3"
                                                    aria-label=".form-select-lg example"
                                                    style="max-width:auto; width:auto;" name="selectPeriode" required>
                                                    <option selected value="">Select Periode...</option>
                                                    @foreach ($periodes as $periode)
                                                        <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                                            ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                                            <br>
                                                            *{{ $periode->flag_column_keterangan }} tingkat
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <form action="/indikator-output" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="select-output-1"> Output</label>
                                                    <select required id="select-output-1" class="form-select mb-3"
                                                        aria-label=".form-select-lg example"
                                                        style="max-width:auto; width:auto;" name="selectOutput">
                                                        <option selected value="">Select Output...</option>
                                                        @foreach ($outputs as $output)
                                                            <option value={{ $output->id_output }}>
                                                                {{ $output->strategi_output }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="input_indikator_output">Indikator</label>
                                                    <textarea required id="input_indikator_output" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                        name="input_indikator_output" placeholder="Masukkan Indikator..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btnAdd"
                                                    style="background:#008800; color:white;">
                                                    <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //untuk ultimate
        $(document).ready(function(){
            $('#select-periode-2').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-general-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-general-2').empty();
                        $.each(data, function(key, value){
                            $('#select-general-2').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-3').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-ultimate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-ultimate-2').empty();
                        $.each(data, function(key, value){
                            $('#select-ultimate-2').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-4').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-intermediate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-intermediate-2').empty();
                        $.each(data, function(key, value){
                            $('#select-intermediate-2').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-5').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-outcome/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-outcome-2').empty();
                        $.each(data, function(key, value){
                            $('#select-outcome-2').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-6').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-use-of-output/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-useofoutput-2').empty();
                        $.each(data, function(key, value){
                            $('#select-useofoutput-2').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-7').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-general-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-general-1').empty();
                        $.each(data, function(key, value){
                            $('#select-general-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-8').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-ultimate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-ultimate-1').empty();
                        $.each(data, function(key, value){
                            $('#select-ultimate-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-9').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-intermediate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-intermediate-1').empty();
                        $.each(data, function(key, value){
                            $('#select-intermediate-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-10').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-outcome/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-outcome-1').empty();
                        $.each(data, function(key, value){
                            $('#select-outcome-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-11').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-use-of-output/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-useofoutput-1').empty();
                        $.each(data, function(key, value){
                            $('#select-useofoutput-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $('#select-periode-12').change(function(){
                var periodeId = $(this).val();
                $.ajax({
                    url:'/get-output/' + periodeId,
                    type: 'GET',
                    success: function(data){
                        $('#select-output-1').empty();
                        console.log(data);
                        $.each(data, function(key, value){
                            $('#select-output-1').append('<option value="'+ key +'">' + value + '</option>');
                        });
                    }
                });
            });
        });

    </script>
@endsection