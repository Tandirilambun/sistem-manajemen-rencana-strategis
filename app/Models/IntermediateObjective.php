<?php

namespace App\Models;

use App\Models\Outcome;
use App\Models\Periode;
use Illuminate\Support\Str;
use App\Models\UltimateObjective;
use App\Models\IndikatorIntermediate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntermediateObjective extends Model
{
    use HasFactory;

    protected $table = "intermediate_objective";
    
    protected $primaryKey = 'id_intermediate';

    protected $fillable = [
        'id_ultimate',
        'id_periode',
        'strategi_intermediate',
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(strategi_intermediate) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function periode(){
        return $this -> belongsTo(Periode::class,'id_periode','id_periode');
    }

    public function ultimate_objective(){
        return $this -> belongsTo(UltimateObjective::class,'id_ultimate');
    }

    public function outcome(){
        return $this -> hasMany(Outcome::class,'id_intermediate');
    }

    public function indikator_intermediate(){
        return $this -> hasMany(IndikatorIntermediate::class,'id_intermediate');
    }
}
