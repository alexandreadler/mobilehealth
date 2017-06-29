<?php
use Illuminate\Http\Request;
class PhrController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /phr
	 *
	 * @return Response
	 */
	public function getIndex(){
		$title = "My Health";
		return View::make('phr',compact('title'));
	}


	public function getGlucose(){

		$title = "Blood Glucose";

		$context_list = Bloodglucosecontext::all()->lists("description","id");
		$pid = Confide::user()->person->id;
		$records = Bloodglucose::with('context')->where("id_person",'=',$pid)->orderBy('datetime','desc')->get();
		
		return View::make('phr.glucose',compact('title','context_list','records', 'pid'));

	}

	public function postGlucose(){

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$gid = DB::connection("public")->select(DB::raw("SELECT nextval('blood_glucose_seq')"))[0]->nextval;

		$g                          = new Bloodglucose;
		$g->id                      = $gid;
		$g->measure                 = str_replace(',','.',$input["measure"]);
		$g->id_person               = $pid;
		$g->id_bloodglucosecontext  = $input["context"];
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/glucose");

                
                

	}

	public function getPressure(){

		$title = "Blood Pressure";
		$pid = Confide::user()->person->id;
		$records = Bloodpressure::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();

		return View::make('phr.pressure',compact('title','records', 'pid'));

	}

	public function postPressure(){

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('blood_pressure_seq')"))[0]->nextval;

		$g                          = new Bloodpressure;
		$g->id                      = $id;
		$g->systolic                = str_replace(',','.',$input["sistolic"]);
		$g->diastolic				= str_replace(',', '.', $input["diastolic"]);
		//$g->irregularheartbeat      = $input["irregularheartbeat"];
		$g->id_person               = $pid;
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/pressure");


	}

	public function getWeight(){
		
		$title = "Weight";
		$pid = Confide::user()->person->id;
		//$records = Weight::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();

		//echo $records[0];
		//$d = date('d', strtotime($records[0]['datetime']));
		//echo ($d);
		
		$records = Weight::select(DB::raw('id, weight, datetime'))->where("id_person",'=',$pid)->orderBy('datetime', 'desc')->take(15)->get();
		
		
		return View::make('phr.weight',compact('title','records','pid'));

	}

	public function postWeight(){

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('weight_seq')"))[0]->nextval;

		$g                          = new Weight;
		$g->id                      = $id;
		$g->weight                  = str_replace(',','.',$input["weight"]);
		$g->id_person               = $pid;
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/weight");

	}


	public function postHemoglobin(){

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('hemoglobin_seq')"))[0]->nextval;

		$g                          = new Hemoglobin;
		$g->id                      = $id;
		$g->id_person               = $pid;
		$g->hemoglobin      		= str_replace(',','.',$input["hemoglobin"]);
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/hemoglobin");

	}


	public function getHemoglobin(){

		$title = "Hemoglobin";
		$pid = Confide::user()->person->id;
		$records = Hemoglobin::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();
		
		return View::make('phr.hemoglobin',compact('title','records', 'pid'));

	}



	public function getImc(){

		$title = "IMC";
		$pid = Confide::user()->person->id;
		$records = Imc::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();
		
		return View::make('phr.imc',compact('title','records', 'pid'));

	}


	public function getSituacion($imc){

		if($imc <17 )
			return "Muito abaixo do peso";
		 elseif($imc >=17 && $imc <= 18.49 )
			return "Abaixo do peso";

		elseif ($imc >=18.5 && $imc <= 24.99) 
			return "Peso normal";

		elseif ($imc >= 25 && $imc <= 29.99)
				return "Acima do peso";

		elseif ($imc >= 30 && $imc <= 34.99)
				return "Obesidade I";

		elseif ($imc >= 35 && $imc <= 39.99)
				return "Obesidade II (severa)";
		elseif ($imc >= 40 )
				return "Obesidade III (mórbida)";
		
	}

	public function postImc(){
		

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('height_seq')"))[0]->nextval;

		$g                          = new Imc;
		$g->id                      = $id;
		$g->height                  = str_replace(',','.',$input["height"]);
		$g->id_person               = $pid;
		$g->datetime                = \Carbon\Carbon::now();
		$g->weigth 					= str_replace(',', '.', $input["weight"]);
		$imc = str_replace(',', '.', ($input["weight"] / ( ($input["height"]/100) * ($input["height"]/100) ) ));
		$g->imc					= $imc;
		
		$g->situacion = $this->getSituacion($imc);

		$g->save();
		 Session::flash('sucess', '');
		return Redirect::intended("/phr/imc");
	

		



	}

	


	public function getAllergy(){

		$title = "Allergy";

		$areactions = Allergyreaction::all()->lists("description","id");
		$atypes     = Allergytype::all()->lists("description","id");

		$records = Allergy::with('type','reaction')->where("id_person",'=',Confide::user()->person->id)->orderBy('firstobserved','desc')->get();

		//dd($records);
		
		return View::make('phr.allergy',compact('title','areactions','atypes','records'));

	}

	public function postAllergy(){
		$input = Input::all();

		$pid = Confide::user()->person->id;

		$gid = DB::connection("public")->select(DB::raw("SELECT nextval('allergy_seq')"))[0]->nextval;

		$g                          = new Allergy;
		$g->id                      = $gid;
		$g->name                    = $input["nameAlergy"];
		$g->observation             = $input["observation"];
		$g->id_person               = $pid;
		$g->id_allergytype          = $input["id_allergytype"];
		$g->id_allergyreaction      = $input["id_allergyreaction"];
		$g->firstobserved           = $input["firstobserved"];
		$g->save();
		

		return Redirect::intended("/phr/allergy");


	}
	
	
	public function getDeleteallergy($id){
		
		echo $id;
		
	}
	
	public function getGrafico($tipo){
		
		
		for($i = 0; $i < 10; $i++){
	
			$data[] = array($i, $i*2);
		}
		
		if($tipo == 1){
			$titulo = "Peso";
			$codificado = serialize($data); //serializo
			$codificado = urlencode($codificado); // após serializado, passo a variavel por dentro de um urlencode
			return Redirect::to("grafico?titulo=$titulo&data=$codificado");
			
		} else {
			$titulo = "Peso";
			$codificado = serialize($data); //serializo
			$codificado = urlencode($codificado); // após serializado, passo a variavel por dentro de um urlencode
			return Redirect::to("grafico?titulo=$titulo&data=$codificado");
			
		}
	
	}
	


}