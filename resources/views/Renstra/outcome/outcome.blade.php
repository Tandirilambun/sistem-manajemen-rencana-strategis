<div class="tab-pane p-4" id="outcomes" role="tabpanel" aria-labelledby="outcomes-tab"
    style="background:white; border-radius:20px;">
    <div class="px-3">
        <h5 style="font-weight:bold; font-size:24px;">Outcomes</h5>
        <p style="font-weight:light; font-size:11px; margin:0%;">Outcomes dari </p>
    </div>
    <div>
        @if (count($outcome_query) == 0)
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
                <button class="nav-link active btnNav mx-2" id="nav-overview-outcome-tab" data-bs-toggle="tab"
                    data-bs-target="#overview-outcome" type="button" role="tab"
                    aria-controls="nav-overview-outcome" aria-selected="false">Overview</button>
                <button class="nav-link btnNav mx-2" id="nav-summary-outcome-tab" data-bs-toggle="tab"
                    data-bs-target="#summary-outcome" type="button" role="tab" aria-controls="nav-summary-outcome"
                    aria-selected="false">Summary</button>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="overview-outcome" role="tabpanel"
                    aria-labelledby="overview-outcome-tab">
                    @foreach ($outcome_query as $outcome)
                        <a href="/renstrapage/{{$id}}/outcome/{{ $outcome->id_outcome }}" style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $outcome->strategi_outcome }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="tab-pane" id="summary-outcome" role="tabpanel" aria-labelledby="summary-outcome-tab">
                    @foreach ($outcome_query as $outcome_2)
                        <a href="/renstrapage/{{$id}}/outcome/{{ $outcome_2->id_outcome }}" style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $outcome_2->strategi_outcome }}</p>
                                <div class="container px-0">
                                    <div class="progress_container">
                                        <div class="progress">
                                            <div class="progress_item">
                                                <h3 class="progress_title pt-0">Progress Now</h3>
                                                <div class="progress_bar">
                                                    <div class="bar"
                                                        data-value="{{ round($outcome_2->avg_capaian) }}"
                                                        data-text="{{ round($outcome_2->avg_capaian) }}"></div>
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
