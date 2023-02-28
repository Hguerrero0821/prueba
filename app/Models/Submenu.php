<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Submenu extends Model
{
    use HasFactory, Notifiable;

    protected $table = "submenu";
    protected $fillable = [
        'name',
        'menu_id',
        'url'
    ];
    //protected $primaryKey = 'id';

    public function Menu()
    {
        return $this->belongsToOne(Menu::class);
    }

}
