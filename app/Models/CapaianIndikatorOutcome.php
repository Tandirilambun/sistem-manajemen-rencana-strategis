<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorOutcome extends Model
{
    use HasFactory;
    protected $table = "capaian_outcome";
    
    protected $primaryKey = 'id_capaian_outcome';

    protected $fillable = [
        'id_indikator_outcome',
        'tahun_outcome',
        'keterangan_hasil_outcome',
        'capaian_outcome'
    ];

    public $timestamps = false;

    public function indikator_outcome(){
        return $this->belongsTo(IndikatorOutcome::class, 'id_indikator_outcome','id_indikator_outcome');
    }
}
