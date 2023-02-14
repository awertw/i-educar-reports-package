<?php

use App\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;

class AddConferenceFaultsReportMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            $parentId = Menu::query()->where('old', 999922)->firstOrFail()->getKey();
        } catch (\Exception $e) {
            $parentId = 0;
        }

        $counter = 0;
        while(true){
            $id = $parentId + $counter;
            try {
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
            } catch (QueryException $e) {
                // Do nothing and continue with the loop
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