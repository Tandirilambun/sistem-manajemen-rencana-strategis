<div class="tab-pane p-4" id="ultimate" role="tabpanel" aria-labelledby="ultimate-tab"
    style="background:white; border-radius:20px;">
    <div class="px-3">
        <h5 style="font-weight:bold; font-size:24px;">Ultimate Objective</h5>
        <p style="font-weight:light; font-size:11px; margin:0%;">Ultimate Objective dari </p>
    </div>
    <div>
        @if (count($ultimate_query) == 0)
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
                <button class="nav-link active btnNav mx-2" id="nav-overview-ultimate-tab" data-bs-toggle="tab"
                    data-bs-target="#overview-ultimate" type="button" role="tab"
                    aria-controls="nav-overview-ultimate" aria-selected="false">Overview</button>
                <button class="nav-link btnNav mx-2" id="nav-summary-ultimate-tab" data-bs-toggle="tab"
                    data-bs-target="#summary-ultimate" type="button" role="tab"
                    aria-controls="nav-summary-ultimate" aria-selected="false">Summary</button>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="overview-ultimate" role="tabpanel"
                    aria-labelledby="overview-ultimate-tab">
                    @foreach ($ultimate_query as $ultimate)
                        <a href="/renstrapage/{{$id}}/ultimate-objective/{{ $ultimate->id_ultimate }}"
                            style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $ultimate->strategi_ultimate }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="tab-pane" id="summary-ultimate" role="tabpanel" aria-labelledby="summary-ultimate-tab">
                    @foreach ($ultimate_query as $ultimate_2)
                        <a href="/renstrapage/{{$id}}/ultimate-objective/{{ $ultimate_2->id_ultimate }}"
                            style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $ultimate_2->strategi_ultimate }}</p>
                                <div class="container px-0">
                                    <div class="progress_container">
                                        <div class="progress">
                                            <div class="progress_item">
                                                <h3 class="progress_title pt-0">Progress Now</h3>
                                                <div class="progress_bar">
                                                    <div class="bar"
                                                        data-value="{{ round($ultimate_2->avg_capaian) }}"
                                                        data-text="{{ round($ultimate_2->avg_capaian) }}"></div>
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
