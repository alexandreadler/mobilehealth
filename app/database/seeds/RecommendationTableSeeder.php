<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RecommendationTableSeeder extends Seeder {

	public function run()
	{

		$faker = Faker::create();


		$person 	= Person::all()->lists("id");
		$content	= Content::all()->lists("id");

		DB::connection('public')->table("recommendation")->delete();

		foreach(range(1, 30) as $index)
		{

			$rid = DB::connection("public")->select(DB::raw("SELECT nextval('recommendation_id_seq')"))[0]->nextval;

			$s = Recommendation::create([
				'id'                => $rid,
				'id_content'        => $faker->randomElement($content),
				'id_person'        => $faker->randomElement($person),
			]);

			$s->save();

		}

	}

}