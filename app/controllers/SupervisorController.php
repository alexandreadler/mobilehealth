<?php



/**
 * SupervisorController Class
 *
 * Implements actions regarding user management
 */
class SupervisorController extends Controller
{
	
	// ********************** Pega os participantes que possão ser seus possiveis pacientes ******************************** 
	public function getAcompanharnovo(){
		
		$sid = Confide::user()->person->id;
		$relates = DB::connection("public")->select(DB::raw("select * from public.person p, app.users u where p.id not in(select rps.id_person from relate_person_supervisor rps where rps.id_supervisor =".$sid.") and p.id= u.person_id and u.type= false"));			
		
		return View::make('supervisor.acompanharnovo', compact('relates'));
	}
	
	
	// ******************** Gera a relação entre o supervisor e o paciente ****************************
	public function postAddrelate() {

		// Pega o id do paciente selecionado
		$fpersonid = Input::segment(3);

		// A mensagens enviada pelo supervisor
		$message = Input::get('message');

		$me = Confide::user()->person_id;

		// Armazena a mensagem na base de dados
		$m = new Message;
		$m->id_person_from  = $me;
		$m->id_person_to    = $fpersonid;
		$m->message         = $message;
		$m->viewed          = false;
		$m->save();


		// Insere a relação no BD
		$frequenci_id = DB::connection("public")->select(DB::raw("insert into relate_person_supervisor values (nextval('relate_person_supervisor_id_seq'), ".$fpersonid.", ".$me.")"));

		return Redirect::to('supervisor/acompanharnovo'); 
	}
	
	// ******************* Redireciona para a página de avaliar os conteúds de um usuário ******************************
	public function getAvaliarconteudo(){
		
		// Pega o id do paciente
		$id = Input::segment(3);
		
		// Pega todas as recomendações não avaliadas desse passiente.
		$rcs = Recommendation::where('id_person','=',$id)->where('visited', '=', false)->where('evaluation', '=', 'false')->lists('id_content');
			
		// verifica se tem alguma recomendação
		// Caso tenha as divide em videos e links, respectivamente, e limita a três registros
		if ($rcs){
				
			$c = Content::whereIn('id',$rcs)->where('subtype','=','2')->take(3)->get();
			$c2 = Content::whereIn('id',$rcs)->where('subtype','=','3')->take(3)->get();
		}
		
		return View::make('supervisor/avaliarconteudo',compact('c', 'c2', 'message', 'id'));
		
		
		
	}
	
	// ********************* Pega a avaliação positiva de um supervisor sobre um contéudo X *******************************
	public function getLike() {

		// Pega o id do paciente e do conteúdo
		$vid = $_GET['vid'];
		$pid = $_GET['pid'];

		// Habilita a visualização 
		$file_id = DB::connection("public")->select(DB::raw("update recommendation set evaluation=true where id_content = ".$vid." and id_person=".$pid));

		return Redirect::to('/supervisor/avaliarconteudo/'.$pid);
		
	}	
	
	// ********************** Pega a avaliação negativa de um supervisor sobre um conteúdo Y **********************************
	public function getUnlike() {

		// Pega o id do paciente e do conteúdo
		$vid = $_GET['vid'];
		$pid = $_GET['pid'];

		
		// Gerar uma nova Relação (relatepersoncontent)
		// Como foi avaliado negativamente, a relação desse conteúdo com o paciente é negativa.
		$rid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
		$rid = $rid[0]->nextval;
		$v                  = new Relatepersoncontent;
		$v->id              = $rid;
		$v->date_relation    = \Carbon\Carbon::now();
		$v->id_content      = $vid;
		$v->id_person       = $pid;
		$v->liked           = -1;
		$v->save();
		
		
		// Como ele não é adequqdo para um usuário, segundo um supervisor, o registro da recomendação é deletado da tabela.
		$file_id = DB::connection("public")->select(DB::raw("delete from recommendation where id_content = ".$vid." and id_person=".$pid));

		return Redirect::to('/supervisor/avaliarconteudo/'.$pid);
		
		
	}
	
	
	// ************************ Redireciona para a página de visualizaçãpo do video **************************
	public function getVideo($id) {
		
		// Pega os metadados do video
		$data = VideoApi::setType('youtube')->getVideoDetail($id);

		// Recupera as informações do videos presentes no banco
		$con = Content::where('vid', '=', $data["id"])->get();								
		$vid = $con[0]->id;

		// redireciona para a pagina onde o video é exibido
		return View::make('supervisor.video', compact("id","data","vid"));

	}
	
	
	// Redireciona para a página da url recebida am 'a'
	public function getUrl(){
		
		$a = $_GET['a'];
		return Redirect::to($a);
		
		
	}
	
	
	//****************************** redireciona para a página de cadastro de novo supervisor ****************************
	public function getNovosupervisor(){
		
		return View::make('supervisor.user.signup');
	}
	
	
	public function postCadastranovosupervisor(){
		
		$repo = App::make('UserRepository');
		$user = $repo->signup(Input::all());
		
		/**
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password_confirmation = $_POST['password_confirmation'];
		$gender =  $_POST['gender'];
		$remember_token = $_POST['_token'];
		
		
		$pid = DB::connection("public")->select(DB::raw("SELECT nextval('person_seq')"));
		//$uid = DB::connection("app")->select(DB::raw("SELECT nextval('users_id_seq')"));

		$u = new User;
		//$u->id = $uid[0]->nextval+1;
		$u->username = $username;
		$u->email = $email;
		$u->password = $password;
		$u->password_confirmation = $password_confirmation;
		$u->remember_token = $remember_token;
		$u->confirmed = false;
		$u->ultimo_acesso = Carbon\Carbon::now();
		$u->person_id = $pid[0]->nextval;
		$u->gender = $gender;
		
		var_dump ($u);
		
	    $p = new Person;
	    $p->id = $pid[0]->nextval;
		$p->name_first = $username;
		$p->date_birth = Carbon\Carbon::now();
		$p->gender = $gender;
	    //$p->save();

		**/
		//return Redirect::to('/');
	}
	
	
	
	
	
	
	
