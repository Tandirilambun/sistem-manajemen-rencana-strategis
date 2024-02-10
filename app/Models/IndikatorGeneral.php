<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorGeneral extends Model
{
    use HasFactory;

    protected $table = "indikator_general";
    
    protected $primaryKey = 'id_indikator_general';

    protected $fillable = [
        'id_general',
        'deskripsi_indikator_general'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query ->  whereRaw("lower(deskripsi_indikator_general) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function general_objective(){
        return $this->belongsTo(GeneralObjective::class, 'id_general', 'id_general');
    }

    public function capaian_general(){
        return $this->hasMany(CapaianIndikatorGeneral::class,'id_indikator_general');
    }
}
