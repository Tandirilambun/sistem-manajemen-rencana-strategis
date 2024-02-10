@inject('carbon', 'Carbon\Carbon')
@extends('main.index')
@section('index')
    <div class="container py-5 " id="data_container">
        <div class="mb-3">
            <div>
                <form action="/activity-log" method="get" class="d-flex justify-content-end">
                    <div class="filter-dis mx-2 my-2">
                        <label for="date-picker-filter">Filter By Date</label>
                        <div class="input-filter">
                            <input type="date" class="rounded-0 btn btn-light mx-2" name="tgl" id="date-picker-filter"
                                value="{{ isset($old_value) ? $old_value : old('old_value') }}">
                        </div>
                    </div>
                    <div class="filter-dis mx-2 my-2">
                        <label for="filter-action">Filter By Action</label>
                        <div class="input-filter">
                            <select name="action" id="filter-action"
                                class="rounded-0 form-select border border-0 btn btn-light mx-2" style="width: 7rem;">
                                <option selected value="">All</option>
                                @foreach ($jenis_activity as $action)
                                    <option value="{{ $action }}"> {{ Str::ucfirst($action) }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="filter-dis mx-2 my-2">
                        <button type="submit" class="rounded-circle btn btn-light border border-1"><i
                                class="bi bi-search-heart m-0"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @if (count($activity_log) == 0)
            <div>
                <div class="alerting d-flex justify-content-center align-items-center">
                    <div>
                        <img src="{{ asset('img/illustration/Shrug-rafiki.png') }}" alt="logo satunama"
                            style="width: 300px; heigth:300px;">
                    </div>
                </div>
                <div class="text-center" style="font-size: 20px; font-weight:bold;">
                    Opps! Activity Log Data Not Found
                </div>
            </div>
        @else            
            <div class="accordion accordion-flush" id="accordionFlush">
                @foreach ($activity_log as $log)
                    <div class="accordion-item mb-3 border">
                        @if ($log->tipe_log === 'insert')
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-{{ $log->id_activity }}" aria-expanded="false"
                                    aria-controls="flush-{{ $log->id_activity }}">
                                    <i class="fa-solid fa-file-circle-plus me-3" style="font-size: 15px; color:#22A699"></i>
                                    <div>
                                        <p class="mb-1"> {{ $log->users->name }} insert data into
                                            <strong>{{ $log->locations_log }}</strong>
                                        </p>
                                        <small class="me-5" style="text-align: end">
                                            <i class="bi bi-clock-history me-1" style="font-size: 11px;"></i> 
                                            {{$carbon::parse($log -> created_at) -> format('l d F Y') }} at {{$carbon::parse($log -> created_at) -> format('H:i') }}
                                        </small>
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-{{ $log->id_activity }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlush">
                                <div class="accordion-body px-5">
                                    <p><code> 01 - </code>For : {{ $log->locations_log }}</p>
                                    <p><code> 02 - </code>Inserted : {{ $log->details_log }} </p>
                                    <p><code> 03 - Data inserted Successfull</code></p>
                                </div>
                            </div>
                        @elseif($log->tipe_log === 'update')
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-{{ $log->id_activity }}" aria-expanded="false"
                                    aria-controls="flush-{{ $log->id_activity }}">
                                    <i class="fa-solid fa-file-pen me-3" style="font-size: 15px; color:#F29727"></i>
                                    <div>
                                        <p class="mb-1">{{ $log->users->name }} made changes data for
                                            <strong>{{ $log->locations_log }}</strong>
                                        </p>
                                        <small class="me-5" style="text-align: end">
                                            <i class="bi bi-clock-history me-1" style="font-size: 11px;"></i>
                                            {{$carbon::parse($log -> created_at) -> format('l d F Y') }} at {{$carbon::parse($log -> created_at) -> format('H:i') }}
                                        </small>
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-{{ $log->id_activity }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlush">
                                <div class="accordion-body px-5">
                                    <p><code> 01 - </code>For : {{ $log->details_log }}</p>
                                    <p><code> 02 - </code>Become : {{ $log->after_change }} </p>
                                    <p><code> 03 - Data update Successfull</code></p>
                                </div>
                            </div>
                        @elseif($log->tipe_log === 'delete')
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-{{ $log->id_activity }}" aria-expanded="false"
                                    aria-controls="flush-{{ $log->id_activity }}">
                                    <i class="fa-solid fa-trash-can me-3" style="font-size: 15px; color:#F24C3D"></i>
                                    <div>
                                        <p class="mb-1">{{ $log->users->name }} removed Data from
                                            <strong> {{ $log->locations_log }}</strong>
                                        </p>
                                        <small class="me-5" style="text-align: end">
                                            <i class="bi bi-clock-history me-1" style="font-size: 11px;"></i>
                                            {{$carbon::parse($log -> created_at) -> format('l d F Y') }} at {{$carbon::parse($log -> created_at) -> format('H:i') }}
                                        </small>
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-{{ $log->id_activity }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlush">
                                <div class="accordion-body px-5">
                                    <p><code> 01 - </code>For : {{ $log->details_log }}</p>
                                    <p><code> 02 - Data deleted successfull</code></p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            {{ $activity_log -> appends(request()->query()) -> links() }}
        @endif
    </div>
@endsection
