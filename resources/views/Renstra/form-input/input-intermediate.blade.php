@extends('main.index')
@section('index')
    <div class="container py-5">
        <div class=" mb-3 py-4 d-flex justify-content-center" style="background: white">
            <div style="flex:1;">
                @include('Component.step')
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div style="flex: 1;">
                <div class="p-3" style="background: white;">
                    <p class="mb-2" style="font-size: 17px; font-weight:bold;">Intermediate
                        Objective </p>
                    <form action="/create/intermediate-objective" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="select-periode-3">Periode</label>
                            <select id="select-periode-3" class="form-select mb-3" aria-label=".form-select-lg example"
                                style="max-width:auto; width:auto;" name="selectPeriode" required>
                                <option selected value="">Select Periode...</option>
                                @foreach ($periodes as $periode)
                                    <option value={{ $periode->id_periode }}>
                                        {{ $periode->roadmap }}
                                        ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                        <br>
                                        *{{ $periode->flag_column_keterangan }} tingkat
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="select-ultimate-2">Ultimate Objective</label>
                            <select id="select-ultimate-2" class="form-select mb-3" aria-label=".form-select-lg example"
                                style="max-width:auto; width:auto;" name="selectUltimate">
                                <option selected value="">Select Ultimate Objective...
                                </option>
                                @foreach ($ultimates as $ultimate)
                                    <option value={{ $ultimate->id_ultimate }}>
                                        {{ $ultimate->strategi_ultimate }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="fieldIntermediate">
                            <div class="d-flex mb-2" style="gap: 5%">
                                <label class="col-8" for="input_intermediate">Intermediate Objective</label>
                                <a class="btn col-1" id="addField" style="background:#008800; color:white;">Add Field</a>
                            </div>
                            <textarea required class="form-control mb-2" id="input_intermediate" aria-label="With textarea" style="width: 80%;"
                                name="input_intermediate[]" placeholder="Masukkan Strategi..."></textarea>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="gap: 1%;">
                            <a href="{{route('step-5')}}" class="btn btnAdd"
                                style="background:#008800; color:white;">
                                Back </a>
                            <button type="submit" class="btn btnAdd" style="background:#008800; color:white;">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#select-periode-3').change(function() {
                var periodeId = $(this).val();
                $.ajax({
                    url: '/get-ultimate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data) {
                        $('#select-ultimate-2').empty();
                        $.each(data, function(key, value) {
                            $('#select-ultimate-2').append('<option value="' + key +
                                '">' + value + '</option>');
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#addField').click(function(event) {
                event.preventDefault();
                $('#fieldIntermediate').append(
                    '<div class="d-flex mb-2"> <textarea required class="form-control" id="input_intermediate" aria-label="With textarea" style="width: 80%;" name="input_intermediate[]" placeholder="Masukkan Strategi..."></textarea><button class="btn ms-2 removeField" style="background:red; color:white;"> Remove </button></div>'
                )
            });
        });

        $(document).on('click', '.removeField', function(e) {
            e.preventDefault();
            let row_item = $(this).parent();
            $(row_item).remove();
        });
    </script>
@endsection
