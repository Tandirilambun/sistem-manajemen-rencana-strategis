@extends('main.index')
@section('index')
    <div class="container">
        @if ($periode->flag_column_keterangan == 4)
            <div class="rounded-4 p-3 mb-2" style="background-color: white;">
                <p style="font-size: 17px; font-weight:bold; text-align:center;"> Periode </p>
                <p style="font-size: 25px; font-weight:bold; text-align:center;">
                    {{ $periode->roadmap }} <br> {{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }}
                </p>
            </div>
            <div class="rounded-4 p-3 mb-2" style="background-color: white;">
                <p style="font-size: 17px; font-weight:bold; text-align:center;"> Goal </p>
                <p style="font-size: 25px; font-weight:bold; text-align:center;">
                    @foreach ($query_intermediate->intermediate_objective as $intermediate)
                        {{ $intermediate->strategi_intermediate }}
                    @endforeach
                </p>
            </div>
            <div class="container search-bar mb-4 py-4" id="container-search"
                style="background-color: white; border-radius:10px;">
                <div id="search-bar" class="mx-5" style="width:100%; height:100%;">
                    <form class="form-search d-flex" action="/mpp_data_page/{{ $periode->id_periode }}" id="search-form">
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
            <div class="rounded-4 p-3" style="background-color: white;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Strategi</th>
                            <th scope="col">Indikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-info">
                            <td colspan="2"> Outcome</td>
                        </tr>
                        @foreach ($query_outcome as $index => $outcome)
                            <tr>
                                @if ($index === 0 || $outcome->strategi_outcome !== $query_outcome[$index - 1]->strategi_outcome)
                                    <td
                                        rowspan="{{ $query_outcome->where('strategi_outcome', $outcome->strategi_outcome)->count() }}">
                                        {{ $outcome->strategi_outcome }}
                                    </td>
                                @endif
                                <td>
                                    {{ $outcome->deskripsi_indikator_outcome }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Output</td>
                        </tr>
                        @foreach ($query_output as $index => $output)
                            <tr>
                                @if ($index === 0 || $output->strategi_output !== $query_output[$index - 1]->strategi_output)
                                    <td
                                        rowspan="{{ $query_output->where('strategi_output', $output->strategi_output)->count() }}">
                                        {{ $output->strategi_output }}
                                    </td>
                                @endif
                                <td>
                                    {{ $output->deskripsi_indikator_output }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif($periode->flag_column_keterangan == 8)
            <div class="rounded-4 p-3 mb-2" style="background-color: white;">
                <p style="font-size: 17px; font-weight:bold; text-align:center;"> Periode </p>
                <p style="font-size: 25px; font-weight:bold; text-align:center;">
                    {{ $periode->roadmap }} <br> {{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }}
                </p>
            </div>
            <div class="rounded-4 p-3" style="background-color: white;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Strategi</th>
                            <th scope="col">Indikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-info">
                            <td colspan="2"> General Objective </td>
                        </tr>
                        @foreach ($query_general as $index => $general)
                            <tr>
                                @if ($index === 0 || $general->strategi_general !== $query_general[$index - 1]->strategi_general)
                                    <td
                                        rowspan="{{ $query_general->where('strategi_general', $general->strategi_general)->count() }}">
                                        {{ $general->strategi_general }}
                                    </td>
                                @endif
                                <td>
                                    {{ $general->deskripsi_indikator_general }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Ultimate Objective </td>
                        </tr>
                        @foreach ($query_ultimate as $index => $ultimate)
                            <tr>
                                @if ($index === 0 || $ultimate->strategi_ultimate !== $query_ultimate[$index - 1]->strategi_ultimate)
                                    <td
                                        rowspan="{{ $query_ultimate->where('strategi_ultimate', $ultimate->strategi_ultimate)->count() }}">
                                        {{ $ultimate->strategi_ultimate }}
                                    </td>
                                @endif
                                <td>
                                    {{ $ultimate->deskripsi_indikator_ultimate }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Intermediate Objective </td>
                        </tr>
                        @foreach ($query_intermediate as $index => $intermediate)
                            <tr>
                                @if ($index === 0 || $intermediate->strategi_intermediate !== $query_intermediate[$index - 1]->strategi_intermediate)
                                    <td
                                        rowspan="{{ $query_intermediate->where('strategi_intermediate', $intermediate->strategi_intermediate)->count() }}">
                                        {{ $intermediate->strategi_intermediate }}
                                    </td>
                                @endif
                                <td>
                                    {{ $intermediate->deskripsi_indikator_intermediate }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Outcome</td>
                        </tr>
                        @foreach ($query_outcome as $index => $outcome)
                            <tr>
                                @if ($index === 0 || $outcome->strategi_outcome !== $query_outcome[$index - 1]->strategi_outcome)
                                    <td
                                        rowspan="{{ $query_outcome->where('strategi_outcome', $outcome->strategi_outcome)->count() }}">
                                        {{ $outcome->strategi_outcome }}
                                    </td>
                                @endif
                                <td>
                                    {{ $outcome->deskripsi_indikator_outcome }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Use of Output </td>
                        </tr>
                        @foreach ($query_use_of_output as $index => $use_of_output)
                            <tr>
                                @if ($index === 0 || $use_of_output->strategi_use_of_output !== $query_use_of_output[$index - 1]->strategi_use_of_output)
                                    <td
                                        rowspan="{{ $query_use_of_output->where('strategi_use_of_output', $use_of_output->strategi_use_of_output)->count() }}">
                                        {{ $use_of_output->strategi_use_of_output }}
                                    </td>
                                @endif
                                <td>
                                    {{ $use_of_output->deskripsi_indikator_use_of_output }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2"> Output</td>
                        </tr>
                        @foreach ($query_output as $index => $output)
                            <tr>
                                @if ($index === 0 || $output->strategi_output !== $query_output[$index - 1]->strategi_output)
                                    <td
                                        rowspan="{{ $query_output->where('strategi_output', $output->strategi_output)->count() }}">
                                        {{ $output->strategi_output }}
                                    </td>
                                @endif
                                <td>
                                    {{ $output->deskripsi_indikator_output }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
