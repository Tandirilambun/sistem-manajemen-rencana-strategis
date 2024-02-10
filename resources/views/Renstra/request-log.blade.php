@inject('carbon', 'Carbon\Carbon')
@extends('main.index')
@section('index')
    <div class="container py-5">
        @if (count($request_history) == 0)
            <div>
                <div class="alerting d-flex justify-content-center align-items-center">
                    <div>
                        <img src="{{ asset('img/illustration/Shrug-rafiki.png') }}" alt="logo satunama"
                            style="width: 300px; heigth:300px;">
                    </div>
                </div>
                <div class="text-center" style="font-size: 20px; font-weight:bold;">
                    Opps! Request History Not Found
                </div>
            </div>
        @else
        <div class="accordion accordion-flush" id="accordionFlush-requestHistory">
            @foreach ($request_history as $item)
                <div class="accordion-item mb-3 border border-0" style="background: transparent;">
                    @if ($item->request_status == 'pending')
                        <h2 class="accordion-header">
                            <button class="accordion-button req-history collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-{{ $item->id_request }}" aria-expanded="false"
                                aria-controls="flush-collapse-{{ $item->id_request }}"  style="border-radius:2rem; ">
                                <i class="bi bi-clock me-3" style="font-size: 20px; color:#F29727"></i>
                                <div>
                                    <p>
                                        Your request item for {{ $item->request_type }} the {{ $item->req_loc }} is still
                                        {{ $item->request_status }}
                                    </p>
                                    <small>
                                        {{$carbon::parse($item -> created_at) -> format('l d F Y')}} at {{$carbon::parse($item -> created_at) -> format('H:i')}}
                                    </small>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse-{{ $item->id_request }}" class="accordion-collapse collapse mt-2 p-2"
                            data-bs-parent="#accordionFlush-requestHistory" style="background:white; border-radius:2rem;">
                            <div class="accordion-body">
                                <p> <code>Status - </code> {{Str::ucfirst($item -> request_status)}} </p>
                                <p> <code>Request Item - </code> {{$item -> request_item}} </p>
                                <p> <code>Message - </code> {{$item -> message}} </p>
                            </div>
                        </div>
                    @else
                        <h2 class="accordion-header">
                            <button class="accordion-button req-history  collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse-{{ $item->id_request }}" aria-expanded="false"
                                aria-controls="flush-collapse-{{ $item->id_request }}" style="border-radius: 2rem;">
                                @if($item->request_status == 'accepted')
                                <i class="bi bi-check-all me-3" style="font-size: 20px; color:#22A699"></i>
                                @elseif($item->request_status == 'rejected')
                                <i class="bi bi-exclamation-triangle me-3" style="font-size: 20px; color:#F24C3D"></i>
                                @endif
                                <div>
                                    <p>
                                        Your request item for {{ $item->request_type }} the {{ $item->req_loc }} has been
                                        {{ $item->request_status }}
                                    </p>
                                    <small>
                                        {{$carbon::parse($item -> created_at) -> format('l d F Y')}} at {{$carbon::parse($item -> created_at) -> format('H:i')}}
                                    </small>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse-{{ $item->id_request }}" class="accordion-collapse collapse mt-2 p-2"
                            data-bs-parent="#accordionFlush-requestHistory" style="background: white; border-radius:2rem;">
                            <div class="accordion-body">
                                <p> <code>Status - </code> {{Str::ucfirst($item -> request_status)}} </p>
                                <p> <code> {{Str::ucfirst($item -> request_status)}} by - </code> {{$item -> reviewer -> name}}</p>
                                <p> <code>Request Item - </code> {{$item -> request_item}} </p>
                                <p> <code>Message - </code> {{$item -> message}} </p>
                                @if($item->request_status == 'rejected')
                                    <p> <code>Reason rejected - </code> {{$item -> reason_reject}} </p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @endif
        {{ $request_history->links() }}
    </div>
@endsection