<?php

namespace Database\Seeders;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            'name'=>'home',
            'url'=>'home'
        ];

        foreach($links as $key =>$menus) {
            Menu::create($menus);
        }
    }
}