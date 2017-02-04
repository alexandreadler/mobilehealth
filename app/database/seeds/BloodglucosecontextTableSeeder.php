<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class BloodglucosecontextTableSeeder extends Seeder {

	public function run()
	{

		DB::connection("phr")->table("bloodglucosecontext")->delete();

		DB::connection("phr")->table("bloodglucosecontext")->insert(
			array(
				array("id" => "1" , "description" => "After breakfast"),
				array("id" => "2" , "description" => "After dinner"),
				array("id" => "3" , "description" => "After exercise"),
				array("id" => "4" , "description" => "After lunch"),
				array("id" => "5" , "description" => "After meal"),
				array("id" => "6" , "description" => "Before bedtime"),
				array("id" => "7" , "description" => "Before breakfast"),
				array("id" => "8" , "description" => "Before dinner"),
				array("id" => "9" , "description" => "Before exercise"),
				array("id" => "10" , "description" => "Before lunch"),
				array("id" => "11" , "description" => "Before meal"),
				array("id" => "12" , "description" => "Fasting"),
				array("id" => "13" , "description" => "Ignore"),
				array("id" => "14" , "description" => "Non-fasting"),
			)
		);

	}

}
