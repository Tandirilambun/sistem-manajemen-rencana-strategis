<?php

namespace App\Models;

use App\Models\Users;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = "activity_log";

    protected $primaryKey = 'id_activity';

    protected $guarded = 'id_activity';

    protected $fillable = [
        'locations_log',
        'details_log',
        'tipe_log',
        'after_change',
        'created_at',
        'id_user',
    ];

    public $timestamps = false;

    public function scopeFilter($query, array $filters){
        $query -> when($filters['tgl'] ?? false, function($query, $tanggal){
            return $query -> whereRaw('created_at :: DATE = ?',[$tanggal]);
        });
        $query -> when($filters['action'] ?? false, function($query, $action){
            return $query -> where('tipe_log','=', $action);
        });
    }

    public function users() {
        return $this -> belongsTo(Users::class,'id_user','id_user');
    }
}
