<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorGeneral extends Model
{
    use HasFactory;
    protected $table = "capaian_general";

    protected $primaryKey = 'id_capaian_general';

    protected $fillable = [
        'id_indikator_general',
        'tahun_general',
        'keterangan_hasil_general',
        'capaian_general'
    ];

    public $timestamps = false;

    public function indikator_general(){
        return $this->belongsTo(IndikatorGeneral::class, 'id_indikator_general','id_indikator_general');
    }
}
