<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;

class Roles extends Model
{
    use HasFactory;
    protected $table = "roless";
    protected $fillable = [
        'name',
        'descripcion'
    ];

    public function RolesUsuarios() {

        return $this->hasMany('\App\Models\RolesUsuarios');

    }

    public function RolMenu() {

        return $this->hasMany('\App\Models\RolMenu','rol_id');

    }
}
