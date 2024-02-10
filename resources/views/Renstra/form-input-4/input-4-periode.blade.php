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
            <div class="p-3" style="background: white">
                <p class="mb-2" style="font-size: 17px; font-weight:bold;">Periode</p>
                <form method="POST" action="/create-4/periode/add">
                    @csrf
                    <div class="mb-3">
                        <label for="input-ket">Keterangan Roadmap</label>
                        <div id="input-ket" class="d-flex" style="gap:1%;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flag_keterangan" id="select-ket-4"
                                    value=4 checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    4 Tingkat
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputRoadmap">Roadmap</label>
                        <input type="text" class="form-control @error('inputRoadmap') is-invalid @enderror"
                            id="inputRoadmap" placeholder="Roadmap" name="inputRoadmap" style="width: auto">
                        @error('inputRoadmap')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahunAwal">Tahun Awal</label>
                        @if($periode_last == null)
                            <input type="number" class="form-control @error('tahunAwal') is-invalid @enderror" id="tahunAwal"
                                placeholder="Tahun Awal" name="tahunAwal" style="width: auto">
                        @else
                            <input type="number" class="form-control @error('tahunAwal') is-invalid @enderror" id="tahunAwal"
                                placeholder="Tahun Awal" name="tahunAwal" style="width: auto" value="{{$periode_last -> tahun_akhir + 1}}">
                        @endif
                        @error('tahunAwal')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center align-items-center" style="gap: 1%">
                        <button type="submit" class="btn btnAdd" style="background:#008800; color:white;">
                            <i class="bi bi-plus-square-dotted crtAdd"></i>Add Data
                        </button>
                        <a href="{{route('step_2')}}" class="btn btnAdd" style="background:#008800; color:white;">
                            Next </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
