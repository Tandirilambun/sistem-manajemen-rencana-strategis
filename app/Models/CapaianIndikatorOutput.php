<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianIndikatorOutput extends Model
{
    use HasFactory;
    protected $table = "capaian_output";
    
    protected $primaryKey = 'id_capaian_output';

    protected $fillable = [
        'id_indikator_output',
        'tahun_output',
        'keterangan_hasil_output',
        'capaian_output'
    ];

    public $timestamps = false;

    public function indikator_output(){
        return $this->belongsTo(IndikatorOutput::class, 'id_indikator_output','id_indikator_output');
    }
}
