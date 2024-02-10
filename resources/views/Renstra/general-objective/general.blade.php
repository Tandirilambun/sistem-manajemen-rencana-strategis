@if ($strategi->flag_column_keterangan == 8)
    <div class="tab-pane p-4 show active" id="general" role="tabpanel" aria-labelledby="general-tab"
        style="background:white; border-radius:20px;">
        <div class="px-3">
            <h5 style="font-weight:bold; font-size:24px;">General Objective</h5>
            <p style="font-weight:light; font-size:11px; margin:0%;">General Objective dari </p>
        </div>
        <div>
            @if (count($general_query) === 0)
                <div>
                    <div class="alerting d-flex justify-content-center align-items-center">
                        <div>
                            <img src="{{ asset('img/illustration/Shrug-rafiki.png') }}" alt="logo satunama"
                                style="width: 300px; heigth:300px;">
                        </div>
                    </div>
                    <div class="text-center" style="font-size: 20px; font-weight:bold;">
                        Opps! Data Not Found
                    </div>
                </div>
            @else
                <nav class="nav nav-underline px-2">
                    <button class="nav-link active btnNav mx-2" id="nav-overview-general-tab" data-bs-toggle="tab"
                        data-bs-target="#overview-general" type="button" role="tab"
                        aria-controls="nav-overview-general" aria-selected="false">Overview</button>
                    <button class="nav-link btnNav mx-2" id="nav-summary-general-tab" data-bs-toggle="tab"
                        data-bs-target="#summary-general" type="button" role="tab"
                        aria-controls="nav-summary-general" aria-selected="false">Summary</button>
                </nav>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview-general" role="tabpanel"
                        aria-labelledby="overview-general-tab">
                        {{-- @dd($general_query) --}}
                        @foreach ($general_query as $general)
                            <a href="/renstrapage/{{$id}}/general-objective/{{ $general->id_general }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $general->strategi_general }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="tab-pane" id="summary-general" role="tabpanel" aria-labelledby="summary-general-tab">
                        @foreach ($general_query as $general_2)
                            <a href="/renstrapage/{{$id}}/general-objective/{{ $general_2->id_general }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $general_2->strategi_general }}</p>
                                    <div class="container px-0">
                                        <div class="progress_container">
                                            <div class="progress">
                                                <div class="progress_item">
                                                    <h3 class="progress_title pt-0">Progress Now</h3>
                                                    <div class="progress_bar">
                                                        <div class="bar"
                                                            data-value="{{ round($general_2->avg_capaian) }}"
                                                            data-text="{{ round($general_2->avg_capaian) }}"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
