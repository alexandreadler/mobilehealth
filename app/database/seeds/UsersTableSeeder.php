<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{

		DB::table("users")->truncate();
		DB::connection("public")->table("person")->delete();

		$user = new User;
		$user->username = 'admin';
	    $user->email = 'eniosombra@gmail.com';
	    $user->password = '1234';
	    $user->password_confirmation = '1234';
	    $user->confirmation_code = md5($user->username.time('U'));
	    $user->confirmed = true;
		$user->ultimo_acesso = \Carbon\Carbon::now();

	    if(! $user->save()) {
	      Log::info('Unable to create user '.$user->username, (array)$user->errors());
	    } else {

		    $pid = DB::connection("public")->select(DB::raw("SELECT nextval('person_seq')"));

		    $p = new Person;
		    $p->id = $pid[0]->nextval;
			$p->save();

		    $id = $p->id;

		    $user->person_id = $id;
		    $user->save();

		    Log::info('Created user "'.$user->username.'" <'.$user->email.'>');
	    }

	}

}
