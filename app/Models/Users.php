<?php

namespace App\Models;

use App\Models\RequestForm;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "users";
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $guarded = ['id_user'];

    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    public $timestamps = false;

    public function activity_log(){
        return $this -> hasMany(ActivityLog::class , 'id_activity','id_activity');
    }

    public function request_form(){
        return $this->hasMany(RequestForm::class , 'id_user');
    }

    public function review_request(){
        return $this->hasMany(RequestForm::class , 'id_user');
    }
}