	//****************** METÓDOS RELACIONADOS AO PERFIL DO USUÁRIO QUE O SUPERVISOR ESTÁ ACOMPANHANDO *****************
	
	public function getPerfil($pid) {
		
		$me = Confide::user()->person_id;

		return View::make('supervisor.phr', compact("me", "pid"));

	}
	
	public function getGlucose($pid)
	{
		$title = "Blood Glucose";

		$context_list = Bloodglucosecontext::all()->lists("description","id");
		$records = Bloodglucose::with('context')->where("id_person",'=',$pid)->orderBy('datetime','desc')->get();
		
		return View::make('supervisor.phr.glucose',compact('title','context_list','records', 'pid'));

	}

	public function postGlucose()
	{

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

	public function getPressure($pid)
	{

		$title = "Blood Pressure";
		$records = Bloodpressure::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();

		return View::make('supervisor.phr.pressure',compact('title','records', 'pid'));

	}

	public function postPressure()
	{

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('blood_pressure_seq')"))[0]->nextval;

		$g                          = new Bloodpressure;
		$g->id                      = $id;
		$g->pulse                   = str_replace(',','.',$input["pulse"]);
		$g->irregularheartbeat      = $input["irregularheartbeat"];
		$g->id_person               = $pid;
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/pressure");


	}

	public function getWeight($pid)
	{
		
		$title = "Weight";
		//$records = Weight::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();

		//echo $records[0];
		//$d = date('d', strtotime($records[0]['datetime']));
		//echo ($d);
		
		$records = Weight::select(DB::raw('id, weight as data, datetime'))->where("id_person",'=',27)->orderBy('datetime', 'desc')->take(15)->get();
		
		
		return View::make('supervisor.phr.weight',compact('title','records','pid'));

	}

	public function postWeight()
	{

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

	public function getHeight($pid)
	{

		$title = "Height";
		$records = Height::where("id_person",'=',$pid)->orderBy('datetime','desc')->get();
		
		return View::make('supervisor.phr.height',compact('title','records', 'pid'));

	}

	public function postHeight()
	{

		$input = Input::all();

		$pid = Confide::user()->person->id;

		$id = DB::connection("public")->select(DB::raw("SELECT nextval('height_seq')"))[0]->nextval;

		$g                          = new Height;
		$g->id                      = $id;
		$g->height                  = str_replace(',','.',$input["height"]);
		$g->id_person               = $pid;
		$g->datetime                = \Carbon\Carbon::now();
		$g->save();

		return Redirect::intended("/phr/height");

	}


	public function getAllergy($pid)
	{

		$title = "Allergy";

		$areactions = Allergyreaction::all()->lists("description","id");
		$atypes     = Allergytype::all()->lists("description","id");

		$records = Allergy::with('type','reaction')->where("id_person",'=',$pid)->orderBy('firstobserved','desc')->get();

		return View::make('supervisor.phr.allergy',compact('pid','title','areactions','atypes','records'));

	}

	public function postAllergy()
	{
		$input = Input::all();

		$pid = Confide::user()->person->id;

		$gid = DB::connection("public")->select(DB::raw("SELECT nextval('allergy_seq')"))[0]->nextval;

		$g                          = new Allergy;
		$g->id                      = $gid;
		$g->name                    = $input["name"];
		$g->observation             = $input["observation"];
		$g->id_person               = $pid;
		$g->id_allergytype          = $input["id_allergytype"];
		$g->id_allergyreaction      = $input["id_allergyreaction"];
		$g->firstobserved           = $input["firstobserved"];
		$g->save();

		return Redirect::intended("/phr/allergy");


	}
	
	//****************** FIM - METÓDOS RELACIONADOS AO PERFIL DO USUÁRIO QUE O SUPERVISOR ESTÁ ACOMPANHANDO *****************
	
	// atualiza uma lista de conteudos
	// EX: Caso a fonte abcsaude.com seja aprovada, atualiza toda a base de dados
	public function getAprovarfonte($f){
		
		DB::connection("public")->table('content')->where('url_online', 'like', '%'.$f.'%')->update(['font' => true]);
		
		return Redirect::to('/');
		
	}
	
	public function getReprovarfonte($f){
		
		DB::connection("public")->table('content')->where('url_online', 'like', '%'.$f.'%')->delete();
		return Redirect::to('/');
		
	}
	
	
	public function getAprovarConteudo($id){
		// atualiza uma conteudos
		// EX: Caso a fonte abcsaude.com seja totalmente confiavel, atualiza um conteudo em especifico dessa fonte
		DB::connection("public")->table('content')->where('id', '=', $id)->update(['font' => true]);
		
		return Redirect::to('/');
		
	}
	
	public function getReprovarConteudo($id){
		// atualiza uma conteudos
		// EX: Caso a fonte abcsaude.com seja totalmente confiavel, atualiza um conteudo em especifico dessa fonte
		DB::connection("public")->table('content')->where('id', '=', $id)->delete();
		
		return Redirect::to('/');
		
	}

	public function getAvaliarlink($f){
		
		$c = DB::connection("public")->table('content')->select()->where('url_online', 'like', '%'.$f.'%')->get();
		return View::make('supervisor/avaliarconteudo',compact('c'));
		
	}
	
	
	public function getNovoconteudo(){
		
		return View::make('supervisor/novoConteudo');
		
		
	}
	
	public function postCadastraconteudo(){
		
		
		
	}

	
}