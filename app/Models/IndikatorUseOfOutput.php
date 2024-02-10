<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorUseOfOutput extends Model
{
    use HasFactory;
    protected $table = "indikator_use_of_output";
    
    protected $primaryKey = 'id_indikator_use_of_output';

    protected $fillable = [
        'id_use_of_output',
        'deskripsi_indikator_use_of_output'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(deskripsi_indikator_use_of_output) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function use_of_output(){
        return $this->belongsTo(UseOfOutput::class, 'id_use_of_output', 'id_use_of_output');
    }

    public function capaian_use_of_output(){
        return $this->hasMany(CapaianIndikatorUseOfOutput::class,'id_indikator_use_of_output');
    }
}
