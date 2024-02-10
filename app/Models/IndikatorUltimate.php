<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorUltimate extends Model
{
    use HasFactory;
    protected $table = "indikator_ultimate";
    
    protected $primaryKey = 'id_indikator_ultimate';

    protected $fillable = [
        'id_ultimate',
        'deskripsi_indikator_ultimate'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(deskripsi_indikator_ultimate) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function ultimate_objective(){
        return $this->belongsTo(UltimateObjective::class, 'id_ultimate', 'id_ultimate');
    }

    public function capaian_ultimate(){
        return $this->hasMany(CapaianIndikatorUltimate::class,'id_indikator_ultimate');
    }
}
