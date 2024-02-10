<?php

namespace App\Models;

use App\Models\Output;
use App\Models\Outcome;
use App\Models\UseOfOutput;
use App\Models\GeneralObjective;
use App\Models\UltimateObjective;
use App\Models\IntermediateObjective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;
    protected $table = "periode";
    
    protected $primaryKey = 'id_periode';

    protected $fillable = [
        'roadmap',
        'tahun_awal',
        'tahun_akhir',
        'flag_column_keterangan',
    ];
    public $timestamps = false;

    public function general_objective(){
        return $this->hasMany(GeneralObjective::class, 'id_periode');
    }
    public function ultimate_objective(){
        return $this->hasMany(UltimateObjective::class, 'id_periode');
    }
    public function intermediate_objective(){
        return $this->hasMany(IntermediateObjective::class, 'id_periode');
    }
    public function outcome(){
        return $this->hasMany(Outcome::class, 'id_periode');
    }
    public function use_of_output(){
        return $this->hasMany(UseOfOutput::class, 'id_periode');
    }
    public function output(){
        return $this->hasMany(Output::class, 'id_periode');
    }
}
