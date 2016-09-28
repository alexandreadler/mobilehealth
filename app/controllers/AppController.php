<?php


/**
 * UsersController Class
 *
 * Implements actions regarding user management
 */
class AppController extends Controller
{

	const URL               = 1;
	const VIDEO             = 2;
	const BASE_YOUTUBE_URL  = "https://www.youtube.com/watch?v=";

	public function getHome() {

		//************************************ Recupera os contéudos recomendados ******************************************
		//******************************************************************************************************************
		$message = DB::connection("app")->select(DB::raw("select distinct p.name_first, p.name_last, p.id, m.id_person_from from public.person p, app.message m where m.viewed = false and (m.id_person_to =".Confide::user()->person->id.") and ((m.id_person_from = p.id))"));
		$name = DB::connection("app")->select(DB::raw("select p.name_first, p.name_last from public.person p where (p.id =".Confide::user()->person->id.")"));

		
		$name = $name[0]->name_first . " " . $name[0]->name_last;
		Session::put('fullName', $name);
		Session::put('profilePicture', 'imgs/'.Confide::user()->photo);
		
		if(Confide::user()->type){
			
			// Quando supervisor
			
			$pid = Confide::user()->person->id;
			
			//************************************ Recupera os conteudos do FEED **********************************************************
			//******************************************************************************************************************
			
				$contents = DB::connection("public")->select(DB::raw("select c.*, rpc.id_person, p.name_first, rpc.date_relation as create_at, u.photo from public.relatepersoncontent as rpc inner join public.content as c on (rpc.id_content = c.id) and rpc.id_person in (select id_following from app.follow where id_follower =".$pid.") inner join public.person as p on p.id = rpc.id_person inner join app.users as u on u.person_id = p.id order by rpc.date_relation desc"));	
				$contents = DB::connection("public")->select(DB::raw("select c.*, rpc.id_person, p.name_first, rpc.date_relation as create_at, u.photo, pt.id as idpost from public.relatepersoncontent as rpc inner join public.content as c on (rpc.id_content = c.id) and rpc.id_person in (select id_following from app.follow where id_follower =".$pid.") inner join public.person as p on p.id = rpc.id_person inner join app.users as u on u.person_id = p.id inner join app.posts pt on pt.texto = cast(c.id as text) order by rpc.date_relation desc"));
			//************************************ [FIM] Recupera os conteudos do FEED **********************************************************
			//******************************************************************************************************************
			
			
			//************************************ Recupera os post do FEED **********************************************************
			//******************************************************************************************************************
			
				$posts = DB::connection("public")->select(DB::raw("select pt.*,p.id as person, p.name_first, u.photo from app.posts as pt inner join public.person as p on pt.person in (select id_following from app.follow where id_follower =".$pid.")  and p.id = pt.person inner join app.users as u on u.person_id = pt.person order by pt.create_at desc"));	

			//************************************ [FIM] Recupera os post do FEED **********************************************************
			//******************************************************************************************************************

			
			
			$f = new Fonts;
			$f = Fonts::where('valued', '=', false)->get();
			
			//dd($f);
			
			$fontes = DB::connection("public")->select(DB::raw("select c.id, c.thumburl, c.url_online, c.title, c.description from public.content as c where c.font = false"));
			
			$sid = Confide::user()->person->id;
			$aux = array();
			$teste = false;
			$teste2 = true;
			$c = 1;
			
			//$fontes = DB::connection("public")->select(DB::raw("select c.thumburl, c.url_online, c.title, c.description from public.content as c where c.font = false"));
			
			for($i =0; $i < count($fontes); $i++){
				
				$teste = false;
				$teste2 = true;
				
				$rest = substr($fontes[$i]->url_online, 0,6);

				
				if(strcmp('http:/', $rest) != 0){	
				
					$temp = substr($fontes[$i]->url_online, 8-strlen($fontes[$i]->url_online));
					$fonte = strstr($temp, '/', true);
					
					
					for($h = 0; $h < count($f); $h++){
						$t = "https://".$fonte;
						
						if(strcmp($t, $f[$h]->url_fonts) == 0){
							
							$teste2 = false;
							//
						}
						
					}
					
					if($teste2){
						
						// Caso a fonte ja tenha sido aprovada anteiromente 
						DB::connection("public")->table('content')->where('id', '=', $fontes[$i]->id)->update(['font' => true]);
						unset($fontes[$i]);
						
					} else {
					
						//Caso comece com https
						if(count($aux) == 0){
						
							$aux[0][0] = $fonte;
							$aux[0][1] = $fonte;
							$aux[0][2] = $fontes[$i]->thumburl;
							$aux[0][3] = 1;
							$aux[0][4] = $fontes[$i]->url_online;
							
						} else {
						
							
							for($j = 0; $j < $c; $j++){
							
								if(strcmp($fonte, $aux[$j][0]) == 0){
									$teste = true;	
									$aux[$j][3]++;								
									
								}

							}
							
							
							if(!$teste){
								
								$aux[$c][0] = $fonte;
								$aux[$c][1] = $fonte;
								$aux[$c][2] = $fontes[$i]->thumburl;
								$aux[$c][3] = 1;
								$aux[$c][4] = $fontes[$i]->url_online;
								$c++;
								
							}
						}
					}
					
				} else {
					
					$temp = substr($fontes[$i]->url_online, 7-strlen($fontes[$i]->url_online));
					$fonte = strstr($temp, '/', true);
					
					
					
					for($h = 0; $h < count($f); $h++){
						$t = "http://".$fonte;
						
						if(strcmp($t, $f[$h]->url_fonts) == 0){
							
							$teste2 = false;
						}
						
					}
					
					
					
					
					if($teste2){
						//
						// Caso a fonte ja tenha sido aprovada anteiromente 
						
						DB::connection("public")->table('content')->where('id', '=', $fontes[$i]->id)->update(['font' => true]);
						unset($fontes[$i]);

					} else {
					
					
						//Caso comece com http
						
						if(count($aux) == 0){
						
							
							$aux[0][0] = $fonte;
							$aux[0][1] = $fonte;
							$aux[0][2] = $fontes[$i]->thumburl;
							$aux[0][3] = 1;
							$aux[0][4] = $fontes[$i]->url_online;
							
						} else {
						
												
							for($j = 0; $j < $c; $j++){
							
								if(strcmp($fonte, $aux[$j][0]) == 0){
									$teste = true;	
									$aux[$j][3]++;
									
								}
								
							}
							
							
							if(!$teste){
								
								
								$aux[$c][0] = $fonte;
								$aux[$c][1] = $fonte;
								$aux[$c][2] = $fontes[$i]->thumburl;
								$aux[$c][3] = 1;
								$aux[$c][4] = $fontes[$i]->url_online;
								$c++;
								
							}
						}

					}
					
				}				
			}
			
			
			//dd($aux);
			for($i = 0; $i < $c; $i++){
				//$f = new Fonts;
				//$fid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));
				
				$rest = substr($aux[$i][4], 0,6);
				if(strcmp('http:/', $rest) != 0){
					
					/*
					$f->id = $fid[0]->nextval;
					$f->url_fonts = "https://".$aux[$i][0];
					$f->valued = false;
					$f->save();
					*/
					
					$aux[$i][0] = strtolower(urlencode("https://".$aux[$i][0]));
					
				} else {
					
					/*
					$f->id = $fid[0]->nextval;
					$f->url_fonts = "http://".$aux[$i][0];
					$f->valued = false;
					$f->save();
					*/
					$aux[$i][0] = strtolower(urlencode("http://".$aux[$i][0]));
					
				}
			}
			
			
			// verifica se encontra youtube no texto
			for($i =0; $i < count($posts); $i++){
				
				$pos = strripos($posts[$i]->texto, "youtube.com");
				
				
				
				if(!($pos === false)){
					
					// Encontrou
					
					$pos  = strripos($posts[$i]->texto, "?v=");
					$temp = substr($posts[$i]->texto, $pos);
					// retorna ?v=IdVideo[...]
					
					
					// Decobre se existe um espaço depois do IdVideo
					$pos  = strpos($temp, ' ');
					
					$pos  = strripos($posts[$i]->texto, "=");
					$temp = substr($posts[$i]->texto, $pos+1);
					
					$vid = "";
					
					if($pos >= 0){
						
						// Significa que o link do youtube não está no final da string [...] https://www.youtube.com/?v=IdVideo [...]
						
					
						for($j = 0; $j < strlen($temp);$j++){
						
							if(strcmp($temp[$j], ' ') == 0){
								break;							
							} else {
								$vid .= $temp[$j];								
							}

						}
						
						
						
						
					} else {
						
						// Link é a última coisa do texto.
						
						for($i = 0; $i < strlen($temp);$i++){

								$vid .= $temp[$i];								

						}
						
						
					}
					
					// ************************* codigo para tentar mesclar array *************************************************
						$data = VideoApi::setType('youtube')->getVideoDetail($vid);
						
						//dd($data);
						//print_r($posts[0]);
						
						for($j = 0; $j < count($posts);$j++){
							
							if($j == $i){
								
								$posts[$i] = (object) ["id" => $posts[$j]->id, "person" => $posts[$j]->person, "texto" => $posts[$j]->texto, "imagem" => $posts[$j]->imagem, "create_at" => $posts[$j]->create_at, "name_first" => $posts[$j]->name_first, "photo" => $posts[$j]->photo, "photo" => $posts[$j]->photo, "vid" => $data["id"], "title" => $data["title"], "description" => $data["description"], "thumburl" => $data["thumbnail_small"]];
							
							}
						}
						
					
					// **************************************************************************
					
					
				} 
				
				
				
			}
			
			
			return View::make('/supervisor/home', compact('relates', 'message', 'aux', 'c', 'contents', 'posts', 'pid'));

			
		} else {
			
			// Quando usuario
			
			$pid = Confide::user()->person->id;
			$rcs = Recommendation::where('id_person','=',$pid)->where('visited', '=', false)->lists('id_content');

			
			if ($rcs){
				
				$c = Content::whereIn('id',$rcs)->where('subtype','=','2')->take(3)->get();
				$c2 = Content::whereIn('id',$rcs)->where('subtype','=','3')->take(3)->get();
			}
		
		//************************************ Recupera os conteudos do FEED **********************************************************
		//******************************************************************************************************************
		
			$contents = DB::connection("public")->select(DB::raw("select c.*, rpc.id_person, p.name_first, u.photo from public.relatepersoncontent as rpc inner join public.content as c on (rpc.id_content = c.id) and rpc.id_person in (select id_following from app.follow where id_follower =".$pid.") inner join public.person as p on p.id = rpc.id_person inner join app.users as u on u.person_id = p.id"));	
			
		//************************************ [FIM] Recupera os cpnteudos do FEED **********************************************************
		//******************************************************************************************************************
		
			
		
		//************************************ Recupera os post do FEED **********************************************************
		//******************************************************************************************************************
		
			$posts = DB::connection("public")->select(DB::raw("select pt.*, p.id as person, p.name_first, u.photo from app.posts as pt inner join public.person as p on pt.person in (select id_following from app.follow where id_follower =".$pid.")  and p.id = pt.person inner join app.users as u on u.person_id = pt.person order by pt.create_at desc"));	

		//************************************ [FIM] Recupera os post do FEED **********************************************************
		//******************************************************************************************************************
		
			
		
			// verifica se encontra youtube no texto
			for($i =0; $i < count($posts); $i++){
				
				$pos = strripos($posts[$i]->texto, "youtube.com");
				
				if(!($pos === false)){
					
					// Encontrou
					
					$pos  = strripos($posts[$i]->texto, "?v=");
					$temp = substr($posts[$i]->texto, $pos);
					// retorna ?v=IdVideo[...]
					
					
					// Decobre se existe um espaço depois do IdVideo
					$pos  = strpos($temp, ' ');
					
					$pos  = strripos($posts[$i]->texto, "=");
					$temp = substr($posts[$i]->texto, $pos+1);
					
					$vid = "";
					
					if($pos >= 0){
						
						// Significa que o link do youtube não está no final da string [...] https://www.youtube.com/?v=IdVideo [...]
						
					
						for($j = 0; $j < strlen($temp);$j++){
						
							if(strcmp($temp[$j], ' ') == 0){
								break;							
							} else {
								$vid .= $temp[$j];								
							}

						}
						
						
						
						
					} else {
						
						// Link é a última coisa do texto.
						
						for($i = 0; $i < strlen($temp);$i++){

								$vid .= $temp[$i];								

						}
						
						
					}
					
					// ************************* codigo para tentar mesclar array *************************************************
						$data = VideoApi::setType('youtube')->getVideoDetail($vid);
						$aux = array();
						
						//dd($data);
						//print_r($posts[0]);
						
						for($j = 0; $j < count($posts);$j++){
							
							if($j == $i){
								
								$posts[$i] = (object) ["id" => $posts[$j]->id, "person" => $posts[$j]->person, "texto" => $posts[$j]->texto, "imagem" => $posts[$j]->imagem, "create_at" => $posts[$j]->create_at, "name_first" => $posts[$j]->name_first, "photo" => $posts[$j]->photo, "photo" => $posts[$j]->photo, "vid" => $data["id"], "title" => $data["title"], "description" => $data["description"], "thumburl" => $data["thumbnail_small"]];
							
							}
						}
						
					
					// **************************************************************************
					
					
				} 
				
				
				
			}
	
			//echo "<br >".$posts[0]->id."<br >";
		
			//dd($posts);
		
			//dd($contents);
		
			$title = "Feed";			
			return View::make('home',compact('c', 'c2', 'message', 'title', 'contents', 'posts', 'pid'));
		}
	}

