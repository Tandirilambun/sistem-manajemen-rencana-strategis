@extends('main.index')

@section('index')
    @if (session()->has('login_success'))
        <script>
            Swal.fire({
                title: 'Welcome!',
                text: '{{ auth()->user()->name }}',
                icon: 'success',
                confirmButtonColor: '#477700'
            });
        </script>
    @endif
    <div class="landing-page">
        <h2 class="message">
            Welcome!
            <span class="slides">
                <span class="slide-1">
                    <span>Sistem Manajemen</span>
                    <span>Rencana Strategis</span>
                    <span>Yayasan SATUNAMA</span>
                    <span>Yogyakarta</span>
                </span>
            </span>
            <a href="#roadmap-section" class="homeBtn mt-3 p-0">Getting Started <i
                    class="bi bi-arrow-right ms-2"></i> </a>
        </h2>
        <div>
            <img src="{{ asset('img/illustration/Company-amico.png') }}" alt="logo satunama"
                style="width: 650px; heigth:650px;">
        </div>
    </div>

    <div class="roadmap-section" id="roadmap-section"
        style="height: 100vh; background:white; justify-content: center; align-items: center;">
        <div class="col m-2" style="max-width: 300px">
            <p style="font-size: 25px; font-weight:bold; color:#008800;"> Rencana Strategis Yayasan SATUNAMA Yogyakarta</p>
        </div>
        <div class="col m-2 row row-cols-2 gap-3">
            @foreach ($periodes as $periode)
                <div class="card renstra-parent border border-1" style="width: 12rem; height:12rem; border-radius:2rem;">
                    <a href="/renstrapage/{{ $periode->id_periode }}"
                        class="card-body d-flex justify-content-center align-items-center" style="text-decoration: none;">
                        <div>
                            <div class="d-flex justify-content-center align-items-center">
                                <i class="bi bi-pin-map" style="font-size: 50px"></i>
                            </div>
                            <div class="mt-2" style="text-align: center">
                                <h5 class="card-title rm-title"> {{ $periode->roadmap }} </h5>
                                <h6 class="card-subtitle mt-1 rm-title" style="font-size: 11px"> {{ $periode->tahun_awal }} -
                                    {{ $periode->tahun_akhir }} </h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
