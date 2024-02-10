<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorOutcome extends Model
{
    use HasFactory;
    protected $table = "indikator_outcome";
    
    protected $primaryKey = 'id_indikator_outcome';

    protected $fillable = [
        'id_outcome',
        'deskripsi_indikator_outcome'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(deskripsi_indikator_outcome) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function outcome(){
        return $this->belongsTo(Outcome::class, 'id_outcome', 'id_outcome');
    }

    public function capaian_outcome(){
        return $this->hasMany(CapaianIndikatorOutcome::class,'id_indikator_outcome');
    }
}
