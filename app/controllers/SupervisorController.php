<?php



/**
 * SupervisorController Class
 *
 * Implements actions regarding user management
 */
class SupervisorController extends Controller
{
	
	
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
		
	}
	

	// atualiza uma lista de conteudos
	// EX: Caso a fonte abcsaude.com seja aprovada, atualiza toda a base de dados
	public function getAprovarfonte($f){
		
		DB::connection("public")->table('content')->where('url_online', 'like', '%'.$f.'%')->update(['font' => true]);
		DB::connection("public")->table('fonts')->where('url_fonts', 'like', '%'.$f.'%')->update(['valued' => true]);
		
		return Redirect::to('/');
		
	}
	
	public function getReprovarfonte($f){
		
		DB::table('content')->where('url_online', 'like', '%'.$f.'%')->delete();
		DB::table('fonts')->where('url_fonts', 'like', '%'.$f.'%')->delete();
		
		return Redirect::to('/');
		
	}
	
	
	public function getAprovarconteudo($id){
		// atualiza uma conteudos
		// EX: Caso a fonte abcsaude.com seja totalmente confiavel, atualiza um conteudo em especifico dessa fonte
		DB::connection("public")->table('content')->where('id', '=', $id)->update(['font' => true]);
		
		return Redirect::to('/');
		
	}
	
	public function getReprovarconteudo($id){
		
		
		// atualiza uma conteudos
		// EX: Caso a fonte abcsaude.com seja totalmente confiavel, atualiza um conteudo em especifico dessa fonte
		DB::connection("public")->table('content')->where('id', '=', $id)->delete();
		
		return Redirect::to('/');
		
	}

	public function getAvaliarlink($f){
		
		$title = "Avaliar links";
		
		$c = DB::connection("public")->table('content')->select()->where('url_online', 'like', '%'.$f.'%')->get();
		return View::make('supervisor/avaliarconteudo',compact('c', 'title'));
		
	}
	
	
	public function getNovoconteudo(){
		
		return View::make('supervisor/novoConteudo');
		
		
	}
	
	public function postCadastraconteudo(){
		
		$c = new Content;
		
		$author = Input::get('author');
		$dataCretion = Input::get('dataCretion');
		$title = Input::get('title');
		$description = Input::get('description');
		$url = Input::get('url');
		
		
		if(empty($author) or empty($dataCretion) or empty($title) or empty($description) or empty($url)){
			
			return View::make('supervisor.novoConteudo');
			
		} else {
			
			$flag = DB::table('public.content')->where('url_online', Input::get('url'))->get();;
			
			if($flag){
				
				$megERRO = "Contéudo já está cadastrado";
				return View::make('supervisor.novoConteudo', compact("megERRO"));
				
			} else {
			
				// verifica se encontra youtube no link
				$pos = strripos(Input::get('url'), "youtube");
				
				if($pos === false){
					// é um link para site ou arquivo
					$cid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));
					$frequenci_id = DB::connection("public")->select(DB::raw("insert into frequency values(nextval('frequency_id_seq'), '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0', '0,0,0,0,0,0,0')"));
					$file_id = DB::connection("public")->select(DB::raw("insert into file values (nextval('file_id_seq'), 0, null, null, 0,0,0,0,0)"));
					
					$c->id			= $cid[0]->nextval;
					$c->author		= Input::get('author');
					$c->title		= Input::get('title');
					$c->date_add	= Carbon\Carbon::now();
					$c->date_creation	= Input::get('dataCretion');
					$c->description	= Input::get('description');
					$c->url_online		= Input::get('url');
					
					$c->p1				= 0;
					$c->p2				= 0;
					$c->p3				= 0;
					$c->ss1				= 0;
					$c->ss1				= 0;
					$c->acceptancerate	= 0;
					$c->bytes_online	= 0;
					$c->rate_acceptance	= 0;
					$c->rate_colab_ponder	= 0;
					$c->rating			= 0;
					$c->seconds_online  = 0;
					$c->type		= 0;
					$c->visibility_group 	= 0;
					$c->local_views       = 1;
					$c->local_likes       = 0;
					$c->acceptancerate    = 0;
					$c->font 			= false;
					$c->save();
				
					$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
					$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
					
					
				} else {
					
					// link do youtbe
					
					
					$id = substr($url, 32, (strlen($url)));
					
					$data = VideoApi::setType('youtube')->getVideoDetail($id);
					
					$cid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));
					$frequenci_id = DB::connection("public")->select(DB::raw("insert into frequency values(nextval('frequency_id_seq'), '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0', '0,0,0,0,0,0,0')"));
					$file_id = DB::connection("public")->select(DB::raw("insert into file values (nextval('file_id_seq'), 0, null, null, 0,0,0,0,0)"));
					
					
					
					$c->id              = $cid[0]->nextval;
					$c->p1				= 0;
					$c->p2				= 0;
					$c->p3				= 0;
					$c->ss1				= 0;
					$c->ss1				= 0;
					$c->acceptancerate	= 0;
					$c->bytes_online		= 0;
					$c->author            = Input::get('author');
					$c->averagerating     = $data["like_count"];
					$c->date_add          = Carbon\Carbon::now();
					$c->date_creation     = $data["upload_date"];
					$c->description       = $data["description"];
					$c->rate_acceptance	= 0;
					$c->rate_colab_ponder	= 0;
					$c->rating			= 0;
					$c->seconds_online    = $data["duration"];
					$c->subtype           = AppController::VIDEO;
					$c->title             = $data["title"];
					$c->type				= 0;
					$c->url_online        = AppController::BASE_YOUTUBE_URL . $data["id"];
					$c->visibility        = $data["view_count"];
					$c->visibility_group 	= 0;
					$c->local_views       = 1;
					$c->local_likes       = 0;
					$c->acceptancerate    = 0;
					$c->thumburl          = $data["thumbnail_small"];
					$c->vid               = $data["id"];
					$c->font 			= false;
					$c->save();
					
					$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
					$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
						
						
				}
				
				
				return View::make('supervisor.novoConteudo');
				
			}
		
			
		
		}
	}
	

}