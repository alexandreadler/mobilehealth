@extends("layout.main-mobile")


@section("content")



<div class="TabControl">

    @if(!isset($megERRO))

    @else
        {{$megERRO}}
    @endif


    <div id="header" style="overflow: auto;">
        <ul class="abas" style="clear: both;">
            <li onclick="aba(0)"> 
                <div class="aba" id="recommandation">
                    <span ><b >Recomenda&ccedil&otilde;es</b></span>
                </div>
            </li>
            <li onclick="aba(1)">
                <div class="aba" id="feed">
                    <span><b>Feed</b></span>
                </div>
            </li>			
        </ul>

    </div>


    <div id="content">	



        <div class="conteudo"  id="Rec" >
            <!-- Div geral para os contúedos recomendados pelo mobilehealth, é separada da rede social para dar maior foco as recomendações; 
                     É a página inical do mobilehealth -->


            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
                    <h3>Videos recomendados</h3>
                </div>
                <div class="ui-body ui-body-a">
                    @if(isset($c))
                        @if(!empty($c))
                            @foreach( $c as $v )
                            <div class="video">
                                <span class="thumbnail">
                                    <a href="{{url("/app/video/" . $v['vid']."/-1")}}">
                                        <img src="{{$v['thumburl']}}" align="left" />
                                        <p class="title">{{Str::limit($v['title'],40)}}</p>
                                        <p class="desc">{{ Str::limit($v['description'], 120) }}</p>
                                    </a>
                                </span>
                            </div>
                            @endforeach

                        @else
                            Sem Resultados.
                        @endif	

                    @else
                        Sem Resultados.
                    @endif
                </div>
            </div> 	


            <div class="ui-corner-all custom-corners" >
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
                    <h3>Links Recomendados.</h3>
                </div>
                <div class="ui-body ui-body-a">

                    @if(isset($c2))
                        @if(!empty($c2))
                            @foreach( $c2 as $v )

                                <a href="app/url?a={{$v->url_online}}" target="new">
                                    <p class="title">
                                        {{Str::limit($v->title,40)}}
                                    <div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
                                            <a id="like" href="{{url('app/likec?id='.$v->id.'&from=-1')}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up "> Like</a>
                                            <a id="unlike" href="{{url('app/unlikec?id='.$v->id.'&from=-1')}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down"> Unlike</a>
                                    </div>

                                    </p>
                                </a>

                            @endforeach

                        @else
                            Sem Resultados.
                        @endif

                    @else
                        Sem Resultados.
                    @endif

                </div>
            </div>


            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a" style="border-radius:5px 5px 0px 0px;">
                    <h3>Novas Mensagens</h3>
                </div>
                <div class="ui-body ui-body-a">
                    @if(isset($message))
                        @if(!empty($message))
                            @foreach( $message as $m )

                                <a href="app/viewmessage?id_person_from={{$m->id_person_from}}" data-rel="popup" data-position-to="window" data-transition="pop"><p>{{Str::limit(($m->name_first .$m->name_last), 20)}}</p></a>

                            @endforeach

                        @else
                            Sem Resultados.
                        @endif
                    @else
                        Sem Resultados.
                    @endif
                </div>
            </div>



        </div> <!-- Fecha div REC -->


        <div class="conteudo" id="Feed">
            <!-- Div geral para os Feed da rede social do mobilehealth, é separada, pois da maior foco as recomendações; -->


            <div id="userpost" style="margin: 20px;">
                <h4>Compartilhe suas esperiências</h4>
                <form id="form" action="{{url('app/publicacao')}}" method="post" enctype="multipart/form-data">
                    <textArea id="texto" name="texto"> </textArea>
                    <input type="file" id="imagem" name="imagem">
				</form>
				
				<div class="ui-bar ui-bar-a" style="height: 44px;">
                    <a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;">Publicar</a>
                </div>
            </div>
		
			@if(isset($c))
                            @if(!empty($c))
				@foreach( $c as $v )
					<div class="post" >
						<div class="headPost">
							<div class="imgPost" >
								<img id="picture" src="imgs/{{Session::get('profilePicture')}}" />
							</div>
						</div>
							
						<div class="contentPost" style="background: rgb(220, 255, 200)"> 
							<div class="namePost" >
								Videos Recomendados para você
							</div>
							
							<div class="textPost">
							
                                				<div class="video">
                                        				<span class="thumbnail" >
                                                				<a href="{{url("/app/video/" . $v['vid']."/-1")}}" target="new">
                                                        				<img src="{{$v['thumburl']}}" align="left" />
											<p class="title">{{Str::limit($v['title'],40)}}</p>
											<p class="desc">{{ Str::limit($v['description'], 120) }}</p>
											</a>
									</span>
								</div>
							</div>
								
							<div class="divBottom">
								<ul class="bottom">
								<!-- O -1 serve para identificar que o conteudo foi uma recomendação-->
									<a id="alike" onclick="like('app/likec?id={{$v['id']}}&from=-1');mudaFundoLike('{{$v['id']}}');"  href="#"><li id="like{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
									<a id="aulike" onclick="unlike('app/unlikec?id={{$v['id']}}&from=-1');mudaFundoUnLike('{{$v['id']}}');" href="#"><li id="unlike{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
									<a id="acomp" onclick="comp('app/comp?id_content={{$v['id']}}& from=-1');mudaFundoComp('{{$v['id']}}');" href="#" ><li id="comp{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
								</ul>
							</div>
								
								
								
								
								
                                    </div>
                                    </div>
				@endforeach
                            @else
				Sem Resultados.
                            @endif
			@else
                            Sem Resultados.
			@endif
			
			
			
			@if(isset($c2))
				@if(!empty($c2))
					<div class="post" >
								
						<div class="namePost" >
							Links Recomendados para você
						</div>
							
						@foreach( $c2 as $v )
							
							<div class="contentPost" style="background: rgb(220, 255, 200)"> 
									
								<div class="textPost">
									<a href="app/url?a={{$v->url_online}}" target="new">
										<p class="title">
											{{Str::limit($v->title,40)}}
											<div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
													   			
												<img style="float:left" width="100px" height="100px" src="http://s.wordpress.com/mshots/v1/{{urlencode($v->url_online)}}?w=100&h=100" />			
													
											</div>
													
										</p>
									</a>
								</div>

								<div class="divBottom">
									<ul class="bottom">
									<!-- O -1 serve para identificar que o conteudo foi uma recomendação-->
										<a id="alike" onclick="like('app/likec?id={{$v['id']}}&from=-1');mudaFundoLike('{{$v['id']}}');"  href="#"><li id="like{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
										<a id="aulike" onclick="unlike('app/unlikec?id={{$v['id']}}& from=-1');mudaFundoUnLike('{{$v['id']}}');" href="#"><li id="unlike{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
										<a id="acomp" onclick="comp('app/comp?id_content={{$v['id']}}&from=-1');mudaFundoComp('{{$v['id']}}');" href="#" ><li id="comp{{$v['id']}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
									</ul>
								</div>
																	
							</div>
						@endforeach
							
					</div>
				@endif

			@endif

			
			
			
		<!-- Videos compartilhados no feed;
			É separado para facilitar a inplemnetação;-->
			
			<!-- Compartilhamento de post  -->
			@if(isset($posts))
				@if(!empty($posts))
					@foreach($posts as $p)
						<div class="post" >
							<div class="headPost">
                                                            <a href="{{url('profile/personalpagefriend/'.$p->person)}}">
								<div class="imgPost" >
									<img id="picture" src="imgs/{{$p->photo}}" />
								</div>
                                                            </a>
							</div>
							
							<div class="contentPost"> 
								<div class="namePost">
									<div>{{$p->name_first}}</div>
								</div>
								<div class="btnRecomendar">
									<a target="_blank"  onclick="postrecomendar('app/postrecomendar/{{$p->id}}')" href="#""><span class="glyphicon glyphicon-bookmark"><br />Indicar</span></a>
								</div>
								
								<div class="textPost">

										<p>
											{{$p->texto}}
											
											<!-- Caso o texto tenha algum link do youtube -->
											@if(!empty($p->thumburl))
												<div class="video">
													<span class="thumbnail" >
														<a href="{{url("/app/video/" . $p->vid."/".$p->person)}}" target="new">
														<img src="{{$p->thumburl}}" align="left" />
														<p class="title">{{Str::limit($p->title,40)}}</p>
														<p class="desc">{{ Str::limit($p->description, 120) }}</p>
														</a>
													</span>
												</div>
										
											
											@endif
											
										</p>
										
										@if(strcmp($p->imagem, ' ') != 0)
											<img width="60%" id="imageFromPost" src="imgs/{{$p->imagem}}" />			
										@endif
                                                                                
                                                                                <p style="font-size: 10px; color: gray;">{{$p->create_at}}</p>

								</div>
								
								<div class="divBottom">
									<ul class="bottom">
										@if($p->liked == 1)
												<a id="alikep" onclick="like('app/likep?id={{$p->id}}&from={{$p->person}}'); mudaFundoLikep('{{$p->id}}');" href="#"><li style="border: solid 2px blue" id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
											
												<a id="aulikep" onclick="unlike('app/unlikep?id={{$p->id}}&from={{$p->person}}'); mudaFundoUnLikep('{{$p->id}}');" href="#"><li style="border:solid 1px gray" id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
												
												
											
											@elseif($p->liked == -1)

												<a id="alikep" onclick="like('app/likep?id={{$p->id}}&from={{$p->person}}'); mudaFundoLikep('{{$p->id}}');" href="#"><li style="border: solid 1px gray" id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
											
												<a id="aulikep" onclick="unlike('app/unlikep?id={{$p->id}}&from={{$p->person}}'); mudaFundoUnLikep('{{$p->id}}');" href="#"><li style="border:solid 2px blue" id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
												
												
											@else 

												<a id="alikep" onclick="like('app/likep?id={{$p->id}}&from={{$p->person}}'); mudaFundoLikep('{{$p->id}}');" href="#"><li id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
											
												<a id="aulikep" onclick="unlike('app/unlikep?id={{$p->id}}&from={{$p->person}}'); mudaFundoUnLikep('{{$p->id}}');" href="#"><li  id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>


											@endif

											<a id="acomp" onclick="comp('app/compp?id_post={{$p->id}}&from={{$p->person}}'); mudaFundoCompp('{{$p->id}}');" href="#" ><li id="compp{{$p->id}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
									</ul>
								</div>
								
								
								<!-- Comentários para um post -->
                                                                
								<div style="width: 75%; height: 50px; text-align: center; "><p style="margin-top: 15px;"><a href="{{url('app/comments/'.$p->id)}}" onclick="comments()" style="text-decoration: none;">Comente sobre isso</a></p></div>
								
								
							</div>
						</div>
				@endforeach
			@else
				Sem Resultados.
			@endif
		@else
			Sem Resultados.
		@endif
			
		</div>
	</div>
