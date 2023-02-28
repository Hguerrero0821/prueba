<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Route;

class DataModel extends Model
{
    use HasFactory;

    public function getmenu(){
        $Routname=Route::currentRouteName();
       // dd($Routname);
        $menu=DB::select('select * from menu where menu_inactive =?', ['0']);
        $submenu=DB::select('select * from submenu where sub_inactive =?', ['0']);
        $menuid=DB::select('select menu_id from submenu where url = ?', [$Routname]);
        $subid=DB::select('select sub_id from submenu where url = ?', [$Routname]);

       
        return ['menu'=>$menu,'submenu'=>$submenu,'menuid'=>$menuid ,'subid'=>$subid];
    }
}
