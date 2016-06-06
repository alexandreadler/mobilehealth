@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Profile">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth" style="border: solid 1px red;">
			
			<div id="possiblefriends">

				<div class="box"  style="border: solid 1px blue;">
					

					<div id="profile_picture">			
						{{ HTML::image(Session::get('profilePicture'), 'a picture') }}
					</div>
								
					<div class="boxName">
									
						{{Session::get('fullName');}}
									
					</div>
					
					<a id="like" href="#" class="active ui-btn ui-corner-all ui-icon-delete fa"> Adicionar</a>

				
					
				</div>
				

			
			</div><!--  /possiblefriends-->
            
			
			<div style="text-align:center">
				
				<a id="bootom" href="{{url("/profile")}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Dados<br > Pessoais</a>
				<a id="bootom" href="{{url("/phr")}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Dados<br > sobre Sáude</a>
				<a id="bootom" href="#" class="active ui-btn ui-corner-all ui-icon-delete fa"> Gerenciar<br > Amigos</a>
			
			
			</div>
			
			
			
			<h3>Posts Compartilhados </h3>
			<div class="conteudo" id="Feed" style="">
			
			
			@if(isset($contents))
				@if(!empty($contents))
					@foreach($contents as $con)
						<div class="post" >
							<div class="headPost">
								<div class="imgPost" >
									{{ HTML::image('imgs/'.$con->photo, '') }}
								</div>
							</div>
							
							<div class="contentPost"> 
								<div class="namePost">
								{{$con->name_first}}
								</div>
								
								<div class="textPost">
									@if(!empty($con->thumburl))
										<div class="video">
											<span class="thumbnail" >
												<a href="{{url("/app/video/" . $con->vid)}}" target="new">
												<img src="{{$con->thumburl}}" align="left" />
												<p class="title">{{Str::limit($con->title,40)}}</p>
												<p class="desc">{{ Str::limit($con->description, 120) }}</p>
												</a>
											</span>
										</div>
								
									@else
								
								
										<p>{{$con->title}}</p>
										<img src="{{$con->thumburl}}" align="left" />
										<p>
											<a href="app/url?a={{$con->url_online}}" target="new">{{$con->description}}</a>
												
										</p>
									
									@endif
								</div>
								
								<div class="divBottom">
									<ul class="bottom">
										<a id="alike" onclick="like('app/likec?id={{$con->id}}&from={{$con->id_person}}');mudaFundoLike('{{$con->id}}');" href="#"><li id="like{{$con->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
										<a id="aulike" onclick="unlike('app/unlikec?id={{$con->id}}&from={{$con->id_person}}');mudaFundoUnLike('{{$con->id}}');" href="#"><li id="unlike{{$con->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>
										<a id="acomp" onclick="comp('app/comp?id_content={{$con->id}}&from={{$con->id_person}}');mudaFundoComp('{{$con->id}}');" href="#" ><li id="comp{{$con->id}}" class="bottomli"><img src="{{url('/imgs/compartilhar.png')}}" /></li></a>
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
				
				<br style="clear:both" /> 
		</div>
			
			
			

		</div><!-- /content -->


	</div><!-- /page -->

@stop

@section("script")

    $('#save').click(function(){
        $('#form').submit();
    });

@stop


@section("style")

#like {
        background: #7B7;
}

#bootom {
        background: #9D9;
}

#bootom:hover {
        background: #CFC;
}

#Feed{
	clear:both;

}


.post{
		border-top: solid 1px green;
		padding-top: 10px;
		color: black;
		clear:both;
}

.box{
	
	width: auto;
	margin: 5px;
	padding: 10px;
	height: 170px;
	float: left;
	
	
}

.boxName{
	
	clear:both;
	
}


#possiblefriends {
	
	width: auto;
	height: 180px;
	overflow-y: scroll;
    overflow-x: hidden;
    -webkit-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
	-moz-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
	box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
	margin-bottom: 10px;
	
}


.imgPost {
		display:block;
		height: 80px;
		width: 80px;
		
}

.imgPost img {
		height: 80px;
		width: 80px;
		
}


.namePost {
		
		font-weight:bold;
		float:left;
		margin: 15px;
		
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


@stop



