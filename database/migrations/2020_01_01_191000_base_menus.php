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
        $parentSchoolMenu = Menu::query()->where('old', Process::MENU_SCHOOL)->first();
        if ($parentSchoolMenu) {
            Menu::query()->updateOrCreate([
                'old' => 21126,
            ], [
                'parent_id' => $parentSchoolMenu->getKey(),
                'title' => 'Relatórios',
                'order' => 5,
                'parent_old' => 15,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 21127,
            ], [
                'parent_id' => $parentSchoolMenu->getKey(),
                'title' => 'Documentos',
                'order' => 6,
                'parent_old' => 15,
            ]);
        }

        $parentRelatoriosMenu = Menu::query()->where('old', 21126)->first();
        if ($parentRelatoriosMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999301,
            ], [
                'parent_id' => $parentRelatoriosMenu->getKey(),
                'title' => 'Movimentações',
                'order' => 2,
                'parent_old' => 21126,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999922,
            ], [
                'parent_id' => $parentRelatoriosMenu->getKey(),
                'title' => 'Lançamentos',
                'order' => 3,
                'parent_old' => 21126,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999300,
            ], [
                'parent_id' => $parentRelatoriosMenu->getKey(),
                'title' => 'Cadastrais',
                'order' => 4,
                'parent_old' => 21126,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999923,
            ], [
                'parent_id' => $parentRelatoriosMenu->getKey(),
                'title' => 'Matrículas',
                'order' => 5,
                'parent_old' => 21126,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999303,
            ], [
                'parent_id' => $parentRelatoriosMenu->getKey(),
                'title' => 'Indicadores',
                'order' => 6,
                'parent_old' => 21126,
            ]);
        }

        $parentDocumentosMenu = Menu::query()->where('old', 21127)->first();
        if ($parentDocumentosMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999400,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Atestados',
                'order' => 0,
                'parent_old' => 21127,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999450,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Boletins',
                'order' => 2,
                'parent_old' => 21127,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999925,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Resultados',
                'order' => 3,
                'parent_old' => 21127,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999861,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Fichas',
                'order' => 8,
                'parent_old' => 21127,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999460,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Históricos',
                'order' => 9,
                'parent_old' => 21127,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999500,
            ], [
                'parent_id' => $parentDocumentosMenu->getKey(),
                'title' => 'Registros',
                'order' => 10,
                'parent_old' => 21127,
            ]);
        }

        $parentLibraryMenu = Menu::query()->where('old', Process::MENU_LIBRARY)->first();
        if ($parentLibraryMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999614,
            ], [
                'parent_id' => $parentLibraryMenu->getKey(),
                'title' => 'Relatórios',
                'order' => 3,
                'parent_old' => 16,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999831,
            ], [
                'parent_id' => $parentLibraryMenu->getKey(),
                'title' => 'Documentos',
                'order' => 4,
                'parent_old' => 16,
            ]);
        }

        $parentRelatoriosLibraryMenu = Menu::query()->where('old', 999614)->first();
        if ($parentRelatoriosLibraryMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999905,
            ], [
                'parent_id' => $parentRelatoriosLibraryMenu->getKey(),
                'title' => 'Cadastrais',
                'order' => 1,
                'parent_old' => 999614,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999906,
            ], [
                'parent_id' => $parentRelatoriosLibraryMenu->getKey(),
                'title' => 'Movimentações',
                'order' => 2,
                'parent_old' => 999614,
            ]);
        }

        $parentDocumentosLibraryMenu = Menu::query()->where('old', 999831)->first();
        if ($parentDocumentosLibraryMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999907,
            ], [
                'parent_id' => $parentDocumentosLibraryMenu->getKey(),
                'title' => 'Comprovantes',
                'order' => 3,
                'parent_old' => 999831,
            ]);
        }

        $parentTransportMenu = Menu::query()->where('old', Process::MENU_TRANSPORT)->first();
        if ($parentTransportMenu) {
            Menu::query()->updateOrCreate([
                'old' => 20712,
            ], [
                'parent_id' => $parentTransportMenu->getKey(),
                'title' => 'Relatórios',
                'order' => 3,
                'parent_old' => 17,
            ]);
        }

        $parentRelatoriosTransportMenu = Menu::query()->where('old', 20712)->first();
        if ($parentRelatoriosTransportMenu) {
            Menu::query()->updateOrCreate([
                'old' => 9998847,
            ], [
                'parent_id' => $parentRelatoriosTransportMenu->getKey(),
                'title' => 'Cadastrais',
                'order' => 1,
                'parent_old' => 20712,
            ]);
        }

        $parentEmployeesMenu = Menu::query()->where('old', Process::MENU_EMPLOYEES)->first();
        if ($parentEmployeesMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999913,
            ], [
                'parent_id' => $parentEmployeesMenu->getKey(),
                'title' => 'Relatórios',
                'order' => 2,
                'parent_old' => 71,
            ]);
            Menu::query()->updateOrCreate([
                'old' => 999916,
            ], [
                'parent_id' => $parentEmployeesMenu->getKey(),
                'title' => 'Documentos',
                'order' => 3,
                'parent_old' => 71,
            ]);
        }

        $parentRelatoriosEmployeesMenu = Menu::query()->where('old', 999913)->first();
        if ($parentRelatoriosEmployeesMenu) {
            Menu::query()->updateOrCreate([
                'old' => 999914,
            ], [
                'parent_id' => $parentRelatoriosEmployeesMenu->getKey(),
                'title' => 'Cadastrais',
                'order' => 1,
                'parent_old' => 999913,
            ]);
        }
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
