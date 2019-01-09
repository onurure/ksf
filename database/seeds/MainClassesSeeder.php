<?php

use Illuminate\Database\Seeder;

class MainClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_classes')->insert([
        [
            'name' => 'GELİR',
            'color' => '#ccc'
        ],[
            'name' => 'GİDER',
            'color' => '#ccc'
        ],[
            'name' => 'GİDER-PERSONEL MAAŞI-RESMİ',
            'color' => '#ccc'
        ],[
            'name' => 'GİDER-PERSONEL MAAŞI-GR',
            'color' => '#ccc'
        ],[
            'name' => 'GİDER-PERSONEL MAAŞI-PRİM',
            'color' => '#ccc'
        ],[
            'name' => 'KAR PAYI',
            'color' => '#ccc'
        ],[
            'name' => 'KASALAR ARASI PARA AKTARIMI',
            'color' => '#ccc'
        ],[
            'name' => 'BİRBİRİNİ GÖTÜREN KASA HAREKETİ',
            'color' => '#ccc'
        ]
        ]);
    }
}
