<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorUltimate extends Model
{
    use HasFactory;
    protected $table = "capaian_ultimate";

    protected $primaryKey = 'id_capaian_ultimate';

    protected $fillable = [
        'id_indikator_ultimate',
        'tahun_ultimate',
        'keterangan_hasil_ultimate',
        'capaian_ultimate'
    ];

    public $timestamps = false;

    public function indikator_ultimate(){
        return $this->belongsTo(IndikatorUltimate::class, 'id_indikator_ultimate','id_indikator_ultimate');
    }
}
