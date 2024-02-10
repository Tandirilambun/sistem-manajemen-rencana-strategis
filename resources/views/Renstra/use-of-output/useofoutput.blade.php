<div class="tab-pane p-4" id="useofoutput" role="tabpanel" aria-labelledby="useofoutput-tab"
    style="background:white; border-radius:20px;">
    <div class="px-3">
        <h5 style="font-weight:bold; font-size:24px;">Use of Output</h5>
        <p style="font-weight:light; font-size:11px; margin:0%;">Use of Output dari </p>
    </div>
    <div>
        @if (count($use_of_output_query) == 0)
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
                <button class="nav-link active btnNav mx-2" id="nav-overview-use-of-output-tab" data-bs-toggle="tab"
                    data-bs-target="#overview-use-of-output" type="button" role="tab"
                    aria-controls="nav-overview-use-of-output" aria-selected="false">Overview</button>
                <button class="nav-link btnNav mx-2" id="nav-summary-use-of-output-tab" data-bs-toggle="tab"
                    data-bs-target="#summary-use-of-output" type="button" role="tab"
                    aria-controls="nav-summary-use-of-output" aria-selected="false">Summary</button>
            </nav>
            <div class="tab-content">
                <div class="tab-pane active" id="overview-use-of-output" role="tabpanel"
                    aria-labelledby="overview-use-of-output-tab">
                    @foreach ($use_of_output_query as $use_of_output)
                        <a href="/renstrapage/{{$id}}/use-of-output/{{ $use_of_output->id_use_of_output }}"
                            style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $use_of_output->strategi_use_of_output }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="tab-pane" id="summary-use-of-output" role="tabpanel"
                    aria-labelledby="summary-use-of-output-tab">
                    @foreach ($use_of_output_query as $use_of_output_2)
                        <a href="/renstrapage/{{$id}}/use-of-output/{{ $use_of_output_2->id_use_of_output }}"
                            style="text-decoration: none; color:black;">
                            <div class="overview-list m-3 border px-3 py-1">
                                <p class="m-0 py-3">{{ $use_of_output_2->strategi_use_of_output }}</p>
                                <div class="container px-0">
                                    <div class="progress_container">
                                        <div class="progress">
                                            <div class="progress_item">
                                                <h3 class="progress_title pt-0">Progress Now</h3>
                                                <div class="progress_bar">
                                                    <div class="bar"
                                                        data-value="{{ round($use_of_output_2->avg_capaian) }}"
                                                        data-text="{{ round($use_of_output_2->avg_capaian) }}"></div>
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
