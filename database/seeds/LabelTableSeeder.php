<?php

use Illuminate\Database\Seeder;

class LabelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('labels')->delete();

	    $label = new \App\Models\Label([
		    'name' => 'BodyParts',
	    ]);
	    $label->save();

	    $label = new \App\Models\Label([
		    'name' => 'Capodopere',
	    ]);
	    $label->save();
    }
}
