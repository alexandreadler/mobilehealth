@extends("layout.main-mobile")

@section("content")

<div data-role="page" data-title="Profile">

    <div role="main" class="ui-content jqm-content jqm-fullwidth" >

        <div id="possiblefriends" >

            @if(isset($possiblefriends))
            @if(!empty($possiblefriends))
            @foreach($possiblefriends as $friends)
            <div class="box"  >

                <div id="profile_picture">	
                    {{ HTML::image('imgs/'.$friends->photo, '') }}							
                </div>

                <div class="boxName">

                    {{Str::limit($friends->name_first . " ". $friends->name_last, 15)}}

                </div>

                <a id="like" href="{{url("app/follow/" . $friends->id)}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Adicionar</a>



            </div>
            @endforeach
            @else
            Sem Resultados.
            @endif
            @else
            Sem Resultados.
            @endif	


        </div><!--  /possiblefriends-->


        <div style="text-align:center">

            <a id="bootom" href="{{url("/profile")}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Dados<br > Pessoais</a>
            <a id="bootom" href="{{url("/phr")}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Dados<br > sobre Sáude</a>
            <a id="bootom" href="{{url('/app/friendship')}}" class="active ui-btn ui-corner-all ui-icon-delete fa"> Gerenciar<br > Amigos</a>


        </div>



        <h3>Posts Compartilhados </h3>
        <div class="conteudo" id="Feed" style="">


            @if(isset($posts))
            @if(!empty($posts))
            @foreach($posts as $p)
            <div class="post" >
                <div class="headPost">
                    <div class="imgPost" >
                         <a href="{{url('profile/personalpagefriend/'.$p->person)}}">{{ HTML::image($p->photo, '') }}</a>
                    </div>
                </div>

                <div class="contentPost"> 
                    <div class="namePost">
                        {{$p->name_first;}}
                    </div>

                    <div class="textPost" stye="">
                        
                       
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
                            <img id="imageFromPost" src="{{url('imgs/'.$p->imagem)}}" />			
			@endif

                        <p style="font-size: 10px; color: gray;">{{$p->create_at}}</p>

                    </div>

                    <div class="divBottom">
                        <ul class="bottom">
                            <a id="alikep" onclick="like('{{url('app/likep?id='.$p->id.'&from='.Confide::user()->person->id)}}'); mudaFundoLikep('{{$p->id}}');" href="#"><li id="likep{{$p->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
                            <a id="aulikep" onclick="unlike('{{url('app/unlikep?id='.$p->id.'&from='.Confide::user()->person->id)}}'); mudaFundoUnLikep('{{$p->id}}');" href="#"><li id="unlikep{{$p->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            @endif
            @else

            @endif


            @if(isset($contents))
            @if(!empty($contents))
            @foreach($contents as $con)
            <div class="post" >
                <div class="headPost">
                    <div class="imgPost" >
                        {{ HTML::image(Session::get('profilePicture'), '') }}
                    </div>
                </div>

                <div class="contentPost"> 
                    <div class="namePost">
                        {{Session::get('fullName');}}
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
                            <a id="alike" onclick="like('{{url('app/likec?id=$con->id&from=$pid')}}'); mudaFundoLike('{{$con->id}}');" href="#"><li id="like{{$con->id}}" class="bottomli"><img src="{{url('/imgs/ok.png')}}" /></li></a>
                            <a id="aulike" onclick="unlike('{{url('app/unlikec?id=$con->id&from=$pid')}}'); mudaFundoUnLike('{{$con->id}}');" href="#"><li id="unlike{{$con->id}}" class="bottomli" ><img src="{{url('/imgs/naoOK.png')}}" /></li></a>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @else

            @endif
            @else

            @endif


            <br style="clear:both" /> 
        </div>




    </div><!-- /content -->


</div><!-- /page -->

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
height: auto;
float: left;
border: solid 1px blue;
}

.boxName{

clear:both;

}


#possiblefriends {

width: auto;
height: 180px;
overflow-y: scroll;
-webkit-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
-moz-box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
box-shadow: -1px -1px 40px 10px rgba(0,0,0,0.3);
margin-bottom: 10px;
clear:both;

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



