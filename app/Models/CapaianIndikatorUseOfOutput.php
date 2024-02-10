<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorUseOfOutput extends Model
{
    use HasFactory;
    protected $table = "capaian_use_of_output";
    
    protected $primaryKey = 'id_capaian_use_of_output';

    protected $fillable = [
        'id_indikator_use_of_output',
        'tahun_use_of_output',
        'keterangan_hasil_use_of_output',
        'capaian_use_of_output'
    ];

    public $timestamps = false;

    public function indikator_use_of_output(){
        return $this->belongsTo(IndikatorUseOfOutput::class, 'id_indikator_use_of_output','id_indikator_use_of_output');
    }
}
