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
			$sid = Confide::user()->person->id;
			$aux = array();
			$teste = false;
			$c = 1;
			
			$fontes = DB::connection("public")->select(DB::raw("select c.thumburl, c.url_online, c.title, c.description from public.content as c where c.font = false"));
			
			for($i =0; $i < count($fontes); $i++){
				
				$teste = false;
				
				
				$rest = substr($fontes[$i]->url_online, 0,6);

				if(strcmp('http:/', $rest) != 0){	
				
					$temp = substr($fontes[$i]->url_online, 8-strlen($fontes[$i]->url_online));
					$fonte = strstr($temp, '/', true);
					
					//Caso comece com https
					if(count($aux) == 0){
					
						$aux[0][0] = $fonte;
						$aux[0][1] = $fonte;
						$aux[0][2] = $fontes[$i]->thumburl;
						$aux[0][3] = 1;
						
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
							$c++;
							
						}
					
					}
					
					
				} else {
					
					$temp = substr($fontes[$i]->url_online, 7-strlen($fontes[$i]->url_online));
					$fonte = strstr($temp, '/', true);
					
					//Caso comece com http
					
					if(count($aux) == 0){
					
						
						$aux[0][0] = $fonte;
						$aux[0][1] = $fonte;
						$aux[0][2] = $fontes[$i]->thumburl;
						$aux[0][3] = 1;
						
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
							$c++;
							
						}
					}	
				}				
			}
			
			for($i = 0; $i < $c; $i++){
			
				$rest = substr($aux[$i][0], 0,6);
				if(strcmp('http:/', $rest) != 0){
					$aux[$i][0] = strtolower(urlencode("https://".$aux[$i][0]));
				} else {
					
					$aux[$i][0] = strtolower(urlencode("http://".$aux[$i][0]));
					
				}
			}
			
			return View::make('/supervisor/home', compact('relates', 'message', 'aux', 'c'));
			
		} else {
			
			$pid = Confide::user()->person->id;
			$rcs = Recommendation::where('id_person','=',$pid)->where('visited', '=', false)->lists('id_content');

			
			if ($rcs){
				
				$c = Content::whereIn('id',$rcs)->where('subtype','=','2')->take(3)->get();
				$c2 = Content::whereIn('id',$rcs)->where('subtype','=','3')->take(3)->get();
			}
			

		
		//************************************ Recupera os post do FEED **********************************************************
		//******************************************************************************************************************
		
			$contents = DB::connection("public")->select(DB::raw("select c.*, rpc.id_person, p.name_first, u.photo from public.relatepersoncontent as rpc inner join public.content as c on (rpc.id_content = c.id) and rpc.id_person in (select id_following from app.follow where id_follower =".$pid.") inner join public.person as p on p.id = rpc.id_person inner join app.users as u on u.person_id = p.id"));	
		
		//************************************ [FIM] Recupera os post do FEED **********************************************************
		//******************************************************************************************************************

			$title = "Feed";			
			return View::make('home',compact('c', 'c2', 'message', 'title', 'contents'));
		}
	}

    public function getSearch()
    {

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

	public function getVideo() {

		$id = Input::segment(3);
		$data = VideoApi::setType('youtube')->getVideoDetail($id);

		$cid = DB::connection("public")->select(DB::raw("SELECT nextval('content_seq')"));


		// Criar o conteúdo, caso não exista
		$c = Content::where('url_online','=',AppController::BASE_YOUTUBE_URL . $data["id"])->count();

		if (!$c) {
			
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
			$content->seconds_online    = 0;//$data["duration"];
			$content->subtype           = AppController::VIDEO;
			$content->title             = $data["title"];
			$content->type				= 0;
			$content->url_online        = AppController::BASE_YOUTUBE_URL . $data["id"];
			$content->visibility        = $data["view_count"];
			$content->visibility_group 	= 0;
			$content->local_views       = 1;
			$content->local_likes       = 0;
			$content->acceptancerate    = 0;
			$content->thumburl          = $data["thumbnail_small"];
			$content->vid               = $data["id"];
			
			$content->save();
			
			$frequenci_id = DB::connection("public")->select(DB::raw("update content set id_frequency=(currval('frequency_id_seq')) where id=currval('content_seq')"));
			$file_id = DB::connection("public")->select(DB::raw("update content set id_file=(currval('file_id_seq')) where id=currval('content_seq')"));
			
			
		} else {
			
			$rc = new Recommendation;
			$con = Content::where('vid', '=', $data["id"])->get();
			$pid = Confide::user()->person->id;
			$rc = Recommendation::where('id_person', '=', $pid)
								->where('id_content', '=', $con[0]->id)->get();

								
			$rc = $rc[0];
			$rc->visited = true;
			$rc->save();
			
			$content = Content::where('url_online','=',AppController::BASE_YOUTUBE_URL . $data["id"])->first();
			$content->local_views+= 1;

			if ($content->local_likes)
				$content->acceptancerate = $content->local_likes / $content->local_views;
			else
				$content->acceptancerate = 0;
			
			$content->save();
		}

		// Gerar uma nova visualização (relatepersoncontent)
		$vid = DB::connection("public")->select(DB::raw("SELECT nextval('relate_person_content_seq')"));

		$vid = $vid[0]->nextval;

		$v                  = new Relatepersoncontent;
		$v->id              = $vid;
		$v->date_relation    = \Carbon\Carbon::now();
		$v->id_content      = $content->id;
		$v->id_person       = Confide::user()->person->id;
		$v->liked           = 0;
		$v->save();

		return View::make('video', compact("id","data","vid"));

	}

	public function getLike() {

		$vid = Input::segment(3);
		$v = Relatepersoncontent::find($vid);

		if ($v->liked <= 0) {

			$v->liked = 1;
			$v->from 	=-1;
			$v->save();

			$c = Content::find($v->id_content);
			$c->local_likes += 1;
			$c->acceptancerate = $c->local_likes / $c->local_views;
			$c->save();

		}

	}

	public function getUnlike() {

		$vid = Input::segment(3);

		$v = Relatepersoncontent::find($vid);

		if ($v->liked >= 0) {
			$v->liked = -1;
			$v->from 	=-1;
			$v->save();

			$c = Content::find($v->id_content);
			$c->local_likes -= 1;
			$c->acceptancerate = $c->local_likes / $c->local_views;
			$c->save();
		}

	}


	public function getSocial() {
		$title = "Social";
		return View::make('social',compact('title'));
	}

	public function getFriendship() {
	
		$title      = "Friendship";
		$f_ids    = Follow::where('id_follower','=',Confide::user()->person_id)->lists('id_following');

		if (!empty($f_ids))
			$followers  = Person::whereIn('id',$f_ids)->get();
		else
			$followers = array();

		$pessoas = Person::orderBy('name_first')->get();

		return View::make('friendship',compact('title','pessoas','followers'));

	}

	public function getFollow() {

		$fpersonid = Input::segment(3);

		$me = Confide::user()->person_id;

		$f = new Follow;
		$f->id_follower     = $me;
		$f->id_following    = $fpersonid;
		$f->save();

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


		return Redirect::to('app/friendship');
	
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
	
    public function getInbox()
    {
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


    public function getPhr()
    {
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
		$name = DB::connection("app")->select(DB::raw("select p.name_first, p.name_last from public.person p where (p.id =".$id_person_from.")"));
		$m = DB::connection("app")->select(DB::raw("select distinct p.name_first, p.name_last, m.id, m.message, m.id_person_from, m.created_at from public.person p, app.message m  where ((m.id_person_to =".$pid.") and (m.id_person_from =".$id_person_from.") and (p.id =".$id_person_from.")) or ((m.id_person_to =".$id_person_from.") and (m.id_person_from =".$pid.") and (p.id =".$pid.")) order by m.created_at desc limit 20"));
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
		
		return View::make('viewmessage',compact('message', 'id_person_from', 'tamanho', 'n'));
		

	}
	
	public function getLikec() {
		
		$pid = Confide::user()->person->id;
		$id_content = $_GET['id'];
		
		$v = DB::connection("public")->select(DB::raw("SELECT * from relatepersoncontent where id_person = ".$pid." and id_content = ".$id_content." and liked <> 2 and person_from=".$_GET['from']));
		

		if(empty($v)){
			
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
			
		} else {
			
			$v = $v[0]->liked;
			
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

		} else {
			
			$v = $v[0]->liked;
		
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
		}
		
		return Redirect::to('/');

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
		//$rc->visited = true;
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

	
	// Redireciona para a página da url recebida am 'a'
	public function postDesfazeramizade($id){
		
		$me = Confide::user()->person_id;

		$r = DB::connection("public")->select(DB::raw("delete from app.message where (id_person_from = ".$id." and id_person_to=".$me.") or (id_person_from = ".$me." and id_person_to=".$id.")"));
		$r = DB::connection("public")->select(DB::raw("delete from app.follow where id_follower = ".$me." and id_following=".$id));
		
		
		return Redirect::to('app/friendship');
		
		
	}
	
	
	
	
	
	
	

}
