@php
    $getMonth = now() -> month - 1;
    if($getMonth == 0){
        $getMonth = 12;
    }
    $recap_activity = App\Models\ActivityLog::with('users')
        ->whereMonth('created_at', $getMonth)
        ->orderBy('created_at', 'asc')
        ->get();
@endphp
@inject('carbon', 'Carbon\Carbon')

<h3> Halo {{ $email_name }}</h3>

<p>Bulan {{$getMonth}} Telah Berakhir berikut adalah hasil Rekapitulasi dari setiap Activity Log yang telah direkap oleh sistem
    selama 1 bulan terakhir</p>

<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi Perubahan</th>
            <th scope="col">Detail</th>
            <th scope="col">Tipe Perubahan</th>
            <th scope="col">Perubahan</th>
            <th scope="col">Waktu</th>
        </tr>
    </thead>
    <tbody>
        @if(count($recap_activity) == 0)
            <tr> 
                <td style="text-align: center;" colspan="6"> Tidak ada Aktifitas yang dilakukan </td>
            </tr>
        @else
            @foreach ($recap_activity as $item)
                <tr class="isi-table">
                    <td style="font-size: 11px">{{ $item->users->name }}</td>
                    <td style="text-align: center; font-size: 11px">{{ $item->locations_log }}</td>
                    <td style="font-size: 11px">{{ $item->details_log }}</td>
                    <td style="text-align: center; font-size: 11px">
                        @if($item-> tipe_log == 'insert')
                        Tambah
                        @elseif($item-> tipe_log == 'delete')
                        Hapus
                        @elseif($item-> tipe_log == 'update')
                        Ubah/Edit
                        @endif
                    </td>
                    <td style="font-size: 11px">{{ $item->after_change }}</td>
                    <td style="font-size: 11px">{{ $carbon::parse($item->created_at)->format('d F Y') }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<p>Sekian Terima Kasih</p>
<br>
<br>
<p>Sistem Manajemen Rencana Strategis Yayasan SATUNAMA Yogyakarta</p>
