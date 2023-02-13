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
            'parent_id' => Menu::query()->where('old', 230210)->firstOrFail()->getKey(),
            'title' => 'Relatório de conferência de faltas',
            'description' => null,
            'link' => '/module/Reports/ConferenceFaults',
            'order' => 0,
            'old' => 230210,
            'process' => 230210,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Menu::query()->where('process', 230210)->delete();
    }
}
