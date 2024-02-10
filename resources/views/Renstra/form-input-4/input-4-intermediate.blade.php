@extends('main.index')
@section('index')
    <div class="container py-5">
        <div class=" mb-3 py-4 d-flex justify-content-center" style="background: white">
            <div style="flex:1;">
                @include('Component.step-4')
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div style="flex: 1;">
                <div class="p-3" style="background: white;">
                    <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Goal </p>
                    <form action="/create-4/intermediate-objective/add" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="select-periode-3">Periode</label>
                            <select id="select-periode-3" class="form-select mb-3" aria-label=".form-select-lg example"
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
                        {{-- <div class="mb-3">
                            <label for="select-ultimate-2">Ultimate Objective</label>
                            <select id="select-ultimate-2" class="form-select mb-3" aria-label=".form-select-lg example"
                                style="max-width:auto; width:auto;" name="selectUltimate">
                                <option selected value="">Select Ultimate Objective...
                                </option>
                                @foreach ($ultimates as $ultimate)
                                    <option value={{ $ultimate->id_ultimate }}>
                                        {{ $ultimate->strategi_ultimate }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="mb-3" id="fieldIntermediate">
                            <label for="input_intermediate">Goal</label>
                            <textarea required class="form-control mb-2" id="input_intermediate" aria-label="With textarea" style="width: 80%;"
                                name="input_intermediate" placeholder="Masukkan Strategi..."></textarea>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="gap: 1%">
                            <a href="{{route('step_1')}}" class="btn btnAdd" style="background:#008800; color:white;">
                                Back </a>
                            <button type="submit" class="btn btnAdd" style="background:#008800; color:white;">
                                <i class="bi bi-plus-square-dotted crtAdd"></i>Save
                            </button>
                            <a href="{{route('step_3')}}" class="btn btnAdd" style="background:#008800; color:white;">
                                Next </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
