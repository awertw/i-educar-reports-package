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
        $parentId = Menu::query()->where('old', 999922)->firstOrFail()->getKey();
        $counter = 0;
        while(true){
            $id = $parentId + $counter;
            if(!Menu::query()->where('id', $id)->exists()){
                Menu::query()->create([
                    'id' => $id,
                    'parent_id' => $parentId,
                    'title' => 'Relatório de conferência de faltas',
                    'description' => null,
                    'link' => '/module/Reports/ConferenceFaults',
                    'order' => 0,
                    'old' => 230210,
                    'process' => 230210,
                ]);
                break;
            }
            $counter++;
        }
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