</div>

@stop



@section("script")

function like(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					$('#retornodoresultado').html(sucesso);
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}



function unlike(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					$('#retornodoresultado').html(sucesso);
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}


function comp(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					alert("Você compartilhou esse conteúdo");
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}

function postrecomendar(link){
	
	$.ajax({
				url: link,
				type: "GET",
				data: { sim: link},
				dataType: "html",
				success: function(sucesso){
					alert("Indicação realizada");
					
				},
				beforeSend: function () {
					$('#carregando').css({display: "block"});
				},
				complete: function () {
					$('#carregando').css({display: "none"});
				},
				error: function(){
					$('#retornodoresultado').html('Desculpe pelo transtorno, houve um erro, tente novamente.');
				}
		});
		return false;
			

}

function mudaFundoLike(div){
	
	$("#like"+div).css('border', 'solid 2px blue');
	$("#unlike"+div).css('border', 'solid 1px gray');
	
}


function mudaFundoUnLike(div){
	
	$("#unlike"+div).css('border', 'solid 2px blue');
	$("#like"+div).css('border', 'solid 1px gray');
	
}

function mudaFundoComp(div){
	
	$("#comp"+div).css('border', 'solid 2px blue');

	
}

	function aba(a) 
	{ 
		if(a == 0){
			
			$("#Rec").show();
			$("#recommandation").css('color', 'green'); 
			$("#recommandation").css('border-bottom', 'solid 1px green');
			$("#feed").css('border-bottom', 'solid 1px white');
			$("#feed").css('color', 'gray'); 
			$("#Feed").hide(); 
			 
			
			
		} else {
			$("#Feed").show(); 
			$("#feed").css('color', 'green');
			$("#feed").css('border-bottom', 'solid 1px green');
			$("#recommandation").css('color', 'gray');
			$("#recommandation").css('border-bottom', 'solid 1px white');
			$("#Rec").hide(); 
			
			
		}
	
	}
	
	
