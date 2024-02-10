<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorOutput extends Model
{
    use HasFactory;
    protected $table = "indikator_output";
    
    protected $primaryKey = 'id_indikator_output';

    protected $fillable = [
        'id_output',
        'deskripsi_indikator_output'
    ];

    public $timestamps = false;

    public function scopeSearch($query, $search) {
        $query -> when($search ?? false, function($query, $item_search){
            return $query -> whereRaw("lower(deskripsi_indikator_output) LIKE ('%' || ? || '%')",[Str::lower($item_search)]);
        });
    }

    public function output(){
        return $this->belongsTo(Output::class, 'id_output', 'id_output');
    }

    public function capaian_output(){
        return $this->hasMany(CapaianIndikatorOutput::class,'id_indikator_output');
    }
}
