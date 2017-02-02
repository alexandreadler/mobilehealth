<?php



/**
 * SupervisorController Class
 *
 * Implements actions regarding user management
 */
class SupervisorController extends Controller {
	
	
	// ************************ Redireciona para a página de visualizaçãpo do video **************************
	public function getVideo($id) {
		
		
		// Recupera as informações do videos presentes no banco
		$con = Content::where('id', '=', $id)->get();
		
		// Pega os metadados do video
		$data = VideoApi::setType('youtube')->getVideoDetail($con[0]->vid);

										
		$vid = $con[0]->vid;

		//dd($con);
		
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
		
		DB::connection("public")->table('content')->where('url_online', 'like', '%'.$f.'%')->delete();
		DB::connection("public")->table('fonts')->where('url_fonts', 'like', '%'.$f.'%')->delete();
		
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
		DB::connection("public")->table('relatepersoncontent')->where('id_content', '=', $id)->delete();
		DB::connection("public")->table('recommendation')->where('id_content', '=', $id)->delete();
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
					
					$c->id					= $cid[0]->nextval;
					$c->p1					= 0;
					$c->p2					= 0;
					$c->p3					= 0;
					$c->ss1					= 0;
					$c->ss2					= 0;
					$c->acceptancerate		= 0;
					$c->bytes_online		= 0;
					$c->author				= Input::get('author');
					$c->averagerating   	= 0;
					$c->date_add			= Carbon\Carbon::now();
					$c->date_creation		= Input::get('dataCretion');
					$c->description			= Input::get('description');
					$c->acceptancerate		= 0;
					$c->rate_acceptance		= 0;
					$c->rate_colab_ponder	= 0;
					$c->rating				= 0;
					$c->seconds_online  	= 0;
					$c->subtype    			= 3;
					$c->title				= Input::get('title');
					$c->type				= 0;
					$c->url_online			= Input::get('url');
					$c->visibility    = 0;
					$c->visibility_group 	= 0;
					$c->local_views       	= 1;
					$c->local_likes       	= 0;
					$c->acceptancerate    	= 0;
					$c->font 				= false;
					$c->save();
				
					$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
					$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
					
					$f = new Fonts;
					$rest = substr($c->url_online, 0, 6);

					if (strcmp('http:/', $rest) != 0) {

						$temp = substr($c->url_online, 8 - strlen($c->url_online));
                    	$fonte = "https://" . strstr($temp, '/', true);

					} else {

						$temp = substr($c->url_online, 7 - strlen($c->url_online));
                    	$fonte = "http://" . strstr($temp, '/', true);
					}

					
					$cid = DB::connection("public")->select(DB::raw("SELECT nextval('fonts_seq')"));
					$f->id = $cid[0]->nextval;
					$f->url_fonts = $fonte;
					$f->valued = false;
					$f->save();

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
					$c->ss2				= 0;
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
	
    public function getPesquisarconteudo(){

    	$show_search_content = true;
        $title = "Pesquisar Conteúdos";

        // redireciona para a pagina onde o video é exibido
        return View::make('supervisor.search-content', compact('show_search_content', 'title'));
                     
    }
        
    public function getShowsearchcontent(){
       
    	$search = Session::get('search');

    	// Caso seja a primeira pesquisa
       if($search){
       		
       } else {

       		

       		if(isset($input["search"])){
       			$input = Input::all();
       			Session::put('search',$input["search"]);
       			
       		} 

       }
       
       
        $aux = DB::connection("public")->select(DB::raw("select c.id, c.thumburl, c.url_online, c.title, c.description from public.content as c where c.font = false and ((title ilike '%".Session::get('search')."%') or (description ilike '%".Session::get('search')."%'))"));

        $show_search_content = true;
        $title = "Pesquisar Conteúdos";
        
  		
       return View::make('supervisor.search-content', compact('aux', 'show_search_content', 'title'));
        
    }
    

    public function postDeletarconteudo($id_content){

    		
    		DB::table('public.context')->where('id_content', '=', $id_content)->delete();

    		DB::connection("public")->select(DB::raw("delete from public.recommendation where id_content = ".$id_content));

    		DB::connection("public")->select(DB::raw("delete from public.relatepersoncontent where id_content = ".$id_content));

    		$id_frequency = DB::connection("public")->select(DB::raw("select id_frequency from content where id =".$id_content));

			

			DB::table('public.content')->where('id', '=', $id_content)->delete();

    		DB::connection("public")->select(DB::raw("delete from public.frequency where id = ".$id_frequency[0]->id_frequency));

    		
    		$aux = DB::connection("public")->select(DB::raw("select c.id, c.thumburl, c.url_online, c.title, c.description from public.content as c where c.font = false and ((title ilike '%".Session::get('search')."%') or (description ilike '%".Session::get('search')."%'))"));



        	return Redirect::to('supervisor/showsearchcontent');
        	//return View::make('supervisor/showsearchcontent', compact('show_search_content', 'title'));

    }


    public function getEditarconteudo($id_content){


    	$content = DB::table('public.content')->select(DB::raw('id, author, date_creation, title, description, url_online'))->where('id', '=', $id_content)->get();
    	$content = $content[0];

    	//dd($content);

    	// Passa a string, pois após editar o conteúdo os mesmos item devem ser listados
    	return View::make('supervisor/editarConteudo', compact('content'));

    	

    }


    public function postEditarconteudo(){


		$c = new Content;
	
		$author = Input::get('author');
		$dataCretion = Input::get('dataCretion');
		$title = Input::get('title');
		$description = Input::get('description');
		$url = Input::get('url');
	
	
		if(empty($author) or empty($dataCretion) or empty($title) or empty($description) or empty($url)){
			
			return View::make('supervisor/editarConteudo', compact('content', 'string'));
			$megERRO = "Por favor, preencha todos os campos";

		} else {
			
			$c = DB::table('public.content')->where('url_online', Input::get('url'))->get();

			$c = $c[0];

			$c = Content::find($c->id);

			
			$c->author				= Input::get('author');
			$c->date_creation		= Input::get('dataCretion');
			$c->description			= Input::get('description');
			$c->title				= Input::get('title');
			$c->url_online			= Input::get('url');

			$c->save();

			return Redirect::to('supervisor/showsearchcontent');
				
		}
	
	}

}