@extends('main.index')

@section('index')
    @if (session()->has('request_status'))
        <script>
            Swal.fire({
                title: 'Good job!',
                text: "{{ session('request_status') }}",
                icon: 'success',
                confirmButtonColor: '#bfdb38'
            });
        </script>
    @endif
    <div class="loading-overlay" id="loading-overlay">
        <div class="custom-loader" id="custom-loader"></div>
        <div class="mt-2" id="loading-message">Please Wait it maybe take a time :)</div>
    </div>
    <div class="container py-5 ">
        <div class="keterangan-roadmap mb-3 pt-3">
            <div class="col d-flex align-items-center justify-content-center">
                <div>
                    <h1 style="font-weight: bolder">DATA PAGE <br> RENCANA STRATEGIS</h1>
                    <small>A place where you can manage data</small><br>
                    <small><code>Update & Delete | sending request for change data</code></small>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <img src="{{ asset('img/illustration/Server-amico.png') }}" alt="company_gif"
                    style="width: 400px; height:400px;">
            </div>
        </div>
        <div class="container search-bar mb-4 py-4" id="container-search"
            style="background-color: white; border-radius:10px;">
            <div id="search-bar" class="mx-5" style="width:100%; height:100%;">
                <form class="form-search d-flex" action="/data-page" id="search-form">
                    <input type="search" id="search-item" name="search" class="form-control"
                        placeholder="Cari Indikator..." aria-label="Username" aria-describedby="basic-addon1"
                        style="border-radius: 1rem 0 0 1rem; height:2rem; text-align:center"
                        value="{{ isset($old_search) ? $old_search : old('old_search') }}">
                    <button class="btnSrch btn py-0" type="submit" id="button-addon1"
                        style="background-color: #0096FF; color:white; border-radius:0 1rem 1rem 0; height:2rem;"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <nav class="mb-4 py-2" style="background-color: white; border-radius:10px;">
            <div class="nav nav-tabs tabsNav d-flex justify-content-center" id="nav-tab" role="tablist">
                <button class="nav-link active btnNav mx-2" id="nav-strategi-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-strategi" type="button" role="tab" aria-controls="nav-strategi"
                    aria-selected="false">Strategi</button>
                <button class="nav-link btnNav mx-2" id="nav-indikator-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-indikator" type="button" role="tab" aria-controls="nav-indikator"
                    aria-selected="false">Indikator</button>
            </div>
        </nav>
        <div class="tabs">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active p-5" id="nav-strategi" role="tabpanel" aria-labelledby="nav-goal-tab"
                    style="background-color: white; border-radius:20px;">
                    <!--General Objective-->
                    <div class="mb-5">
                        <p>General Objective</p>
                        @if (count($general_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($general_strategi_query as $strategi_general)
                                        <tr>
                                            <td>{{ $strategi_general->periode->roadmap }}</td>
                                            <td>{{ $strategi_general->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_general->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_general->strategi_general }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/general-objective/{{ $strategi_general->id_general }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-general-{{ $strategi_general->id_general }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-general-{{ $strategi_general->id_general }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-general-{{ $strategi_general->id_general }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/general-objective/{{ $strategi_general->id_general }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_general" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_general', $strategi_general->strategi_general) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                        <!-- Modal Update -->
                                        <div class="modal fade"
                                            id="update-strategi-general-{{ $strategi_general->id_general }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @can('staff')
                                                        <form action="/general-objective/{{ $strategi_general->id_general }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_general">General Objective</label>
                                                                    <textarea id="input_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_general" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_general', $strategi_general->strategi_general) }}</textarea>
                                                                    <textarea id="input_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_general" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_general', $strategi_general->strategi_general) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_general">Message </label>
                                                                    <textarea required id="message_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_general" placeholder="Masukkan Strategi...">{{ old('strategi_general', $strategi_general->strategi_general) }}</textarea>
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
                                                    @cannot('staff')
                                                        <form action="/general-objective/{{ $strategi_general->id_general }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-1">Periode</label>
                                                                    <select required id="select-periode-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectPeriode">
                                                                        <option selected value="">Select Periode...
                                                                        </option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_general->id_periode)
                                                                                <option selected
                                                                                    value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_general">General Objective</label>
                                                                    <textarea required id="input_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_general" placeholder="Masukkan Strategi...">{{ old('strategi_general', $strategi_general->strategi_general) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Ultimate Objective-->
                    <div class="mb-5">
                        <p>Ultimate Objective</p>
                        @if (count($ultimate_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                          
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimate_strategi_query as $strategi_ultimate)
                                        <tr>
                                            <td>{{ $strategi_ultimate->periode->roadmap }}</td>
                                            <td>{{ $strategi_ultimate->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_ultimate->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_ultimate->strategi_ultimate }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/ultimate-objective/{{ $strategi_ultimate->id_ultimate }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-ultimate-{{ $strategi_ultimate->id_ultimate }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-ultimate-{{ $strategi_ultimate->id_ultimate }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pencil m-0"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal update -->
                                        <div class="modal fade"
                                            id="update-strategi-ultimate-{{ $strategi_ultimate->id_ultimate }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form action="/ultimate-objective/{{ $strategi_ultimate->id_ultimate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-2">Periode</label>
                                                                    <select required id="select-periode-2" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                                        <option selected value="">Select Periode...</option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_ultimate->id_periode)
                                                                                <option selected value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="select-general-2">General Objective</label>
                                                                    <select required id="select-general-2" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectGeneral">
                                                                        <option selected value="">Select General Objective...
                                                                        </option>
                                                                        @foreach ($generals as $general)
                                                                            @if (old('id_general', $general->id_general) === $strategi_ultimate->id_general)
                                                                                <option selected value={{ $general->id_general }}>
                                                                                    {{ $general->strategi_general }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $general->id_general }}>
                                                                                    {{ $general->strategi_general }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_ultimate">Ultimate Objective</label>
                                                                    <textarea required class="form-control " id="input_ultimate" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_ultimate" placeholder="Masukkan Strategi...">{{ old('strategi_ultimate', $strategi_ultimate->strategi_ultimate) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form action="/ultimate-objective/{{ $strategi_ultimate->id_ultimate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_ultimate">ultimate Objective</label>
                                                                    <textarea id="input_ultimate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_ultimate" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_ultimate', $strategi_ultimate->strategi_ultimate) }}</textarea>
                                                                    <textarea id="input_ultimate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_ultimate" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_ultimate', $strategi_ultimate->strategi_ultimate) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_ultimate">Message </label>
                                                                    <textarea required id="message_ultimate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_ultimate" placeholder="Masukkan Strategi...">{{ old('strategi_ultimate', $strategi_ultimate->strategi_ultimate) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-ultimate-{{ $strategi_ultimate->id_ultimate }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/ultimate-objective/{{ $strategi_ultimate->id_ultimate }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_ultimate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_ultimate" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_ultimate', $strategi_ultimate->strategi_ultimate) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Intermediate Objective-->
                    <div class="mb-5">
                        <p>Intermediate Objective</p>
                        @if (count($intermediate_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($intermediate_strategi_query as $strategi_intermediate)
                                        <tr>
                                            <td>{{ $strategi_intermediate->periode->roadmap }}</td>
                                            <td>{{ $strategi_intermediate->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_intermediate->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_intermediate->strategi_intermediate }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/intermediate-objective/{{ $strategi_intermediate->id_intermediate }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-intermediate-{{ $strategi_intermediate->id_intermediate }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-intermediate-{{ $strategi_intermediate->id_intermediate }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pencil m-0"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Update -->
                                        <div class="modal fade"
                                            id="update-strategi-intermediate-{{ $strategi_intermediate->id_intermediate }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/intermediate-objective/{{ $strategi_intermediate->id_intermediate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-3">Periode</label>
                                                                    <select required id="select-periode-3" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                                        <option selected value="">Select Periode...</option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_intermediate->id_periode)
                                                                                <option selected value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="select-ultimate-2">Ultimate Objective</label>
                                                                    <select required id="select-ultimate-2" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectUltimate">
                                                                        <option selected value="">Select Ultimate
                                                                            Objective...</option>
                                                                        @foreach ($ultimates as $ultimate)
                                                                            @if (old('id_ultimate', $ultimate->id_ultimate) === $strategi_intermediate->id_ultimate)
                                                                                <option selected
                                                                                    value={{ $ultimate->id_ultimate }}>
                                                                                    {{ $ultimate->strategi_ultimate }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $ultimate->id_ultimate }}>
                                                                                    {{ $ultimate->strategi_ultimate }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_intermediate">Intermediate Objective</label>
                                                                    <textarea required class="form-control" id="input_intermediate" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_intermediate" placeholder="Masukkan Strategi...">{{ old('strategi_intermediate', $strategi_intermediate->strategi_intermediate) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/intermediate-objective/{{ $strategi_intermediate->id_intermediate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_intermediate">intermediate Objective</label>
                                                                    <textarea id="input_intermediate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_intermediate" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_intermediate', $strategi_intermediate->strategi_intermediate) }}</textarea>
                                                                    <textarea id="input_intermediate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_intermediate" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_intermediate', $strategi_intermediate->strategi_intermediate) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_intermediate">Message </label>
                                                                    <textarea required id="message_intermediate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_intermediate" placeholder="Masukkan Strategi...">{{ old('strategi_intermediate', $strategi_intermediate->strategi_intermediate) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-intermediate-{{ $strategi_intermediate->id_intermediate }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/intermediate-objective/{{ $strategi_intermediate->id_intermediate }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_intermediate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_intermediate" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_intermediate', $strategi_intermediate->strategi_intermediate) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Outcome-->
                    <div class="mb-5">
                        <p>Outcome</p>
                        @if (count($outcome_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($outcome_strategi_query as $strategi_outcome)
                                        <tr>
                                            <td>{{ $strategi_outcome->periode->roadmap }}</td>
                                            <td>{{ $strategi_outcome->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_outcome->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_outcome->strategi_outcome }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form action="/outcome/{{ $strategi_outcome->id_outcome }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-outcome-{{ $strategi_outcome->id_outcome }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-outcome-{{ $strategi_outcome->id_outcome }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pencil m-0"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Update -->
                                        <div class="modal fade"
                                            id="update-strategi-outcome-{{ $strategi_outcome->id_outcome }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form action="/outcome/{{ $strategi_outcome->id_outcome }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-4">Periode</label>
                                                                    <select required id="select-periode-4" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                                        <option selected value="">Select Periode...</option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_outcome->id_periode)
                                                                                <option selected value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="select-intermediate-2">Intermediate
                                                                        Objective</label>
                                                                    <select required id="select-intermediate-2" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectIntermediate">
                                                                        <option selected value="">Select Intermediate
                                                                            Objective...</option>
                                                                        @foreach ($intermediates as $intermediate)
                                                                            @if (old('id_intermediate', $intermediate->id_intermediate) === $strategi_outcome->id_intermediate)
                                                                                <option selected
                                                                                    value={{ $intermediate->id_intermediate }}>
                                                                                    {{ $intermediate->strategi_intermediate }}
                                                                                </option>
                                                                            @else
                                                                                <option
                                                                                    value={{ $intermediate->id_intermediate }}>
                                                                                    {{ $intermediate->strategi_intermediate }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_outcome">Outcome</label>
                                                                    <textarea required class="form-control" id="input_outcome" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_outcome" placeholder="Masukkan Strategi...">{{ old('strategi_outcome', $strategi_outcome->strategi_outcome) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form action="/outcome/{{ $strategi_outcome->id_outcome }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_outcome">Outcome</label>
                                                                    <textarea id="input_outcome" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_outcome" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_outcome', $strategi_outcome->strategi_outcome) }}</textarea>
                                                                    <textarea id="input_outcome" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_outcome" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_outcome', $strategi_outcome->strategi_outcome) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_outcome">Message </label>
                                                                    <textarea required id="message_outcome" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_outcome" placeholder="Masukkan Strategi...">{{ old('strategi_outcome', $strategi_outcome->strategi_outcome) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-outcome-{{ $strategi_outcome->id_outcome }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/outcome/{{ $strategi_outcome->id_outcome }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_outcome" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_outcome" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_outcome', $strategi_outcome->strategi_outcome) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Use Of Output-->
                    <div class="mb-5">
                        <p>Use Of Output</p>
                        @if (count($use_of_output_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($use_of_output_strategi_query as $strategi_use_of_output)
                                        <tr>
                                            <td>{{ $strategi_use_of_output->periode->roadmap }}</td>
                                            <td>{{ $strategi_use_of_output->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_use_of_output->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_use_of_output->strategi_use_of_output }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/use-of-output/{{ $strategi_use_of_output->id_use_of_output }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-use-of-output-{{ $strategi_use_of_output->id_use_of_output }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-use-of-output-{{ $strategi_use_of_output->id_use_of_output }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pencil m-0"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Update-->
                                        <div class="modal fade"
                                            id="update-strategi-use-of-output-{{ $strategi_use_of_output->id_use_of_output }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/use-of-output/{{ $strategi_use_of_output->id_use_of_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-5">Periode</label>
                                                                    <select required id="select-periode-5" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                                        <option selected value="">Select Periode...</option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_use_of_output->id_periode)
                                                                                <option selected value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
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
                                                                            @if (old('id_outcome', $outcome->id_outcome) === $strategi_use_of_output->id_outcome)
                                                                                <option selected value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_useofoutput">Use of Output</label>
                                                                    <textarea required class="form-control" id="input_useofoutput" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_useofoutput" placeholder="Masukkan Strategi...">{{ old('strategi_use_of_output', $strategi_use_of_output->strategi_use_of_output) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/use-of-output/{{ $strategi_use_of_output->id_use_of_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_useofoutput">Use Of Output</label>
                                                                    <textarea id="input_useofoutput" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_useofoutput" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_use_of_output', $strategi_use_of_output->strategi_use_of_output) }}</textarea>
                                                                    <textarea id="input_useofoutput" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_useofoutput" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_use_of_output', $strategi_use_of_output->strategi_use_of_output) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_useofoutput">Message </label>
                                                                    <textarea required id="message_useofoutput" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_useofoutput" placeholder="Masukkan Strategi...">{{ old('strategi_use_of_output', $strategi_use_of_output->strategi_use_of_output) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-use-of-output-{{ $strategi_use_of_output->id_use_of_output }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/use-of-output/{{ $strategi_use_of_output->id_use_of_output }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_useofoutput" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_useofoutput" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_use_of_output', $strategi_use_of_output->strategi_use_of_output) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Output-->
                    <div class="mb-5">
                        <p>Output</p>
                        @if (count($output_strategi_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-strategi">
                                <thead>
                                    <tr>
                                        <th scope="col">Roadmap</th>
                                        <th scope="col">Tahun Awal</th>
                                        <th scope="col">Tahun Akhir</th>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($output_strategi_query as $strategi_output)
                                        <tr>
                                            <td>{{ $strategi_output->periode->roadmap }}</td>
                                            <td>{{ $strategi_output->periode->tahun_awal }}</td>
                                            <td>{{ $strategi_output->periode->tahun_akhir }}</td>
                                            <td>{{ $strategi_output->strategi_output }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form action="/output/{{ $strategi_output->id_output }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-strategi-output-{{ $strategi_output->id_output }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash3 m-0"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-strategi-output-{{ $strategi_output->id_output }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-pencil m-0"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!--Modal Update-->
                                        <div class="modal fade"
                                            id="update-strategi-output-{{ $strategi_output->id_output }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form action="/output/{{ $strategi_output->id_output }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-periode-6">Periode</label>
                                                                    <select required id="select-periode-6" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectPeriode">
                                                                        <option selected value="">Select Periode...</option>
                                                                        @foreach ($periodes as $periode)
                                                                            @if (old('id_periode', $periode->id_periode) === $strategi_output->id_periode)
                                                                                <option selected value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }})
                                                                                    <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $periode->id_periode }}>
                                                                                    {{ $periode->roadmap }}
                                                                                    ({{ $periode->tahun_awal }} -
                                                                                    {{ $periode->tahun_akhir }}) <br>
                                                                                    *{{ $periode->flag_column_keterangan }}
                                                                                    tingkat
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="select-outcome">Outcome</label>
                                                                    <select id="select-outcome" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectOutcome">
                                                                        <option selected value="">Select Outcome...</option>
                                                                        @foreach ($outcomes as $outcome)
                                                                            @if (old('id_outcome', $outcome->id_outcome) == $strategi_output->id_outcome)
                                                                                <option value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="select-useofoutput-2">Use of Output</label>
                                                                    <select id="select-useofoutput-2" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectUseofoutput">
                                                                        <option selected value="">Select Use of Output...
                                                                        </option>
                                                                        @foreach ($use_of_outputs as $use_of_output)
                                                                            @if (old('id_use_of_output', $use_of_output->id_use_of_output) == $strategi_output->id_use_of_output)
                                                                                <option
                                                                                    selected value={{ $use_of_output->id_use_of_output }}>
                                                                                    {{ $use_of_output->strategi_use_of_output }}
                                                                                </option>
                                                                            @else
                                                                                <option
                                                                                    value={{ $use_of_output->id_use_of_output }}>
                                                                                    {{ $use_of_output->strategi_use_of_output }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_output">Output</label>
                                                                    <textarea required class="form-control" id="input_output" aria-label="With textarea" style="width: 80%;" name="input_output"
                                                                        placeholder="Masukkan Strategi...">{{ old('strategi_output', $strategi_output->strategi_output) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form action="/output/{{ $strategi_output->id_output }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_output">Output</label>
                                                                    <textarea id="input_output" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_output" placeholder="Masukkan Strategi..." hidden>{{ old('strategi_output', $strategi_output->strategi_output) }}</textarea>
                                                                    <textarea id="input_output" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="input_output" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_output', $strategi_output->strategi_output) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_output">Message</label>
                                                                    <textarea required id="message_output" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_output" placeholder="Masukkan Strategi...">{{ old('strategi_output', $strategi_output->strategi_output) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-strategi-output-{{ $strategi_output->id_output }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/output/{{ $strategi_output->id_output }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_output" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                name="input_output" placeholder="Masukkan Strategi..." disabled>{{ old('strategi_output', $strategi_output->strategi_output) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade p-5" id="nav-indikator" role="tabpanel" aria-labelledby="nav-goal-tab"
                    style="background-color: white; border-radius:20px;">
                    <!--Indikator General Objective-->
                    <div class="mb-5">
                        <p>Indikator General Objective</p>
                        @if (count($general_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($general_indikator_query as $indikator_general)
                                        <tr>
                                            <td>{{ $indikator_general->general_objective->strategi_general }}</td>
                                            <td>{{ $indikator_general->deskripsi_indikator_general }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-general/{{ $indikator_general->id_indikator_general }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-general-{{ $indikator_general->id_indikator_general }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-general-{{ $indikator_general->id_indikator_general }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Update-->
                                        <div class="modal fade"
                                            id="update-indikator-general-{{ $indikator_general->id_indikator_general }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-general/{{ $indikator_general->id_indikator_general }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-general-1">General Objective</label>
                                                                    <select required id="select-general-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        name="selectGeneral">
                                                                        <option selected value="">Select General
                                                                            Objective...
                                                                        </option>
                                                                        @foreach ($generals as $general)
                                                                            @if (old('id_general', $general->id_general) === $indikator_general->id_general)
                                                                                <option selected value={{ $general->id_general }}>
                                                                                    {{ $general->strategi_general }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $general->id_general }}>
                                                                                    {{ $general->strategi_general }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_general">Indikator</label>
                                                                    <textarea required id="input_indikator_general" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_general" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_general', $indikator_general->deskripsi_indikator_general) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-general/{{ $indikator_general->id_indikator_general }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_general">General Objective</label>
                                                                    <textarea id="input_indikator_general" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_general" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_general', $indikator_general->deskripsi_indikator_general) }}</textarea>
                                                                    <textarea id="input_indikator_general" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_general" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_general', $indikator_general->deskripsi_indikator_general) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_general">Message </label>
                                                                    <textarea required id="message_indikator_general" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_indikator_general" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_general', $indikator_general->deskripsi_indikator_general) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-indikator-general-{{ $indikator_general->id_indikator_general }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-general/{{ $indikator_general->id_indikator_general }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_general" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_general" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_general', $indikator_general->deskripsi_indikator_general) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Indikator Ultimate Objective-->
                    <div class="mb-5">
                        <p>Indikator Ultimate Objective</p>
                        @if (count($ultimate_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ultimate_indikator_query as $indikator_ultimate)
                                        <tr>
                                            <td>{{ $indikator_ultimate->ultimate_objective->strategi_ultimate }}</td>
                                            <td>{{ $indikator_ultimate->deskripsi_indikator_ultimate }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-ultimate/{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-ultimate-{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-ultimate-{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="update-indikator-ultimate-{{ $indikator_ultimate->id_indikator_ultimate }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-ultimate/{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-ultimate-1">Ultimate Objective</label>
                                                                    <select required id="select-ultimate-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectUltimate">
                                                                        <option selected value="">Select Ultimate
                                                                            Objective...</option>
                                                                        @foreach ($ultimates as $ultimate)
                                                                            @if (old('id_ultimate', $ultimate->id_ultimate) === $indikator_ultimate->id_ultimate)
                                                                                <option selected
                                                                                    value={{ $ultimate->id_ultimate }}>
                                                                                    {{ $ultimate->strategi_ultimate }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $ultimate->id_ultimate }}>
                                                                                    {{ $ultimate->strategi_ultimate }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_ultimate">Indikator</label>
                                                                    <textarea required id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_ultimate" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_ultimate', $indikator_ultimate->deskripsi_indikator_ultimate) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-ultimate/{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_ultimate">Ultimate
                                                                        Objective</label>
                                                                    <textarea id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_ultimate" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_ultimate', $indikator_ultimate->deskripsi_indikator_ultimate) }}</textarea>
                                                                    <textarea id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_ultimate" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_ultimate', $indikator_ultimate->deskripsi_indikator_ultimate) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_ultimate">Message </label>
                                                                    <textarea required id="message_indikator_ultimate" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_indikator_ultimate" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_ultimate', $indikator_ultimate->deskripsi_indikator_ultimate) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-indikator-ultimate-{{ $indikator_ultimate->id_indikator_ultimate }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-ultimate/{{ $indikator_ultimate->id_indikator_ultimate }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_ultimate" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_ultimate', $indikator_ultimate->deskripsi_indikator_ultimate) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Indikator Intermediate Objective-->
                    <div class="mb-5">
                        <p>Indikator Intermediate Objective</p>
                        @if (count($intermediate_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                           
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($intermediate_indikator_query as $indikator_intermediate)
                                        <tr>
                                            <td>{{ $indikator_intermediate->intermediate_objective->strategi_intermediate }}
                                            </td>
                                            <td>{{ $indikator_intermediate->deskripsi_indikator_intermediate }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-intermediate/{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-intermediate-{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-intermediate-{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="update-indikator-intermediate-{{ $indikator_intermediate->id_indikator_intermediate }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-intermediate/{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-intermediate-1">Intermediate
                                                                        Objective</label>
                                                                    <select required id="select-intermediate-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectIntermediate">
                                                                        <option selected value="">Select Intermediate
                                                                            Objective...</option>
                                                                        @foreach ($intermediates as $intermediate)
                                                                            @if (old('id_intermediate', $intermediate->id_intermediate) === $indikator_intermediate->id_intermediate)
                                                                                <option selected
                                                                                    value={{ $intermediate->id_intermediate }}>
                                                                                    {{ $intermediate->strategi_intermediate }}
                                                                                </option>
                                                                            @else
                                                                                <option
                                                                                    value={{ $intermediate->id_intermediate }}>
                                                                                    {{ $intermediate->strategi_intermediate }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_intermediate">Indikator</label>
                                                                    <textarea required id="input_indikator_intermediate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_intermediate" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_intermediate', $indikator_intermediate->deskripsi_indikator_intermediate) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-intermediate/{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_intermediate">Intermediate
                                                                        Objective</label>
                                                                    <textarea id="input_indikator_intermediate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_intermediate" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_intermediate', $indikator_intermediate->deskripsi_indikator_intermediate) }}</textarea>
                                                                    <textarea id="input_indikator_intermediate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_intermediate" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_intermediate', $indikator_intermediate->deskripsi_indikator_intermediate) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_intermediate">Message </label>
                                                                    <textarea required id="message_indikator_intermediate" class="form-control " aria-label="With textarea"
                                                                        style="width: 80%;" name="message_indikator_intermediate" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_intermediate', $indikator_intermediate->deskripsi_indikator_intermediate) }}</textarea>
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
                                        <!-- Modal Delete -->
                                        <div class="modal fade"
                                            id="delete-indikator-intermediate-{{ $indikator_intermediate->id_indikator_intermediate }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-intermediate/{{ $indikator_intermediate->id_indikator_intermediate }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_intermediate" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_intermediate" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_intermediate', $indikator_intermediate->deskripsi_indikator_intermediate) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Indikator Outcome-->
                    <div class="mb-5">
                        <p>Indikator Outcome</p>
                        @if (count($outcome_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                        
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($outcome_indikator_query as $indikator_outcome)
                                        <tr>
                                            <td>{{ $indikator_outcome->outcome->strategi_outcome }}</td>
                                            <td>{{ $indikator_outcome->deskripsi_indikator_outcome }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-outcome/{{ $indikator_outcome->id_indikator_outcome }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-outcome-{{ $indikator_outcome->id_indikator_outcome }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-outcome-{{ $indikator_outcome->id_indikator_outcome }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="update-indikator-outcome-{{ $indikator_outcome->id_indikator_outcome }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-outcome/{{ $indikator_outcome->id_indikator_outcome }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-outcome-1">Outcome</label>
                                                                    <select required id="select-outcome-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectOutcome">
                                                                        <option selected value="">Select Outcome...</option>
                                                                        @foreach ($outcomes as $outcome)
                                                                            @if (old('id_outcome', $outcome->id_outcome) === $indikator_outcome->id_outcome)
                                                                                <option selected value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $outcome->id_outcome }}>
                                                                                    {{ $outcome->strategi_outcome }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_outcome">Indikator</label>
                                                                    <textarea required id="input_indikator_outcome" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_outcome" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_outcome', $indikator_outcome->deskripsi_indikator_outcome) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-outcome/{{ $indikator_outcome->id_indikator_outcome }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_outcome">Outcome</label>
                                                                    <textarea id="input_indikator_outcome" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_outcome" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_outcome', $indikator_outcome->deskripsi_indikator_outcome) }}</textarea>
                                                                    <textarea id="input_indikator_outcome" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_outcome" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_outcome', $indikator_outcome->deskripsi_indikator_outcome) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_outcome">Message </label>
                                                                    <textarea required id="message_indikator_outcome" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_indikator_outcome" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_outcome', $indikator_outcome->deskripsi_indikator_outcome) }}</textarea>
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
                                        <!-- Modal Delete-->
                                        <div class="modal fade"
                                            id="delete-indikator-outcome-{{ $indikator_outcome->id_indikator_outcome }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-outcome/{{ $indikator_outcome->id_indikator_outcome }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_outcome" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_outcome" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_outcome', $indikator_outcome->deskripsi_indikator_outcome) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Indikator Use of Output-->
                    <div class="mb-5">
                        <p>Indikator Use Of Output</p>
                        @if (count($use_of_output_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else                            
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($use_of_output_indikator_query as $indikator_use_of_output)
                                        <tr>
                                            <td>{{ $indikator_use_of_output->use_of_output->strategi_use_of_output }}</td>
                                            <td>{{ $indikator_use_of_output->deskripsi_indikator_use_of_output }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-use-of-output/{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-use-of-output-{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-use-of-output-{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="update-indikator-use-of-output-{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-use-of-output/{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-useofoutput-1">Use of Output</label>
                                                                    <select required id="select-useofoutput-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;"
                                                                        name="selectUseofoutput">
                                                                        <option selected value="">Select Use of Output...
                                                                        </option>
                                                                        @foreach ($use_of_outputs as $use_of_output)
                                                                            @if (old('id_use_of_output', $use_of_output->id_use_of_output) === $indikator_use_of_output->id_use_of_output)
                                                                                <option selected
                                                                                    value={{ $use_of_output->id_use_of_output }}>
                                                                                    {{ $use_of_output->strategi_use_of_output }}
                                                                                </option>
                                                                            @else
                                                                                <option
                                                                                    value={{ $use_of_output->id_use_of_output }}>
                                                                                    {{ $use_of_output->strategi_use_of_output }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_useofoutput">Indikator</label>
                                                                    <textarea required id="input_indikator_useofoutput" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_useofoutput" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_use_of_output', $indikator_use_of_output->deskripsi_indikator_use_of_output) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-use-of-output/{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_useofoutput">Use Of Output</label>
                                                                    <textarea id="input_indikator_useofoutput" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_useofoutput" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_use_of_output', $indikator_use_of_output->deskripsi_indikator_use_of_output) }}</textarea>
                                                                    <textarea id="input_indikator_useofoutput" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_useofoutput" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_use_of_output', $indikator_use_of_output->deskripsi_indikator_use_of_output) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_useofoutput">Message </label>
                                                                    <textarea required id="message_indikator_useofoutput" class="form-control " aria-label="With textarea"
                                                                        style="width: 80%;" name="message_indikator_useofoutput" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_use_of_output', $indikator_use_of_output->deskripsi_indikator_use_of_output) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Send
                                                                    Request</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Delete-->
                                        <div class="modal fade"
                                            id="delete-indikator-use-of-output-{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-use-of-output/{{ $indikator_use_of_output->id_indikator_use_of_output }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_useofoutput" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_useofoutput" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_use_of_output', $indikator_use_of_output->deskripsi_indikator_use_of_output) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <!--Indikator Output-->
                    <div class="mb-5">
                        <p>Indikator Output</p>
                        @if (count($output_indikator_query) == 0)
                            <div class="alert alert-info border border-0" role="alert">
                                Oops! There is no data:)
                            </div>
                        @else
                            <table class="table table-striped table-indikator">
                                <thead>
                                    <tr>
                                        <th scope="col">Strategi</th>
                                        <th scope="col">Indikator</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($output_indikator_query as $indikator_output)
                                        <tr>
                                            <td>{{ $indikator_output->output->strategi_output }}</td>
                                            <td>{{ $indikator_output->deskripsi_indikator_output }}</td>
                                            <td>
                                                <div id="btn-olah">
                                                    <div class="d-flex">
                                                        @cannot('staff')
                                                            <form
                                                                action="/indikator-output/{{ $indikator_output->id_indikator_output }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button
                                                                    class="btn btn-olah me-1  d-flex justify-content-center align-items-center"
                                                                    style="background-color:red;"
                                                                    onclick="return confirm('Are you sure to delete this data?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endcannot
                                                        @can('staff')
                                                            <button type="button"
                                                                class="btn-olah btn me-1 d-flex justify-content-center align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delete-indikator-output-{{ $indikator_output->id_indikator_output }}"
                                                                style="background-color:red;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash3 m-0" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                                </svg>
                                                            </button>
                                                        @endcan
                                                        <button type="button"
                                                            class="btn-olah btn  d-flex justify-content-center align-items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#update-indikator-output-{{ $indikator_output->id_indikator_output }}"
                                                            style="background-color: #008800;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-pencil m-0" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade"
                                            id="update-indikator-output-{{ $indikator_output->id_indikator_output }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    @cannot('staff')
                                                        <form
                                                            action="/indikator-output/{{ $indikator_output->id_indikator_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="select-output-1">output</label>
                                                                    <select required id="select-output-1" class="form-select mb-3"
                                                                        aria-label=".form-select-lg example"
                                                                        style="max-width:auto; width:auto;" name="selectoutput">
                                                                        <option selected value="">Select output...</option>
                                                                        @foreach ($outputs as $output)
                                                                            @if (old('id_output', $output->id_output) === $indikator_output->id_output)
                                                                                <option selected value={{ $output-> id_output }}>
                                                                                    {{ $output->strategi_output }}
                                                                                </option>
                                                                            @else
                                                                                <option value={{ $output->id_output }}>
                                                                                    {{ $output->strategi_output }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_output">Indikator</label>
                                                                    <textarea required id="input_indikator_output" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_output" placeholder="Masukkan Indikator...">{{ old('deskripsi_indikator_output', $indikator_output->deskripsi_indikator_output) }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn" style="background: #008800; color:white;">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    @endcannot
                                                    @can('staff')
                                                        <form
                                                            action="/indikator-output/{{ $indikator_output->id_indikator_output }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="input_indikator_output">Use Of Output</label>
                                                                    <textarea id="input_indikator_output" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_output" placeholder="Masukkan Indikator..." hidden>{{ old('deskripsi_indikator_output', $indikator_output->deskripsi_indikator_output) }}</textarea>
                                                                    <textarea id="input_indikator_output" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                        name="input_indikator_output" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_output', $indikator_output->deskripsi_indikator_output) }}</textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="message_indikator_output">Message </label>
                                                                    <textarea required id="message_indikator_output" class="form-control " aria-label="With textarea" style="width: 80%;"
                                                                        name="message_indikator_output" placeholder="Masukkan Pesan...">{{ old('deskripsi_indikator_output', $indikator_output->deskripsi_indikator_output) }}</textarea>
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
                                        <!-- Modal Delete-->
                                        <div class="modal fade"
                                            id="delete-indikator-output-{{ $indikator_output->id_indikator_output }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Request for
                                                            Delete
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="/indikator-output/{{ $indikator_output->id_indikator_output }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <textarea id="input_indikator_output" class="form-control" aria-label="With textarea" style="width: 80%;"
                                                                name="input_indikator_output" placeholder="Masukkan Indikator..." disabled>{{ old('deskripsi_indikator_output', $indikator_output->deskripsi_indikator_output) }}</textarea>
                                                            <br>
                                                            <p class="mb-0"> Request Delete for this data? </p>
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
