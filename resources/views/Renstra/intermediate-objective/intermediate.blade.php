@if ($strategi->flag_column_keterangan == 4)
    <div class="tab-pane p-4 show active" id="intermediate" role="tabpanel" aria-labelledby="intermediate-tab"
        style="background:white; border-radius:20px;">
        <div class="px-3">
            <h5 style="font-weight:bold; font-size:24px;">Intermediate Objective</h5>
            <p style="font-weight:light; font-size:11px; margin:0%;">Intermediate Objective dari</p>
        </div>
        <div>
            @if (count($intermediate_query) == 0)
                <div>
                    <div class="alerting d-flex justify-content-center align-items-center">
                        <div>
                            <img src="{{ asset('img/illustration/Shrug-rafiki.png') }}" alt="illustration"
                                style="width: 300px; heigth:300px;">
                        </div>
                    </div>
                    <div class="text-center" style="font-size: 20px; font-weight:bold;">
                        Opps! Data Not Found
                    </div>
                </div>
            @else
                <nav class="nav nav-underline px-2">
                    <button class="nav-link active btnNav mx-2" id="nav-overview-intermediate-tab" data-bs-toggle="tab"
                        data-bs-target="#overview-intermediate" type="button" role="tab"
                        aria-controls="nav-overview-intermediate" aria-selected="false">Overview</button>
                    <button class="nav-link btnNav mx-2" id="nav-summary-intermediate-tab" data-bs-toggle="tab"
                        data-bs-target="#summary-intermediate" type="button" role="tab"
                        aria-controls="nav-summary-intermediate" aria-selected="false">Summary</button>
                </nav>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview-intermediate" role="tabpanel"
                        aria-labelledby="overview-intermediate-tab">
                        @foreach ($intermediate_query as $intermediate)
                            <a href="/renstrapage/{{$id}}/intermediate-objective/{{ $intermediate->id_intermediate }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $intermediate->strategi_intermediate }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="tab-pane" id="summary-intermediate" role="tabpanel"
                        aria-labelledby="summary-intermediate-tab">
                        @foreach ($intermediate_query as $intermediate_2)
                            <a href="/renstrapage/{{$id}}/intermediate-objective/{{ $intermediate_2->id_intermediate }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $intermediate_2->strategi_intermediate }}</p>
                                    <div class="container px-0">
                                        <div class="progress_container">
                                            <div class="progress">
                                                <div class="progress_item">
                                                    <h3 class="progress_title pt-0">Progress Now</h3>
                                                    <div class="progress_bar">
                                                        <div class="bar"
                                                            data-value="{{ round($intermediate_2->avg_capaian) }}"
                                                            data-text="{{ round($intermediate_2->avg_capaian) }}"></div>
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
@else
    <div class="tab-pane p-4" id="intermediate" role="tabpanel" aria-labelledby="intermediate-tab"
        style="background:white; border-radius:20px;">
        <div class="px-3">
            <h5 style="font-weight:bold; font-size:24px;">Intermediate Objective</h5>
            <p style="font-weight:light; font-size:11px; margin:0%;">Intermediate Objective dari</p>
        </div>
        <div>
            @if (count($intermediate_query) == 0)
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
                    <button class="nav-link active btnNav mx-2" id="nav-overview-intermediate-tab" data-bs-toggle="tab"
                        data-bs-target="#overview-intermediate" type="button" role="tab"
                        aria-controls="nav-overview-intermediate" aria-selected="false">Overview</button>
                    <button class="nav-link btnNav mx-2" id="nav-summary-intermediate-tab" data-bs-toggle="tab"
                        data-bs-target="#summary-intermediate" type="button" role="tab"
                        aria-controls="nav-summary-intermediate" aria-selected="false">Summary</button>
                </nav>
                <div class="tab-content">
                    <div class="tab-pane active" id="overview-intermediate" role="tabpanel"
                        aria-labelledby="overview-intermediate-tab">
                        @foreach ($intermediate_query as $intermediate)
                            <a href="/renstrapage/{{$id}}/intermediate-objective/{{ $intermediate->id_intermediate }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $intermediate->strategi_intermediate }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="tab-pane" id="summary-intermediate" role="tabpanel"
                        aria-labelledby="summary-intermediate-tab">
                        @foreach ($intermediate_query as $intermediate_2)
                            <a href="/renstrapage/{{$id}}/intermediate-objective/{{ $intermediate_2->id_intermediate }}"
                                style="text-decoration: none; color:black;">
                                <div class="overview-list m-3 border px-3 py-1">
                                    <p class="m-0 py-3">{{ $intermediate_2->strategi_intermediate }}</p>
                                    <div class="container px-0">
                                        <div class="progress_container">
                                            <div class="progress">
                                                <div class="progress_item">
                                                    <h3 class="progress_title pt-0">Progress Now</h3>
                                                    <div class="progress_bar">
                                                        <div class="bar"
                                                            data-value="{{ round($intermediate_2->avg_capaian) }}"
                                                            data-text="{{ round($intermediate_2->avg_capaian) }}">
                                                        </div>
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
