<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class AllergyreactionTableSeeder extends Seeder {

	public function run()
	{

		DB::connection("phr")->table("allergyreaction")->delete();

		DB::connection("phr")->table("allergyreaction")->insert(
			array(
				array("id" => "1" , "description" => "abdominal pain and/or pain"),
				array("id" => "2" , "description" => "abdominal swelling"),
				array("id" => "3" , "description" => "abnormal blood clotting"),
				array("id" => "4" , "description" => "abnormal reflexes"),
				array("id" => "5" , "description" => "abnormal thirst"),
				array("id" => "6" , "description" => "anaphylactic shock"),
				array("id" => "7" , "description" => "anxiety and/or feeling of impending doom"),
				array("id" => "8" , "description" => "blood infection"),
				array("id" => "9" , "description" => "chest tightness and/or discomfort"),
				array("id" => "10" , "description" => "constipation"),
				array("id" => "11" , "description" => "cough"),
				array("id" => "12" , "description" => "coughing up blood"),
				array("id" => "13" , "description" => "diarrhea"),
				array("id" => "14" , "description" => "difficulty swallowing"),
				array("id" => "15" , "description" => "dizziness and/or light-headedness"),
				array("id" => "16" , "description" => "easy bruising"),
				array("id" => "17" , "description" => "elevated liver enzymes"),
				array("id" => "18" , "description" => "enlarged glands"),
				array("id" => "19" , "description" => "excessive crying of infant"),
				array("id" => "20" , "description" => "excessive sleeping"),
				array("id" => "21" , "description" => "facial weakness"),
				array("id" => "22" , "description" => "fainting and/or loss of consciousness"),
				array("id" => "23" , "description" => "fast breathing"),
				array("id" => "24" , "description" => "fast heart rate"),
				array("id" => "25" , "description" => "fatigue"),
				array("id" => "26" , "description" => "fever"),
				array("id" => "27" , "description" => "flushing"),
				array("id" => "28" , "description" => "frequent urination"),
				array("id" => "29" , "description" => "gas"),
				array("id" => "30" , "description" => "green or yellow phlegm"),
				array("id" => "31" , "description" => "growth problem"),
				array("id" => "32" , "description" => "hallucinations"),
				array("id" => "33" , "description" => "headache"),
				array("id" => "34" , "description" => "hearing changes"),
				array("id" => "35" , "description" => "heart murmur"),
				array("id" => "36" , "description" => "heart palpitations"),
				array("id" => "37" , "description" => "heartburn"),
				array("id" => "38" , "description" => "hiccough"),
				array("id" => "39" , "description" => "high blood pressure"),
				array("id" => "40" , "description" => "hives (red, raised, itchy bumps)"),
				array("id" => "41" , "description" => "hyperventilation"),
				array("id" => "42" , "description" => "insomnia"),
				array("id" => "43" , "description" => "itching or numbness or tingling"),
				array("id" => "44" , "description" => "itchy, watery eyes"),
				array("id" => "45" , "description" => "jaundice or yellow skin"),
				array("id" => "46" , "description" => "lack of coordination"),
				array("id" => "47" , "description" => "leakage of stool"),
				array("id" => "48" , "description" => "leakage of urine"),
				array("id" => "49" , "description" => "loss of appetite"),
				array("id" => "50" , "description" => "low blood count"),
				array("id" => "51" , "description" => "low blood pressure"),
				array("id" => "52" , "description" => "memory loss"),
				array("id" => "53" , "description" => "muscle aches"),
				array("id" => "54" , "description" => "nasal congestion / runny nose"),
				array("id" => "55" , "description" => "nausea and/or vomiting"),
				array("id" => "56" , "description" => "nausea only"),
				array("id" => "57" , "description" => "noisy breathing"),
				array("id" => "58" , "description" => "nosebleed"),
				array("id" => "59" , "description" => "painful breathing"),
				array("id" => "60" , "description" => "painful urination"),
				array("id" => "61" , "description" => "paleness"),
				array("id" => "62" , "description" => "paralysis"),
				array("id" => "63" , "description" => "problem walking"),
				array("id" => "64" , "description" => "rash"),
				array("id" => "65" , "description" => "reduced urination"),
				array("id" => "66" , "description" => "retention of urine"),
				array("id" => "67" , "description" => "seizures"),
				array("id" => "68" , "description" => "shock"),
				array("id" => "69" , "description" => "shortness of breath"),
				array("id" => "70" , "description" => "smell or taste disturbance"),
				array("id" => "71" , "description" => "sneezing"),
				array("id" => "72" , "description" => "speech problem"),
				array("id" => "73" , "description" => "stiff neck"),
				array("id" => "74" , "description" => "sweating"),
				array("id" => "75" , "description" => "swelling"),
				array("id" => "76" , "description" => "throat pain"),
				array("id" => "77" , "description" => "twitching"),
				array("id" => "78" , "description" => "unconsciousness"),
				array("id" => "79" , "description" => "visual changes"),
				array("id" => "80" , "description" => "voice problem"),
				array("id" => "81" , "description" => "vomiting only"),
				array("id" => "82" , "description" => "weakness"),
				array("id" => "83" , "description" => "weight gain"),
				array("id" => "84" , "description" => "weight loss"),
				array("id" => "85" , "description" => "wheezing")
			)
		);

	}

}
