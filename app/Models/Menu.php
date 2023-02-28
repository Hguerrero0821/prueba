<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Menu extends Model
{
    use HasFactory, Notifiable;

    protected $table = "menu";
    //   $primaryKey = 'id';
    protected $fillable = [
        'name',
        'url'
    ];


    public function submenu() {

        return $this->hasMany('\App\Models\Submenu');

    }


}
