<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class AllergytypeTableSeeder extends Seeder {

	public function run()
	{

		DB::connection("phr")->table("allergytype")->delete();

		DB::connection("phr")->table("allergytype")->insert(
			array(
				array("id" => "1" , "description" => "Animal"),
				array("id" => "2" , "description" => "Environmental"),
				array("id" => "3" , "description" => "Food"),
				array("id" => "4" , "description" => "Medication"),
				array("id" => "5" , "description" => "Plant"),
			)
		);

	}

}
