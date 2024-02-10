<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorIntermediate extends Model
{
    use HasFactory;
    protected $table = "capaian_intermediate";

    protected $primaryKey = 'id_capaian_intermediate';

    protected $fillable = [
        'id_indikator_intermediate',
        'tahun_intermediate',
        'keterangan_hasil_intermediate',
        'capaian_intermediate'
    ];

    public $timestamps = false;

    public function indikator_intermediate(){
        return $this->belongsTo(IndikatorIntermediate::class, 'id_indikator_intermediate','id_indikator_intermediate');
    }
}
