<?php

class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /profile
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		$user   = Confide::user();

		$pid    = $user->person_id;

		$person = $user->person;

		$title = 'Profile';
		return View::make('profile',compact('title','pid','person'));
	}

	/**
	 * Display a listing of the resource.
	 * GET /profile
	 *
	 * @return Response
	 
	 
	 
	 
	 
	 
	 public function postIndex()
	{
		$input = Input::all();

		$pid = $input["pid"];

		$p                  = Person::find($pid);
		$p->name_last        = $input["lname"];
		$p->name_first       = $input["fname"];
		$p->date_birth       = $input["birthdate"];
		$p->gender           = $input["gender"];

		if (isset($input["disease"]))
			$p->disease         = $input["disease"];

		$p->save();

		return Redirect::intended("/profile");
	}
	 */
	 
	public function postIndex()
	{
		$input = Input::all();

		$pid = $input["pid"];

		$p                  = Person::find($pid);
		$p->date_birth       = $input["birthdate"];
		
		if(isset($input["lname"])){
			$p->name_last        = $input["lname"];
			echo "aqui";

		} else {
			$p->name_last        = null;
		}

		if(isset($input["fname"])){
			$p->name_first       = $input["fname"];
		} else {
			$p->name_first        = null;
		}

		

		if(isset($input["gender"])){
			$p->gender           = $input["gender"];
		} else {
			$p->gender        = null;
		}

		
		if (isset($input["disease"])){
			$p->disease         = $input["disease"];
		} else {
			$p->disease         = null;
			
		}
		
		$p->save();

		return Redirect::intended("/profile");
	}


}