function mudaFundoLikep(div){
	
	$("#likep"+div).css('border', 'solid 2px blue');
	$("#unlikep"+div).css('border', 'solid 1px gray');
	
}


function mudaFundoUnLikep(div){
	
	$("#unlikep"+div).css('border', 'solid 2px blue');
	$("#likep"+div).css('border', 'solid 1px gray');
	
}

function mudaFundoCompp(div){
	
	$("#compp"+div).css('border', 'solid 2px blue');

	
}

$('#save').click(function(){
    $('#form').submit()
});



@stop






@section("style")

	#like {
        background: #7B7;
    }
    #like:hover {
        background: #BEB;
    }

    #unlike {
        background: #E66;
    }
    #unlike:hover {
        background: #F88;
    }

    .thumbnail {
        display: block;
        height: 120px;
    }

    .thumbnail img {
        margin: 5px !important;
    }
    .thumbnail .title {
        padding: 2px 5px 0;
        margin: 0;
        font-weight: bold;
        font-size: 0.8em
    }
    .thumbnail .desc {
        font-size: 0.7em;
        font-weight: normal;
        padding: 2px 0;
        margin: 0;
    }
    .thumbnail a {
        text-decoration: none;
        color: #000 !important;
        font-weight: normal;
    }

	
	.TabControl{

		clear:both;
		
	} 
	
	.TabControl #header{ 
		width:100%; 
		cursor:hand;
		
	} 
	
	.TabControl #content{
		width:100%; 
		height: 500px;
		margin-botton: 50%;
		
	}

	
	.TabControl .abas{
		display:block;
		list-style-type: none;
		padding: 0;
		
		
	}
	
	.TabControl .abas li{
		width: 50%;
		float:left;
	}
	

	
	.aba{
		width:100%;
		height:30px;
		border-radius:5px 5px 0 0;
		text-align:center;
		border-left: solid  1px #9ee88b;
		border-right: solid  1px #9ee88b;
		
	}

	
	.TabControl .conteudo{
		width:100%; 
		display:block;
		color:#fff;
		border-radius: 5px 5px 0px 0px;
		
	}

	#Rec{
		display:block;
	}	
	
	#Feed{
		display:none;
	}	
	
	
	.post{

		display:block;
		color: black;
		clear:both;
	}
	
	.imgPost {
		float: left;
		display:block;
		height: 80px;
		width: 80px;
		margin: 10px;
		
	}
		
	#picture {
		
		height: 80px;
		width: 80px;
	}
	
	.namePost {
		
		font-weight:bold;
		float:left;
		margin: 15px;
		
	}

	.btnRecomendar {
		
		font-weight:bold;
		float:right;
		margin: 15px;
		
	}
	
	
	#imageFromPost {
		
		
		margin: 10px;
		height: 80%;
		width: 80%;
		
		
	}
	
	.contentPost{
		
		border-left: solid 2px gray;
		border-top: solid 2px gray;
		border-radius:5px 0 0 0;
		margin: 15px;
		float:left;
		display:block;
		width: 100%;
		height: auto;
		
		
	}
	
	.textPost{
		
		
		margin: 5px;
		clear: both;
		
	}
	
	.divBottom{
		

		padding: 0;
		margin: 0;
		
	}
	
	.bottom {
		margin:0;
		padding:0;
		display:block;
		overflow: auto;
	}
	
	.bottom li{
		margin:0;
		padding:0;
		display:block;
		list-style-type: none;
		border: solid 1px gray;
		float: left;
		width: 25%;
		text-align: center;
		border-radius:5px 5px 0 0;
		
	}
	
	.bottom li img{
		
		width: 15px;
		
	}
	
	.ativa span, .selected span{
		color:#fff;
	}
	
	
@stop

