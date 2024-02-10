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
                    <p class="mb-2" style="font-size: 17px; font-weight:bold;"> Ultimate
                        Objective
                    </p>
                    <form action="/create/ultimate-objective" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="select-periode-2">Periode</label>
                            <select id="select-periode-2" class="form-select mb-3" aria-label=".form-select-lg example"
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
                            <label for="select-general-2">General Objective</label>
                            <select id="select-general-2" class="form-select mb-3" aria-label=".form-select-lg example"
                                style="max-width:auto; width:auto;" name="selectGeneral" required>
                                <option selected value="">Select General Objective...
                                </option>
                                @foreach ($generals as $general)
                                    <option value={{ $general->id_general }}>
                                        {{ $general->strategi_general }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="fieldUltimate">
                            <div class="d-flex mb-2" style="gap: 5%">
                                <label class="col-8" for="input_ultimate">Ultimate Objective</label>
                                <a class="btn col-1" id="addField" style="background:#008800; color:white;">Add Field</a>
                            </div>
                            <textarea class="form-control mb-2" id="input_ultimate" aria-label="With textarea" style="width: 80%;"
                                name="input_ultimate[]" placeholder="Masukkan Strategi..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-center align-items-center" style="gap: 1%;">
                            <a href="{{ route('step-3') }}" class="btn btnAdd" style="background:#008800; color:white;">
                                Back to Periode </a>
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
            $('#select-periode-2').change(function() {
                var periodeId = $(this).val();
                $.ajax({
                    url: '/get-general-objective/' + periodeId,
                    type: 'GET',
                    success: function(data) {
                        $('#select-general-2').empty();
                        $.each(data, function(key, value) {
                            $('#select-general-2').append('<option value="' + key +
                                '">' + value + '</option>');
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#addField').click(function(event) {
                event.preventDefault();
                $('#fieldUltimate').append(
                    '<div class="d-flex mb-2 "> <textarea class="form-control " id="input_ultimate" aria-label="With textarea" style="width: 80%;" name="input_ultimate[]" placeholder="Masukkan Strategi..." required></textarea> <button class="btn ms-2 removeField" style="background:red; color:white;"> Remove </button> </div>'
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
