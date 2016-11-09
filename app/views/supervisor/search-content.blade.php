@extends("layout.main-mobile")

@section("content")

@if(isset($aux))
    @if(!empty($aux))
        <div data-role="page" data-title="Supervisor - Home" >
            <div class="TabControl">
                <div class="conteudo"  id="Rec">
                    <div role="main" class="ui-content jqm-content jqm-fullwidth">
                        <div class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a"> 
                                <h3>Avaliar Conteúdo</h3>
                            </div>

                            <div class="ui-body ui-body-a">

                                @foreach($aux as $a)
                                    <div class="video" style="overflow: auto;">
                                        <span class="thumbnail" style="height: auto;">

                                            @if(!empty($a->thumburl))
                                                <!--Caso seja um video-->
                                                <img style="float:left" width="100px" height="100px" src="http://s.wordpress.com/mshots/v1/{{strtolower(urlencode($a->url_online))}}?w=100&h=100" />
                                                <p>
                                                    <b><a href="{{url($a->url_online)}}" target="new">Fonte: {{$a->title}}</a></b> 
                                                </p>

                                                <div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
                                                        		<a id="like" href="supervisor/aprovarfonte/{{$a->url_online}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up" style="font-size:10px;"> Aprovar Fonte</a>
                                                        		<a id="unlike" href="supervisor/reprovarfonte/{{$a->url_online}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down" style="font-size:10px;"> Reprovar Fonte</a>
                                                </div>

                                            @else
                                                <!--Caso seja um lik de site/pdf/outros -->
                                                <img style="float:left" width="100px" height="100px" src="http://s.wordpress.com/mshots/v1/{{strtolower(urlencode($a->url_online))}}?w=100&h=100" />
                                                <p>
                                                    <b style="font-color: blue"><a href="{{url($a->url_online)}}" target="new">Fonte: {{($a->title)}}</a></b>
                                                </p>


                                                <div id="likes" data-role="controlgroup" data-type="horizontal" data-mini="true">
                                                    <a id="like" href="supervisor/aprovarfonte/{{$a->url_online}}" class="active ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-up " style="font-size:10px;"> Aprovar Fonte</a>
                                                    <a id="unlike" href="supervisor/reprovarfonte/{{$a->url_online}}" class="ui-btn ui-corner-all ui-icon-delete fa fa-thumbs-down" style="font-size:10px;"> Reprovar Fonte</a>
                                                </div>


                                            @endif

                                        </span>
                                    </div>

                                @endforeach


                            </div>
                        </div>
                        <br>
                    </div><!-- /content -->  
                </div><!-- /Rec -->
            </div><!-- /TabControl -->
        </div><!-- /page -->
    @else
        <br>Pesquisa sem resultados.
    @endif
@endif

@stop


@section('script')


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



function aba(a) { 
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



.TabControl{
    width:100%; 
    overflow-y:scroll; 
    height:100%;

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






.imgPostComments {
float: left;
display:block;
height: 50px;
width: 50px;
margin: 10px;

}

.imgPostComments {

float: left;
display:block;
height: 50px;
width: 50px;
margin: 10px;

}

#pictureComments {

height: 50px;
width: 50px;
}

.contentPost{

border-left: solid 2px gray;
border-top: solid 2px gray;
border-radius:5px 0 0 10px;
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
padding: 2px 0;
margin: 0;
}
.thumbnail a {
text-decoration: none;
color: #000 !important;
font-weight: normal;
}

@stop

