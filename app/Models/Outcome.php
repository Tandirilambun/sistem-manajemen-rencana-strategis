<?php

namespace App\Models;

use App\Models\Periode;
use App\Models\UseOfOutput;
use App\Models\IndikatorOutcome;
use App\Models\IntermediateObjective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outcome extends Model
{
    use HasFactory;
    protected $table = "outcome";
    
    protected $primaryKey = 'id_outcome';

    protected $fillable = [
        'id_intermediate',
        'id_periode',
        'strategi_outcome'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(strategi_outcome) LIKE ('%' || ? || '%')",[strtolower($item_search)]);
        });
    }

    public function periode(){
        return $this -> belongsTo(Periode::class,'id_periode','id_periode');
    }

    public function intermediate_objective() {
        return $this -> belongsTo(IntermediateObjective::class,'id_intermediate');
    }

    public function use_of_output(){
        return $this -> hasMany(UseOfOutput::class,'id_outcome');
    }

    public function output(){
        return $this -> hasMany(Output::class,'id_outcome');
    }

    public function indikator_outcome(){
        return $this -> hasMany(IndikatorOutcome::class,'id_outcome');
    }
}
