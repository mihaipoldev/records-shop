<?php

use App\Models\Label;
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

		$label = new Label();
		$label->name = 'BodyParts';
		$label->save();

		$label = new Label();
		$label->name = 'Capodopere';
		$label->save();
	}
}
