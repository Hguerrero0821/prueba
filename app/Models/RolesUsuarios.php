<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RolesUsuarios extends Model
{
    use HasFactory, Notifiable;

    protected $table = "roles_usuarios";
    protected $fillable = [
        'user_id',
        'rol_id'
    ];
    public $incrementing = false;
    protected $primaryKey = ['user_id', 'rol_id'];

    public function Roles()
    {
        return $this->belongsToOne(Roles::class);
    }

    public function User()
    {
        return $this->belongsToOne(User::class);
    }
}
