<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorIntermediate extends Model
{
    use HasFactory;
    protected $table = "indikator_intermediate";
    
    protected $primaryKey = 'id_indikator_intermediate';

    protected $fillable = [
        'id_intermediate',
        'deskripsi_indikator_intermediate'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(deskripsi_indikator_intermediate) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function intermediate_objective(){
        return $this->belongsTo(IntermediateObjective::class, 'id_intermediate', 'id_intermediate');
    }

    public function capaian_intermediate(){
        return $this->hasMany(CapaianIndikatorIntermediate::class,'id_indikator_intermediate');
    }
}
