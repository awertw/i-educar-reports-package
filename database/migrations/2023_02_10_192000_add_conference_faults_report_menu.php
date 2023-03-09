<?php

use App\Menu;
use Illuminate\Database\Migrations\Migration;

class AddConferenceFaultsReportMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Menu::query()->create([
            'id' => 99900,
            'parent_id' => 07032023,
            'title' => 'Relatório de conferência de faltas',
            'description' => null,
            'link' => '/module/Reports/ConferenceFaults',
            'order' => 1,
            'old' => NULL,
            'process' => 999809,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Menu::query()->where('process', 999809)->delete();
    }
}
