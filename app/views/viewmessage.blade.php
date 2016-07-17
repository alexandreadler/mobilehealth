@extends("layout.main-mobile")

@section("content")
	<meta http-equiv="refresh" content="15;{{url('app/viewmessage?id_person_from='.$id_person_from)}}">

	<div data-role="page" data-title="Friendship">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                     <h3>Mensagens</h3>
					 
                </div>
                <div class="ui-body ui-body-a">
                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren">
                    </form>
							
						<div data-role="collapsibleset" data-filter="true" data-children="> div, > div div ul li" data-inset="true" id="collapsiblesetForFilterChildren" data-input="#searchForCollapsibleSetChildren">
						
							<div class="box"  >
								
								<div id="profile_picture">	
									{{ HTML::image('imgs/'.$photo, '') }}							
								</div>						
									
							</div>

							<h3 style="padding-top: 40px;">{{$n}}</h3>
							@if(!empty($message))
																
									@for($x = $tamanho-1; $x >= 0; $x--)
										@if($message[$x]['id_person_from'] == $id_person_from)
											
											<div style="margin-bottom:13px;clear: both; width:100%;"><p style="-moz-border-radius:8px; -webkit-border-radius:8px; padding:5px; width:40%; background-color:rgb(161, 255, 106);">{{$message[$x]['message']}}</p></div>
										@else
											<div style="margin-bottom:13px; width:100%; align-content:right; clear: both;"><p style="text-align:right; float:right; width:40%; background-color:#7B7; -moz-border-radius:8px; -webkit-border-radius:8px; padding: 5px;">{{$message[$x]['message']}}</p></div>
										@endif
									@endfor
									<br>
									<a href="#popupLogin" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Message</a>

									<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
										<form action="{{url('app/messageto2?id='.$id_person_from)}}" method="post">
											<div style="padding:10px 20px;">
												<h3>Message</h3>
												<label for="message" class="ui-hidden-accessible">Username:</label>
												<textarea name="message" id="message" value="" placeholder="" data-theme="a" cols="40" rows="20" ></textarea>
												<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Send</button>
											</div>
										</form>
									</div>

								
							
							@else
								Sem novas mensagens
							@endif
						</div>					


           </div>

        </div>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

@section("script")

$(function(){
$("#lista").listview({
autodividers: true,
autodividersSelector: function (li) {
var out = li.attr("doenca");
return out;
}
}).listview("refresh");
});


@stop




@section("style")

.box{
	
	width: auto;
	margin: 5px;
	padding: 10px;
	height: auto;
	float: left;

}


@stop




