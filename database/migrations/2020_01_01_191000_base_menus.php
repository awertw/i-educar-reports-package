<?php

use App\Menu;
use App\Process;
use Illuminate\Database\Migrations\Migration;

class BaseMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Menu::query()->where('old', 999914)->delete();
        Menu::query()->where('old', 999916)->delete();
        Menu::query()->where('old', 999913)->delete();
        Menu::query()->where('old', 9998847)->delete();
        Menu::query()->where('old', 20712)->delete();
        Menu::query()->where('old', 999907)->delete();
        Menu::query()->where('old', 999906)->delete();
        Menu::query()->where('old', 999905)->delete();
        Menu::query()->where('old', 999831)->delete();
        Menu::query()->where('old', 999614)->delete();
        Menu::query()->where('old', 999500)->delete();
        Menu::query()->where('old', 999460)->delete();
        Menu::query()->where('old', 999861)->delete();
        Menu::query()->where('old', 999925)->delete();
        Menu::query()->where('old', 999450)->delete();
        Menu::query()->where('old', 999400)->delete();
        Menu::query()->where('old', 999303)->delete();
        Menu::query()->where('old', 999923)->delete();
        Menu::query()->where('old', 999300)->delete();
        Menu::query()->where('old', 999922)->delete();
        Menu::query()->where('old', 999301)->delete();
        Menu::query()->where('old', 21127)->delete();
        Menu::query()->where('old', 21126)->delete();
    }
}
