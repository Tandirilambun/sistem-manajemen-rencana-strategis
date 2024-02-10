<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/renstrapage/{{ $id }}">Roadmap</a></li>
        <li class="breadcrumb-item"><a
                href="/renstrapage/{{ $id }}/ultimate-objective/{{ $ultimateObjective->id_ultimate }}">Ultimate
                Objectieve</a></li>
        <li class="breadcrumb-item active" aria-current="page">Indikator Ultimate Objective</li>
    </ol>
</nav>
<div class="row mt-3 shadow-sm" style="border-radius:20px; background:white;">
    <div class="col py-5 d-flex align-items-center">
        <div class="ps-5">
            <div class="detail-relation mb-5">
                <p class="mb-2" style="font-size: 13px;font-weight:bold;">General Objective</p>
                <p style="font-size: 15px">{{ $parent_general }}</p>
            </div>
            <div class="detail-relation mb-5">
                <p class="mb-2" style="font-size: 13px;font-weight:bold;">Ultimate Objective</p>
                <p style="font-size: 15px">{{ $parent_ultimate->strategi_ultimate }}</p>
            </div>
            <div class="detail-relation">
                <p class="mb-2" style="font-size: 13px; font-weight:bolder;">Indikator</p>
                <p style="font-size: 15px">{{ $indikatorUltimate->deskripsi_indikator_ultimate }}</p>
            </div>
        </div>
    </div>
    <div class="col d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/illustration/Risk management-amico.png') }}" alt="company_gif"
            style="width: 400px; height:400px;">
    </div>
