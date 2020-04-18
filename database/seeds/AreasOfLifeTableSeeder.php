<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Entities\AreaOfLife;

class AreasOfLifeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['beruf_und_karriere', 'familie' ,'freundschaften', 'koerper_und_gesundheit', 'partnerschaft', 'sexualitaet', 'spiritualitaet',];
   
        foreach ($names as $name) {
            DB::table('area_of_lives')->insert([
                'name' => $name,
            ]);
        }
    }
}
