<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    use HasFactory;
    protected $table = "request_form";
    protected $primaryKey = 'id_request';
    protected $fillable = [
        'id_user',
        'request_type',
        'request_item',
        'message',
        'request_status',
        'created_at',
        'req_loc',
        'id_reviewer'
    ];
    public $timestamps = false;

    public function users(){
        return $this->belongsTo(Users::class, 'id_user','id_user');
    }

    public function reviewer(){
        return $this->belongsTo(Users::class, 'id_reviewer','id_user');
    }
}
