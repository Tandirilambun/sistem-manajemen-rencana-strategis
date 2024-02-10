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
                    <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Indikator for
                        Ultimate Objective
                    </p>
                    <div class="mb-3">
                        <label for="select-periode-8">Periode</label>
                        <select id="select-periode-8" class="form-select mb-3" aria-label=".form-select-lg example"
                            style="max-width:auto; width:auto;" name="selectPeriode" required>
                            <option selected value="">Select Periode...</option>
                            @foreach ($periodes as $periode)
                                <option value={{ $periode->id_periode }}>{{ $periode->roadmap }}
                                    ({{ $periode->tahun_awal }} - {{ $periode->tahun_akhir }})
                                    <br>
                                    *{{ $periode->flag_column_keterangan }} tingkat
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <form action="/create/indikator-ultimate-objective" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="select-ultimate-1">Ultimate Objective</label>
                            <select id="select-ultimate-1" class="form-select mb-3" aria-label=".form-select-lg example"
                                style="max-width:auto; width:auto;" name="selectUltimate" required>
                                <option selected value="">Select Ultimate Objective...
                                </option>
                                @foreach ($ultimates as $ultimate)
                                    <option value={{ $ultimate->id_ultimate }}>
                                        {{ $ultimate->strategi_ultimate }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="fieldIndUltimate">
                            <div class="d-flex mb-2" style="gap: 5%">
                                <label for="input_indikator_ultimate">Indikator</label>
                                <a class="btn" id="addField" style="background:#008800; color:white;">Add Field</a>
                            </div>
                            <textarea id="input_indikator_ultimate" class="form-control mb-2" aria-label="With textarea" style="width: 80%;"
                                name="input_indikator_ultimate[]" placeholder="Masukkan Indikator..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="gap: 1%;">
                            <a href="{{route('step-4')}}" class="btn"style="background:#008800; color:white;">Back</a>
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
            $('#select-periode-8').change(function() {
                var periodeId = $(this).val();
                $.ajax({
                    url: '/get-ultimate-objective/' + periodeId,
                    type: 'GET',
                    success: function(data) {
                        $('#select-ultimate-1').empty();
                        $.each(data, function(key, value) {
                            $('#select-ultimate-1').append('<option value="' + key +
                                '">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#addField').click(function(event) {
                event.preventDefault();
                $('#fieldIndUltimate').append(
                    '<div class="d-flex mb-2"> <textarea id="input_indikator_ultimate" class="form-control" aria-label="With textarea" style="width: 80%;" name="input_indikator_ultimate[]" placeholder="Masukkan Indikator..." required></textarea> <button class="btn ms-2 removeField" style="background:red; color:white;"> Remove </button> </div>'
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