    public function getSearch() {

	    $show_search = true;
	    $title = "Youtube Search";
		
	    return View::make('search-video', compact('show_search','title') );
    }

	public function getSearchVideo() {

		$show_search = true;

		$input = Input::all();
		$title = "Youtube Search";

		$q = urlencode($input["search"]);
		$q = urldecode($q);

		$data = @file_get_contents(str_replace(' ', '+', 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&q='.$q.'&type=video&key=AIzaSyDkQhl_qAJt8WHDOJpbMLumgCbxdlnVVPE'));
		
		
		$data = json_decode($data);
		$videos = $data->items;
		
		
		$x = 0;
		$y = 0;
		$z = 0;
		$w = 0;
		$r = array();
	
		
	
		foreach($videos as $c){	
			foreach($c as $d){
				
					
				
					if($x == 2){	
					
						$r[$w]["videoId"] = $d->videoId;
						
					}
					if($x == 3){
						foreach($d as $e){
							
							if($y == 4){
								foreach($e as $g){
									if($z == 0){
										$r[$w]["thumbnailDefautlUrl"] = $g->url;
									}
									$z++;
								}
								$z = 0;
							}
							$y++;
						}
						$r[$w]["title"] = $d->title;
						$r[$w]["description"] = $d->description;
					}
				$x++;
				$y =0;
			}
			$w++;
			$x = 0;	
		}

		return View::make('search-video')->with(array('show_search' => $show_search, 'r' => $r, 'q' => $q, 'title' => $title, 'w' => $w));

	}

	public function getSearchWeb() {

		$show_search = true;
		$title = "Web Search";

		$input = Input::all();

		$q = urlencode($input["search"]);

		$q = urldecode($q);

		return View::make('search-web', compact('show_search','q','title') );

	}

	public function getVideo($id, $from) {
		
		$data = VideoApi::setType('youtube')->getVideoDetail($id);
		$pid = Confide::user()->person->id;
		$cid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));

		if($from == -2){
			
			
			
			
			return View::make('video-search', compact("id","data"));
			
		}
		// Criar o conteúdo, caso não exista
		$c = Content::where('url_online','=',AppController::BASE_YOUTUBE_URL . $data["id"])->count();

		if (empty($c)) {
			
			$frequenci_id = DB::connection("public")->select(DB::raw("insert into frequency values(nextval('frequency_id_seq'), '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0', '0,0,0,0,0,0,0')"));
			$file_id = DB::connection("public")->select(DB::raw("insert into file values (nextval('file_id_seq'), 0, null, null, 0,0,0,0,0)"));
			
			
			
			$content                    = new Content;
			$content->id                = $cid[0]->nextval;
			$content->p1				= 0;
			$content->p2				= 0;
			$content->p3				= 0;
			$content->ss1				= 0;
			$content->ss1				= 0;
			$content->acceptancerate	= 0;
			$content->bytes_online		= 0;
			$content->author            = $data["uploader"];
			$content->averagerating     = $data["like_count"];
			$content->date_add          = Carbon\Carbon::now();
			$content->date_creation     = $data["upload_date"];
			$content->description       = $data["description"];
			$content->rate_acceptance	= 0;
			$content->rate_colab_ponder	= 0;
			$content->rating			= 0;
			$content->seconds_online    = $data["duration"];
			$content->subtype           = AppController::VIDEO;
			$content->title             = $data["title"];
			$content->type				= 0;
			$content->url_online        = AppController::BASE_YOUTUBE_URL . $data["id"];
			$content->visibility        = $data["view_count"];
			$content->visibility_group 	= 0;
			$content->local_views       = 1;
			$content->local_likes       = 0;
			$content->thumburl          = $data["thumbnail_small"];
			$content->vid               = $data["id"];
			$content->font 			= false;
			
			
			
			$content->save();
			
			
			
			$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
			$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
			
		} else {
			
			
			
			$rc = new Recommendation;
			$con = Content::where('vid', '=', $data["id"])->get();
			
			$rc = Recommendation::where('id_person', '=', $pid)->where('id_content', '=', $con[0]->id)->get();
			
			if(empty($rc)){
		
				$rc[0]->visited = true;
				$rc[0]->save();
				
				
			}
			
			
			
			$content = Content::where('url_online','=',AppController::BASE_YOUTUBE_URL . $data["id"])->first();

			$content->local_views+= 1;

			if ($content->local_likes)
				$content->acceptancerate = $content->local_likes / $content->local_views;
			else
				$content->acceptancerate = 0;
			
			$content->save();
		}
		
		// Gerar uma nova visualização (relatepersoncontent)
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$content->id." and liked <> 2 and person_from=".$from));
		
		
		if(empty($v)){
			
			$vid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
			$vid = $vid[0]->nextval;
			
			$v                  = new Relatepersoncontent;
			$v->id              = $vid;
			$v->date_relation    = \Carbon\Carbon::now();
			$v->id_content      = $content->id;
			$v->id_person       = Confide::user()->person->id;
			$v->liked           = 0;
			$v->person_from		= $from;
			$v->save();
			
		} else {
			
			$v[0]->liked = 1;
			
			
		}
		
		$idcontent = $content->id;
		return View::make('video', compact("id","data", 'idcontent', 'from'));

	}

	public function getSocial() {
		$title = "Social";
		return View::make('social',compact('title'));
	}

	public function getFriendship() {
		$pid = Confide::user()->person_id;
		$title      = "Friendship";
		$f_ids    = Follow::where('id_follower','=',Confide::user()->person_id)->lists('id_following');
		$followers = DB::connection("public")->select(DB::raw("select  p.id, p.name_first, p.name_last, u.photo, u.gender from app.users as u inner join public.person as p on u.person_id in (select id_following from app.follow where id_follower = ".$pid.") and u.person_id = p.id"));
		/*
		if (!empty($f_ids))
			$followers  = Person::whereIn('id',$f_ids)->get();
		else
			$followers = array();

		$pessoas = Person::orderBy('name_first')->get();
		*/
		return View::make('friendship',compact('title','followers'));

	}

	public function getFollow($fpersonid) {

		$me = Confide::user()->person_id;

		$f = new Follow;
		$f->id_follower     = $me;
		$f->id_following    = $fpersonid;
		$f->save();
		
		$f = new Follow;
		$f->id_follower     = $fpersonid;
		$f->id_following    = $me;
		$f->save();
		
		DB::connection("public")->select(DB::raw("delete from app.possiblefriends where friendto=".$me . " and possiblefriend=" .$fpersonid));

		return Redirect::to('app/friendship');

	}

	public function postMessageto() {

		$fpersonid = Input::segment(3);

		$message = Input::get('message');

		$me = Confide::user()->person_id;

		$m = new Message;
		$m->id_person_from  = $me;
		$m->id_person_to    = $fpersonid;
		$m->message         = $message;
		$m->viewed          = false;
		$m->save();


		return Redirect::to('app/viewmessage?id_person_from='.$fpersonid);
	
	}
		
	public function postMessageto2() {

		//$fpersonid = Input::segment(3);
		$fpersonid = $_GET['id'];

		$message = Input::get('message');

		
		$me = Confide::user()->person_id;

		if(empty($message)){
			
		} else {
			$m = new Message;
			$m->id_person_from  = $me;
			$m->id_person_to    = $fpersonid;
			$m->message         = $message;
			$m->viewed          = false;
			$m->save();
		}
		return Redirect::to('app/viewmessage?id_person_from='.$fpersonid);

	}
	
    public function getInbox() {
	    $title = "Inbox";

	    $pid = Confide::user()->person->id;

		$msgs = DB::connection("public")->select(DB::raw("select id_person_from, p.name_first, id_person_to, message from app.message m, public.person p where (m.id_person_from = p.id and m.id_person_to =".$pid .") or (m.id_person_from =".$pid." and m.id_person_to =p.id ) order by m.id_person_from, m.created_at desc"));
		
		$m = array();
		$ids = array();
		$userName = "";
		$i = 0;
		$j = 0;

		foreach($msgs as $a){
			
			if($i == 0 and $j == 0){
				
				$ids[$i] = $a->id_person_from;
				$m[$i][$j] = $a->name_first;
				$m[$i][$j+1] = $a->message;
				$userName = $a->name_first;
				$j+=2;
				
			} else {
				if(!strcmp($userName, $a->name_first)){
					
					$m[$i][$j] = $a->message;
					$j++;
				} else {					
					$i++;
					$j=0;
					$ids[$i] = $a->id_person_from;
					$m[$i][$j] = $a->name_first;
					$m[$i][$j+1] = $a->message;
					$j+= 2;
					$userName = $a->name_first;
				}
			}			
		}
		
	    return View::make('inbox',compact('title','m', 'i', 'pid', 'ids'));

    }

    public function getPhr(){
	    $title = "My Health";
	    return View::make('phr',compact('title'));
    }

	public function getFeeds() {

		$f = FeedReader::read('http://www.acessemed.com.br/v1/feed/');

		echo "Titulo: ". $f->get_title() . "<br>";
		echo "Link: ". var_dump($f->get_links()) . "<br>";

		foreach ($f->get_items() as $i) {
			echo "Item id: ". $i->get_id() . "<br>";

		}
	}
	
	public function getViewmessage(){

		$pid = Confide::user()->person->id;
		$id_person_from = $_GET['id_person_from'];
		$name = DB::connection("public")->select(DB::raw("select p.name_first, p.name_last from public.person p where (p.id =".$id_person_from.")"));
		$photo = DB::connection("app")->select(DB::raw("select u.photo from app.users u where u.person_id =".$id_person_from));
		$m = DB::connection("app")->select(DB::raw("select distinct p.name_first, p.name_last, m.id, m.message, m.id_person_from, m.created_at from public.person p, app.message m, app.users u  where ((m.id_person_to =".$pid.") and (m.id_person_from =".$id_person_from.") and (p.id =".$id_person_from.")) or ((m.id_person_to =".$id_person_from.") and (m.id_person_from =".$pid.") and (p.id =".$pid.")) order by m.created_at desc limit 20"));
		$a = DB::connection("app")->select(DB::raw("update app.message set viewed = true  where id_person_to =". $pid ." and id_person_from =".$id_person_from));
		
		$message = array();
		$i = 0;
		
		if(count($m) > 0){
			
			$tamanho = count($m);
			
			foreach($m as $b){
				
				$message[$i]['message'] = $b->message;
				$message[$i]['id_person_from'] = $b->id_person_from;
				$i++;
				
				
			}
		}
		
		$n = $name[0]->name_first." ".$name[0]->name_last;
		$photo = $photo[0]->photo;
		
		return View::make('viewmessage',compact('message', 'id_person_from', 'tamanho','photo', 'n'));
		

	}

	public function getFindfirends(){
		
		$pid = Confide::user()->person_id;
		$title      = "Encontre Novos Amigos";
		$f_ids    = Follow::where('id_follower','=',Confide::user()->person_id)->lists('id_following');
		$findfriends = DB::connection("public")->select(DB::raw("select  p.id, p.name_first, p.name_last, u.photo, u.gender from app.users as u inner join public.person as p on u.person_id <> ".$pid." and u.person_id not in (select id_following from app.follow where id_follower = ".$pid.") and u.person_id = p.id"));
		
		return View::make('findfriends',compact('title','findfriends'));
		
		
	}
	
	public function getLike($id, $from) {

		$pid = Confide::user()->person->id;
	
		/* 
			
			******** MÉTODO APENAS PARA VIDEOS,PARA COMTEÚDOS HÁ O METODO getLikec($id, $from)
		
			Não é necessário fazar a verificação para saber se a relação existe,
		pois os videos são redirecionados para a pagina de visualização atravez do metodo getVideo($id, $from).
		Lá eu verifica se há a relação, se não existir eu crio a relação e se exitir não faz nada
		
		*/
		
		if($from == -2){
			
			/*
				$from > 0 -> Vindo de usurários
				$from == -1 -> Vem de uma recomendação do mobilehealth
				$from == -2 -> vem de uma pesquisa, seja video ou web
			
			*/
			
			$data = VideoApi::setType('youtube')->getVideoDetail($id);
			$pid = Confide::user()->person->id;
			$cid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));
			
			// Criar o conteúdo, caso não exista
			
			$c = Content::where('url_online','=',AppController::BASE_YOUTUBE_URL . $data["id"])->count();
			
			if (empty($c)) {
			
				$frequenci_id = DB::connection("public")->select(DB::raw("insert into frequency values(nextval('frequency_id_seq'), '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0', '0,0,0,0,0,0,0')"));
				$file_id = DB::connection("public")->select(DB::raw("insert into file values (nextval('file_id_seq'), 0, null, null, 0,0,0,0,0)"));
				
				
				
				$content                    = new Content;
				$content->id                = $cid[0]->nextval;
				$content->p1				= 0;
				$content->p2				= 0;
				$content->p3				= 0;
				$content->ss1				= 0;
				$content->ss1				= 0;
				$content->acceptancerate	= 0;
				$content->bytes_online		= 0;
				$content->author            = $data["uploader"];
				$content->averagerating     = $data["like_count"];
				$content->date_add          = Carbon\Carbon::now();
				$content->date_creation     = $data["upload_date"];
				$content->description       = $data["description"];
				$content->rate_acceptance	= 0;
				$content->rate_colab_ponder	= 0;
				$content->rating			= 0;
				$content->seconds_online    = $data["duration"];
				$content->subtype           = AppController::VIDEO;
				$content->title             = $data["title"];
				$content->type				= 0;
				$content->url_online        = AppController::BASE_YOUTUBE_URL . $data["id"];
				$content->visibility        = $data["view_count"];
				$content->visibility_group 	= 0;
				$content->local_views       = 1;
				$content->local_likes       = 1;
				$content->thumburl          = $data["thumbnail_small"];
				$content->vid               = $data["id"];
				$content->font 			= false;
				
				
				
				$content->save();
				
				
				
				$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
				$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
				
				
				$this->atualizaFreuqnciaPositiva($pid, $content->id);
				
				
				if(!($this->existePost($content->vid))){
					
					//Será tratado como um post (necessario para a função de comentarios, pois comentarios so funcionam para posts)
					$id = "https://www.youtube.com/watch?v=".$content->vid;
					$create_at = \Carbon\Carbon::now();
					DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$pid.", '".$id."',' ', '".$create_at."')"));
					
				}	
				
				
			}

			
			
			
			
			
		} else {
		
		
			//$v = Relatepersoncontent::find($id);
			
			
			// Gerar uma nova visualização (relatepersoncontent)
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id." and liked <> 2 and person_from=".$from));
			$v = $v[0];
			
			if ($v->liked <= 0) {
				
				$v = Relatepersoncontent::find($v->id);
				
				$v->liked = 1;
				$v->save();

				$c = Content::find($v->id_content);
				$c->local_likes += 1;
				$c->acceptancerate = $c->local_likes / $c->local_views;
				$c->save();
				
				$this->atualizaFreuqnciaPositiva($pid, $id);
				
				if(!($this->existePost($c->vid))){
					
					//Será tratado como um post (necessario para a função de comentarios, pois comentarios so funcionam para posts)
					$id = "https://www.youtube.com/watch?v=".$c->vid;
					$create_at = \Carbon\Carbon::now();
					DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$pid.", '".$id."',' ', '".$create_at."')"));
					
				}	
				
				
			}
			
			

			
			
		}
		
		
		
		

	}

	public function existePost($id){
		echo "Chamou o metodo";
		// Criar o conteúdo, caso não exista
		$id = "https://www.youtube.com/watch?v=".$id;
		
		$posts = DB::connection("public")->select(DB::raw("select count(*) from app.posts where person = ".Confide::user()->person->id." and texto = '" .$id."'"));
		
		if(empty($posts)){
			echo "aqui";
			return true;
		}
		echo "aqui2";
		return false;
	}
	
	public function getUnlike($id, $from) {

	
	
		/* 
			
			******** MÉTODO APENAS PARA VIDEOS,PARA COMTEÚDOS HÁ O METODO getUnlikec($id, $from)
		
			Não é necessário fazar a verificação para saber se a relação existe,
		pois os videos são redirecionados para a pagina de visualização atravez do metodo getVideo($id, $from).
		Lá eu verifica se há a relação, se não existir eu crio a relação e exitir não faz nada
		
		*/
	
	
		$pid = Confide::user()->person->id;
		
		// Gerar uma nova visualização (relatepersoncontent)
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id." and liked <> 2 and person_from=".$from));
		$v = $v[0];
		if ($v->liked >= 0) {
			
			$v = Relatepersoncontent::find($v->id);
			
			$v->liked = -1;
			$v->save();

			$c = Content::find($v->id_content);
			$c->local_likes -= 1;
			$c->acceptancerate = $c->local_likes / $c->local_views;
			$c->save();
			$this->atualizaFreuqnciaNegativa($pid, $id);
		}

	}

	public function getLikec() {
		
		$pid = Confide::user()->person->id;
		$id_content = $_GET['id'];
		
		//dd($id_content);
		
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));
		
		if(empty($v)){
			
			// Cria uma relação com o conteúdo
			$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
		
			$c = new Relatepersoncontent;
			$c->id				= $rpcid[0]->nextval;
			$c->date_relation   = \Carbon\Carbon::now();
			$c->id_content      = $id_content;
			$c->id_person       = $pid;
			$c->liked           = 1;
			$c->person_from			= $_GET['from'];
			$c->save();
			
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));
			$v = $v[0]->liked;
			
			$this->atualizaFreuqnciaPositiva($pid, $id_content);
			
			
			// Verifica se o contéudo compartilhado é um video
			$c = Content::find($id_content);
			
			
			
			if(Empty($c->thumburl)){
				
				// Não é vídeo
				
				if(!($this->existePost($id_content))){
					//Será tratado como um post (necessario para a função de comentarios, pois comentarios so funcionam para posts)
					$create_at = \Carbon\Carbon::now();
					DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$pid.", '".$c->url_online."',' ', '".$create_at."')"));
				}
				
			} else {
				
				$id = "https://www.youtube.com/watch?v=".$c->vid;
				
				
				
				// É vídeo
				if(!($this->existePost($id))){
					//Será tratado como um post (necessario para a função de comentarios, pois comentarios so funcionam para posts)
					
					$create_at = \Carbon\Carbon::now();
					DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$pid.", '".$id."',' ', '".$create_at."')"));
				}
				
			}
			

			
			
			
			
		} else {
			
			$v = $v[0]->liked;
			$this->atualizaFreuqnciaPositiva($pid, $id_content);

		}
		
		
		
		if ($v == 0 || $v == -1) {
			
			
			
			$v = 1;
			$u = DB::connection("public")->select(DB::raw("update relatepersoncontent set liked =".$v." where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));

			$c = Content::find($id_content);
			$c->local_likes += 1;
			
			if($c->local_views == 0){
				
				$c->acceptancerate = 0;
				
			} else {
				
				$c->acceptancerate = $c->local_likes / $c->local_views;
				
			}

			$c->save();

		}
		
		
		
	
		return Redirect::to('/');
	
		
	}

	public function getUnlikec() {

		$pid = Confide::user()->person->id;
		$id_content = $_GET['id'];
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2  and person_from=".$_GET['from']));
		
		if(empty($v)){
			
			$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
		
			$c = new Relatepersoncontent;
			$c->id				= $rpcid[0]->nextval;
			$c->date_relation   = \Carbon\Carbon::now();
			$c->id_content      = $id_content;
			$c->id_person       = $pid;
			$c->liked           = 0;
			$c->person_from			=$_GET['from'];
			$c->save();
			
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));
			$v = $v[0]->liked;
			
			$this->atualizaFreuqnciaNegativa($pid, $id_content);

		} else {
			
			$v = $v[0]->liked;
			$this->atualizaFreuqnciaNegativa($pid, $id_content);

		
		}
		
	
		if ($v == 0 || $v == 1) {
			$v = -1;
			$u = DB::connection("public")->select(DB::raw("update relatepersoncontent set liked=".$v." where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));

			$c = Content::find($id_content);
			$c->local_likes -= 1;
			
			if($c->local_views == 0){
				
				$c->acceptancerate = 0;
				
			} else {
				
				$c->acceptancerate = $c->local_likes / $c->local_views;
				
			}
			
			$c->save();
			
			$this->atualizaFreuqnciaNegativa($pid, $id_content);
			
		}
		

		return Redirect::to('/');

	}	
	
	public function getLikep() {
		
		$pid = Confide::user()->person->id;
		$id_post = $_GET['id'];
		
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersonpost where id_person = ".$pid." and id_post = ".$id_post." and liked <> 2 and person_from=".$_GET['from']));
		
		if(empty($v)){
			
			$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relatepersonpost_id_seq')"));
		
			$c = new Relatepersonpost;
			$c->id				= $rpcid[0]->nextval;
			$c->date_relation   = \Carbon\Carbon::now();
			$c->id_post      = $id_post;
			$c->id_person       = $pid;
			$c->liked           = 1;
			$c->person_from			= $_GET['from'];
			$c->save();
			  
			
		} else {
			
			$v = $v[0]->liked;
			
		}
		
		if ($v == 0 || $v == -1) {
			$v = 1;
			$u = DB::connection("public")->select(DB::raw("update relatepersonpost set liked =".$v." where id_person = ".$pid." and id_post = ".$id_post." and liked <> 2 and person_from=".$_GET['from']));

		}
	
		return Redirect::to('/');
	
		
	}

	public function getUnlikep() {

		$pid = Confide::user()->person->id;
		$id_post = $_GET['id'];
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersonpost where id_person = ".$pid." and id_post = ".$id_post." and liked <> 2  and person_from=".$_GET['from']));
		
		if(empty($v)){
			
			$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relatepersonpost_id_seq')"));
		
			$c = new Relatepersonpost;
			$c->id				= $rpcid[0]->nextval;
			$c->date_relation   = \Carbon\Carbon::now();
			$c->id_post      = $id_post;
			$c->id_person       = $pid;
			$c->liked           = 0;
			$c->person_from			=$_GET['from'];
			$c->save();
			
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersonpost where id_person = ".$pid." and id_post = ".$id_post." and liked <> 2 and person_from=".$_GET['from']));
			$v = $v[0]->liked;

		} else {
			
			$v = $v[0]->liked;
		
		}
		
	
		if ($v == 0 || $v == 1) {
			$v = -1;
			$u = DB::connection("public")->select(DB::raw("update relatepersonpost set liked=".$v." where id_person = ".$pid." and id_post = ".$id_post." and liked <> 2 and person_from=".$_GET['from']));
		}
		
		return Redirect::to('/');

	}
	
	public function getCompp() {
		
		$pid = Confide::user()->person->id;
		$id_post = $_GET['id_post'];
		
		
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersonpost where id_person = ".$pid." and id_post = ".$id_post." and liked = 2 and person_from =".$_GET['from'] ));

			
			if(empty($v)){
				
				$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relatepersonpost_id_seq')"));
			
				$c = new Relatepersonpost;
				$c->id				= $rpcid[0]->nextval;
				$c->date_relation   = \Carbon\Carbon::now();
				$c->id_post      = $id_post;
				$c->id_person       = $pid;
				$c->liked           = 2;
				$c->person_from		= $_GET['from'];
				$c->save();
				
			}		
		
		 

	}
	
	public function getComp() {
		
		$pid = Confide::user()->person->id;
		$id_content = $_GET['id_content'];
		
		
			$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked = 2 and person_from =".$_GET['from'] ));

			
			if(empty($v)){
				
				$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
			
				$c = new Relatepersoncontent;
				$c->id				= $rpcid[0]->nextval;
				$c->date_relation   = \Carbon\Carbon::now();
				$c->id_content      = $id_content;
				$c->id_person       = $pid;
				$c->liked           = 2;
				$c->person_from		= $_GET['from'];
				$c->save();
				
				
				
			}		
		
		 

	}
	
	// Redireciona para a página da url recebida am 'a'
	public function getUrl(){
		
		$a = $_GET['a'];
		
		$con = new Content;
		$rc = new Recommendation;
		$pid = Confide::user()->person->id;
		
		
		$con = Content::where('url_online', 'like', $a)->get();
		
		$rc = Recommendation::where('id_person', '=', $pid)
							->where('id_content', '=', $con[0]->id)->get();
		
		$rc = $rc[0];
		$rc->visited = true;
		$rc->save();
		
		$rpcid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));
		
		$c = new Relatepersoncontent;
		$c->id				= $rpcid[0]->nextval;
		$c->date_relation   = \Carbon\Carbon::now();
		$c->id_content      = $con[0]->id;
		$c->id_person       = $pid;
		$c->liked           = 0;
		$c->save();
		
		$con[0]->local_views     = $con[0]->local_views+1;
		$con[0]->save();

		return Redirect::to($a);
		
		
	}
	
	public function postDesfazeramizade($id){
		
		$me = Confide::user()->person_id;

		$r = DB::connection("public")->select(DB::raw("delete from app.message where (id_person_from = ".$id." and id_person_to=".$me.") or (id_person_from = ".$me." and id_person_to=".$id.")"));
		$r = DB::connection("public")->select(DB::raw("delete from app.follow where id_follower = ".$me." and id_following=".$id));
		
		
		return Redirect::to('app/friendship');
		
		
	}
		
	public function postPublicacao(){
		
		$me = Confide::user()->person_id;
		$input = Input::all();
		$img = " ";
		$create_at = \Carbon\Carbon::now();
		
		if(Input::hasFile('imagem')){
			
			$imagem = Input::file('imagem');	
			$extensao = $imagem->getClientMimeType();
			
			if($extensao != 'image/jpeg' && $extensao != 'image/png'){
				
				$megERRO = "Extensões de imgens validos: .jpeg e .png";
				
			} else {
				
				
				Input::file('imagem')->move(public_path()."/imgs/", $imagem);
				$img= $imagem->getFilename();
				//DB::connection("app")->select(DB::raw("update users set photo='".$imagem->getFilename()."' where person_id=".$pid));
				DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$me.", '".$input['texto']."', '".$img."', '".$create_at."')"));
				
				
			}
			
			
			return View::make('home', compact("megERRO"));
			
		} else {
			
			DB::connection("app")->select(DB::raw("insert into app.posts values (nextval('app.posts_id_seq'),".$me.", '".$input['texto']."', '".$img."', '".$create_at."')"));
			return Redirect::to("/");
		}
		
		
		
		
	}
		
	public function diaSemana($diaSemana){
		
		if(strcmp($diaSemana, "Monday") == 0){
			return 0;
		} else if(strcmp($diaSemana, "Tuesday") == 0){
			return 1;
		} else if(strcmp($diaSemana, "Wednesday") == 0){
			return 2;
		} else if(strcmp($diaSemana, "Thursday") == 0){
			return 3;
		} else if(strcmp($diaSemana, "Friday") == 0){
			return 4;
		} else if(strcmp($diaSemana, "Saturday") == 0){
			return 5;
		} else {
			return 6;
		}
		
		
	}
	
	public function atualizaFreuqnciaPositiva($pid, $id_content){
		
		
		
		
		// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
		date_default_timezone_set('America/Sao_Paulo');

		// Exibe alguma coisa como: Monday
		$diaSemana = $this->diaSemana(date("l"));
		
		
		
		$hora = date("g");
		$manhaTarde = date("a");
		
		if(strcmp($manhaTarde,"pm") == 0){
			
			// Esta de tarde, então somo mais 12 horas
			$hora += 12;
			
		}
		
		
		// Atualiza frequnecia do usuario
		
		$id_frequency = DB::connection("app")->select(DB::raw("select p.id_frequency from public.person p where p.id =".$pid));
		$f = new Frequency;
		
		
		
		$f = Frequency::where('id', '=', $id_frequency[0]->id_frequency)->get();
		$f = $f[0];

		
		
		$aux = preg_split('/,/', $f->h24_positive, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$hora-1] = $aux[$hora-1]+ 1; 
		
		$f->h24_positive = "";
		for($i = 0; $i < 24; $i++){
			
			$f->h24_positive .= $aux[$i];
			if($i != 23){
				$f->h24_positive .= ",";
			}
		
		}
		
		$aux = preg_split('/,/', $f->h7_positive, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$diaSemana] = $aux[$diaSemana]+ 1; 
		
		$f->h7_positive = "";
		for($i = 0; $i < 7; $i++){
			
			$f->h7_positive .= $aux[$i];
			if($i != 23){
				$f->h7_positive .= ",";
			}
		
		}
		
		$f->save();
		
		
		
		
		
		
		// Atualiza frequnecia do conteudo
		
		$id_frequency = DB::connection("app")->select(DB::raw("select c.id_frequency from public.content c where c.id =".$id_content));
		$f = new Frequency;
		$f = Frequency::where('id', '=', $id_frequency[0]->id_frequency)->get();
		
		$f = $f[0];

		
		$aux = preg_split('/,/', $f->h24_positive, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$hora-1] = $aux[$hora-1]+ 1; 
		
		$f->h24_positive = "";
		for($i = 0; $i < 24; $i++){
			
			$f->h24_positive .= $aux[$i];
			if($i != 23){
				$f->h24_positive .= ",";
			}
		
		}
		
		$aux = preg_split('/,/', $f->h7_positive, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$diaSemana] = $aux[$diaSemana]+ 1; 
		
		$f->h7_positive = "";
		for($i = 0; $i < 7; $i++){
			
			$f->h7_positive .= $aux[$i];
			if($i != 7){
				$f->h7_positive .= ",";
			}
		
		}
		
		$f->save();
		
		
		
		
		
	}
			
	public function atualizaFreuqnciaNegativa($pid, $id_content){
		
		
		// Modifica a zona de tempo a ser utilizada. Disnovível desde o PHP 5.1
		date_default_timezone_set('America/Sao_Paulo');

		// Exibe alguma coisa como: Monday
		$diaSemana = $this->diaSemana(date("l"));
		
		$hora = date("g");
		$manhaTarde = date("a");
		
		if(strcmp($manhaTarde,"pm") == 0){
			
			// Esta de tarde, então somo mais 12 horas
			$hora += 12;
			
		}
		
		// Atualiza frequnecia do usuario
		
		$id_frequency = DB::connection("app")->select(DB::raw("select p.id_frequency from public.person p where p.id =".$pid));
		$f = new Frequency;
		$f = Frequency::where('id', '=', $id_frequency[0]->id_frequency)->get();
		
		$f = $f[0];
 
		$aux = preg_split('/,/', $f->h24_negative, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$hora-1] = $aux[$hora-1]+ 1; 
		
		$f->h24_negative = "";
		for($i = 0; $i < 24; $i++){
			
			$f->h24_negative .= $aux[$i];
			if($i != 23){
				$f->h24_negative .= ",";
			}
		
		}
		
		$aux = preg_split('/,/', $f->h7_negative, -1, PREG_SPLIT_NO_EMPTY);
		
		
		
		$aux[$diaSemana] = $aux[$diaSemana]+ 1; 
		
		$f->h7_negative = "";
		for($i = 0; $i < 7; $i++){
			
			$f->h7_negative .= $aux[$i];
			if($i != 7){
				$f->h7_negative .= ",";
			}
		
		}
		
		$f->save();
		
		
		
		
		
		
		// Atualiza frequnecia do conteudo
		
		$id_frequency = DB::connection("app")->select(DB::raw("select c.id_frequency from public.content c where c.id =".$id_content));
		$f = new Frequency;
		$f = Frequency::where('id', '=', $id_frequency[0]->id_frequency)->get();
		
		$f = $f[0];

		
		$aux = preg_split('/,/', $f->h24_negative, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$hora-1] = $aux[$hora-1]+ 1; 
		
		$f->h24_negative = "";
		for($i = 0; $i < 24; $i++){
			
			$f->h24_negative .= $aux[$i];
			if($i != 23){
				$f->h24_negative .= ",";
			}
		
		}
		
		$aux = preg_split('/,/', $f->h7_negative, -1, PREG_SPLIT_NO_EMPTY);
		$aux[$diaSemana] = $aux[$diaSemana]+ 1; 
		
		$f->h7_negative = "";
		for($i = 0; $i < 7; $i++){
			
			$f->h7_negative .= $aux[$i];
			if($i != 23){
				$f->h7_negative .= ",";
			}
		
		}
		
		$f->save();
		
		
		
		
		
	}
	
	public function getComments($idPost){
	
		//dd($idPost);
		$posts = new Post();
		$posts = DB::connection("public")->select(DB::raw('select pt.*, p.name_first, p.name_last, u.photo from app.posts pt inner join app.users u on pt.id = '.$idPost.' and pt.person = u.person_id inner join public.person as p on p.id = u.person_id'));
		
		//dd($posts);
		//dd($idPost);
	
		// verifica se encontra youtube no texto
		for($i =0; $i < count($posts); $i++){
				
			$pos = strripos($posts[$i]->texto, "youtube.com");
				
			if(!($pos === false)){
					
				// Encontrou
					
				$pos  = strripos($posts[$i]->texto, "?v=");
				$temp = substr($posts[$i]->texto, $pos);
				// retorna ?v=IdVideo[...]
					
					
				// Decobre se existe um espaço depois do IdVideo
				$pos  = strpos($temp, ' ');
					
				$pos  = strripos($posts[$i]->texto, "=");
				$temp = substr($posts[$i]->texto, $pos+1);
					
				$vid = "";
					
				if($pos >= 0){
						
					// Significa que o link do youtube não está no final da string [...] https://www.youtube.com/?v=IdVideo [...]
						
					
					for($j = 0; $j < strlen($temp);$j++){
						
						if(strcmp($temp[$j], ' ') == 0){
							break;							
						} else {
							$vid .= $temp[$j];								
						}

					}
							
				} else {
						
					// Link é a última coisa do texto.
						
					for($i = 0; $i < strlen($temp);$i++){

							$vid .= $temp[$i];								

					}
						
						
				}
					
				// ************************* codigo para tentar mesclar array *************************************************
				$data = VideoApi::setType('youtube')->getVideoDetail($vid);
				$aux = array();
						
					//dd($data);
					//print_r($posts[0]);
						
				for($j = 0; $j < count($posts);$j++){
							
					if($j == $i){
								
						$posts[$i] = (object) ["id" => $posts[$j]->id, "person" => $posts[$j]->person, "texto" => $posts[$j]->texto, "imagem" => $posts[$j]->imagem, "create_at" => $posts[$j]->create_at, "name_first" => $posts[$j]->name_first, "photo" => $posts[$j]->photo, "vid" => $data["id"], "title" => $data["title"], "description" => $data["description"], "thumburl" => $data["thumbnail_small"]];
							
					}
				}
						
					
				// **************************************************************************
					
					
			} 
				
				
				
		}
		
		
		
		$title = $posts[0]->name_first;
		
		$comments = new Comment();

		$comments = DB::connection("public")->select(DB::raw('select com.*, u.photo, p.name_first, p.name_last from app.comments as com inner join app.users as u on u.person_id = com.comment_of and id_post = '.$idPost.' inner join public.person as p on p.id = com.comment_of'));

		//dd($comments);
		
		return View::make('/supervisor/comments',compact('title', 'posts', 'comments'));
		
	}
	
	public function postComments(){
		
		echo Input::get('comment');
		echo "<br >" . Input::get('idPost');

		$comments = new Comment();

		$comments->comment_of = $pid = Confide::user()->person->id;
		$comments->id_post = Input::get('idPost');
		$comments->text = Input::get('comment');

		$comments->save();

		return Redirect::to('app/comments/'.Input::get('idPost'));


	}
	
	
	
	
	}
