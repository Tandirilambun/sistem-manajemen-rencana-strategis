<?php

namespace App\Models;

use App\Models\Output;
use App\Models\Outcome;
use App\Models\Periode;
use App\Models\IndikatorUseOfOutput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UseOfOutput extends Model
{
    use HasFactory;
    protected $table = "use_of_output";
    
    protected $primaryKey = 'id_use_of_output';

    protected $fillable = [
        'id_outcome',
        'id_periode',
        'strategi_use_of_output',
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(strategi_use_of_output) LIKE ('%' || ? || '%')",[strtolower($item_search)]);
        });
    }

    public function periode(){
        return $this -> belongsTo(Periode::class,'id_periode','id_periode');
    }

    public function outcome(){
        return $this -> belongsTo(Outcome::class,'id_use_of_output');
    }

    public function output(){
        return $this -> hasMany(Output::class,'id_use_of_output');
    }

    public function indikator_use_of_output(){
        return $this -> hasMany(IndikatorUseOfOutput::class,'id_use_of_output');
    }
}
