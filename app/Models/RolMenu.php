<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;


class RolMenu extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'rol_menus';
    protected $fillable = [
        'submenu_id',
        'rol_id',
        'crear',
        'editar',
        'eliminar'
    ];
    public $incrementing = false;
    protected $primaryKey = ['submenu_id', 'rol_id'];


    public function Roles()
    {
        return $this->belongsTo(Roles::class);
    }

    public function SubMenu()
    {
        return $this->belongsToOne(SubMenu::class);
    }

}