</div>
<div class="row py-3">
    <div class="col shadow-sm card p-2 border-0 ms-2" style="background:white;border-radius: 20px;">
        <div class="card-body" id="card-body">
            <div class="container">
                <div class="progress_container">
                    <div class="progress">
                        <div class="progress_item">
                            <h3 class="progress_title"></h3>
                            <div class="progress_bar">
                                <div class="bar" data-value="{{ $avg_capaians_ultimate }}"
                                    data-text="{{ $avg_capaians_ultimate }}"></div>
                            </div>
                        </div>
                        <p class="m-0" style="font-size: 11px; color:#969696;">Overall Progress</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (count($capaians_ultimate) != 0)
    <div class="row chart">
        <div class="col card px-0"
            style="max-width: 15rem; border:2px dashed #dadada; border-radius:20px; background:none;">
            <div class="card-body d-flex" style="justify-content:center; align-items:center;">
                <div>
                    <h5 class="card-title mb-3" style="font-size: 20px; font-weight:bold;">Rincian
                        Progress</h5>
                    @if (count($capaians_ultimate) >= 5)
                        <button disabled type="button" class="btn"
                            style="background: #BFDB38; color:white; font-weight:bold;">
                            <i class="bi bi-plus-circle"></i> Add Capaian
                        </button>
                    @else
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#create-capaian"
                            style="background: #BFDB38; color:white; font-weight:bold;">
                            <i class="bi bi-plus-circle"></i> Add Capaian
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @foreach ($capaians_ultimate as $capaian)
            <div class="col card card-capaian px-0 shadow-sm"
                style="max-width: 15rem; border-radius: 20px; background-color:white; border:none;">
                <div class="card-body px-0">
                    <div class="me-3" style="float: right;">
                        <div class="d-flex">
                            @cannot('staff')
                                <form action="/capaian-indikator-ultimate/{{ $capaian->id_capaian_ultimate }}"
                                    method="post">
                                    @method('delete')
                                    @csrf
                                    <button
                                        class="btn btn-capaian p-0 me-1 d-flex justify-content-center align-items-center"
                                        style="background-color:red; border-radius:100%;"
                                        onclick="return confirm('Are you sure to delete this data?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </button>
                                </form>
                            @endcannot
                            @can('staff')
                                <button type="button"
                                    class="btn-capaian btn p-0 me-1 d-flex justify-content-center align-items-center"
                                    data-bs-toggle="modal"
                                    data-bs-target="#delete-capaian-ultimate-{{ $capaian->id_capaian_ultimate }}"
                                    style="background-color: red; border-radius:100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                        fill="currentColor" class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                    </svg>
                                </button>
                            @endcan
                            <button type="button"
                                class="btn-capaian btn p-0 d-flex justify-content-center align-items-center"
                                data-bs-toggle="modal"
                                data-bs-target="#edit-capaian-ultimate-{{ $capaian->id_capaian_ultimate }}"
                                style="background-color: #1C76FD; border-radius:100%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                    fill="currentColor" class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!--Circular Progress Bar-->
                    <div class="container container-chart m-0 p-0"
                        style="display: flex; justify-content:center; align-items:center;">
                        <div class="circular-progress" id="circular-progress-{{ $capaian->id_capaian_ultimate }}"
                            data-id={{ $capaian->id_capaian_ultimate }}>
                            <div class="value-container" id="value-container-{{ $capaian->id_capaian_ultimate }}"
                                data-id={{ $capaian->id_capaian_ultimate }}> {{ $capaian->capaian_ultimate }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <span class="col d-flex justify-content-center">
                            <i class="bi bi-circle-fill me-2" style="font-size: 11px; color:#008800"></i>
                            <p class="m-0" style="font-size: 11px;">Capaian</p>
                        </span>
                        <span class="col d-flex justify-content-center">
                            <i class="bi bi-circle-fill me-2" style="font-size: 11px; color:#80ff80;"></i>
                            <p class="m-0" style="font-size: 11px;">Deviasi</p>
                        </span>
                    </div>
                    <div style="display: flex; justify-content:center; align-items:center;">
                        <button type="button" class="btn btn-hasil px-4 mt-2" data-bs-toggle="popover"
                            data-bs-placement="bottom" data-bs-trigger="focus" data-bs-html="true"
                            data-bs-title="Capaian dalam {{ $capaian->tahun_ultimate }}"
                            data-bs-content="
                                            <strong> Capaian : {{ $capaian->capaian_ultimate }}% </strong> <br/>
                                            <strong> Deviasi : {{ 100 - $capaian->capaian_ultimate }}% </strong> <br/>
                                            <br/>
                                            {{ $capaian->keterangan_hasil_ultimate }}"
                            style="background-color: white; border-radius:4rem;
                                                text-align:center;font-size:13px;">
                            Progress {{ $capaian->tahun_ultimate }}
                            <i class="fa-solid fa-circle-info ms-1"
                                style="color:#008800; font-size:13px;"></i></button>
                    </div>
                </div>
            </div>
            <!--Modal Update Capaian -->
            <div class="modal fade" id="edit-capaian-ultimate-{{ $capaian->id_capaian_ultimate }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 70%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        @cannot('staff')
                            <form action="/capaian-indikator-ultimate/{{ $capaian->id_capaian_ultimate }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="desc-indikator">Indikator</label>
                                        <textarea disabled class="form-control " id="input-hasil" aria-label="With textarea" style="width: 80%;"
                                            name="input-hasil">{{ $indikatorUltimate->deskripsi_indikator_ultimate }}</textarea>
                                        <input hidden type="number" class="form-control" id="desc-indikator"
                                            placeholder="Tahun Capaian" name="desc_indikator" style="width: auto"
                                            value="{{ $indikatorUltimate->id_indikator_ultimate }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tahun-capaian">Tahun</label>
                                        <input required type="number" class="form-control" id="tahun-capaian"
                                            placeholder="Tahun Capaian" name="tahun_capaian" style="width: auto"
                                            value={{ old('tahun_ultimate', $capaian->tahun_ultimate) }}>
                                    </div>
                                    <div class="mb-3">
                                        <label for="input-hasil">Hasil</label>
                                        <textarea class="form-control " id="input-hasil" aria-label="With textarea" style="width: 80%;" name="input_hasil">{{ old('keterangan_hasil_ultimate', $capaian->keterangan_hasil_ultimate) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hasil-capaian">Capaian "%"</label>
                                        <input required type="number" class="form-control" id="hasil-capaian"
                                            min="0" max="100" placeholder="Hasil Capaian"
                                            name="hasil_capaian" style="width: 20vh"
                                            value={{ old('capaian_ultimate', $capaian->capaian_ultimate) }}>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                                    </button>
                                </div>
                            </form>
                        @endcannot
                        @can('staff')
                            <form action="/capaian-indikator-ultimate/{{ $capaian->id_capaian_ultimate }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <input hidden type="text" class="form-control" id="desc-indikator"
                                        placeholder="Indikator Ultimate" name="desc_indikator"
                                        value="{{ $indikatorUltimate->deskripsi_indikator_ultimate }}">
                                    <div class="mb-3">
                                        <p> Indikator : <br> {{ $indikatorUltimate->deskripsi_indikator_ultimate }}
                                        </p>
                                        <p> Tahun : <br> {{ $capaian->tahun_ultimate }}</p>
                                        <p> Hasil : <br> {{ $capaian->keterangan_hasil_ultimate }}</p>
                                        <p> Capaian : <br>{{ $capaian->capaian_ultimate }}% </p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message_capaian_ultimate">Message </label>
                                        <textarea required id="message_capaian_ultimate" class="form-control " aria-label="With textarea"
                                            style="width: 80%;" name="message_capaian_ultimate" placeholder="Masukkan Pesan...."></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn" style="background: #008800; color:white;">Send
                                        Request</button>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
            <!--Modal Update Capaian -->
            <div class="modal fade" id="delete-capaian-ultimate-{{ $capaian->id_capaian_ultimate }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="max-width: 70%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="/capaian-indikator-ultimate/{{ $capaian->id_capaian_ultimate }}"
                            method="POST">
                            @method('delete')
                            @csrf
                            <div class="modal-body">
                                <input hidden type="text" class="form-control" id="desc-indikator"
                                    placeholder="Indikator Ultimate" name="desc_indikator"
                                    value="{{ $indikatorUltimate->deskripsi_indikator_ultimate }}">
                                <div class="mb-3">
                                    <p> Indikator : <br> {{ $indikatorUltimate->deskripsi_indikator_ultimate }}
                                    </p>
                                    <p> Tahun : <br> {{ $capaian->tahun_ultimate }}</p>
                                    <p> Hasil : <br> {{ $capaian->keterangan_hasil_ultimate }}</p>
                                    <p> Capaian : <br>{{ $capaian->capaian_ultimate }}% </p>
                                </div>
                                <div class="mb-3">
                                    <label for="message_capaian_ultimate">Message </label>
                                    <textarea required id="message_capaian_ultimate" class="form-control " aria-label="With textarea"
                                        style="width: 80%;" name="message_capaian_ultimate" placeholder="Masukkan Pesan....">Please delete this data</textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn" style="background: #008800; color:white;">Send
                                    Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row" style="gap:1%;">
        <div class="col card px-0"
            style="max-width: 15rem; border:2px dashed #dadada; border-radius:20px; background:none;">
            <div class="card-body d-flex" style="justify-content:center; align-items:center;">
                <div>
                    <h5 class="card-title mb-3" style="font-size: 20px; font-weight:bold;">RincianProgress</h5>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#create-capaian"
                        style="background: #BFDB38; color:white; font-weight:bold;">
                        <i class="bi bi-plus-circle"></i> Add Capaian
                    </button>
                </div>
            </div>
        </div>
        <div class="col mb-0 alert alert-danger d-flex align-items-center justify-content-center" role="alert">
            <p class="m-0">Kosong!!!</p>
        </div>
    </div>
@endif
<div class="modal fade" id="create-capaian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 70%">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/capaian-indikator-ultimate" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="desc-indikator">Indikator</label>
                        <textarea disabled class="form-control " id="input-hasil" aria-label="With textarea" style="width: 80%;"
                            name="input-hasil">{{ $indikatorUltimate->deskripsi_indikator_ultimate }}</textarea>
                        <input hidden type="number" class="form-control" id="desc-indikator"
                            placeholder="Tahun Capaian" name="desc_indikator" style="width: auto"
                            value="{{ $indikatorUltimate->id_indikator_ultimate }}">
                    </div>
                    <div class="mb-3">
                        <label for="tahun-capaian">Tahun</label>
                        <input required type="number" class="form-control" id="tahun-capaian"
                            placeholder="Tahun Capaian" name="tahun_capaian" style="width: auto"
                            min="{{ $ultimateObjective -> periode -> tahun_awal}}" 
                            max="{{ $ultimateObjective -> periode -> tahun_akhir}}"
                            value="{{ $ultimateObjective->periode->tahun_awal }}">
                    </div>
                    <div class="mb-3">
                        <label for="input-hasil">Hasil</label>
                        <textarea class="form-control " id="input-hasil" aria-label="With textarea" style="width: 80%;" name="input_hasil"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="hasil-capaian">Capaian "%"</label>
                        <input required type="number" class="form-control" id="hasil-capaian" min="0"
                            max="100" placeholder="Hasil Capaian" name="hasil_capaian" style="width: 20vh">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
