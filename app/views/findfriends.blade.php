@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="Friendship">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                     <h3>Encontre Novos Amigos</h3>
                </div>
                <div class="ui-body ui-body-a">

                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren">
                    </form>

                    @foreach($findfriends as $p)

                        <div data-role="collapsibleset" style="clear: left" data-filter="true" data-children="> div, > div div ul li" data-inset="true" id="collapsiblesetForFilterChildren" data-input="#searchForCollapsibleSetChildren">

							<div class="box">
							 <a href="{{url('profile/personalpagefriend/'.$p->id)}}">
									<div id="profile_picture">	
										{{ HTML::image('imgs/'.$p->photo, '') }}					
									</div>
							</a>
							</div>
                            <div data-role="collapsible" data-collapsed-icon="carat-d" and data-expanded-icon="carat-u">
								
								
                                <h3>{{$p->name_first}} {{$p->name_last}}</h3>

                                Gender: @if ($p->gender == '1') Male @else Female @endif
								
                                <br>
                                <a href="#popupLogin{{$p->id}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Message</a>

                                <div data-role="popup" id="popupLogin{{$p->id}}" data-theme="a" class="ui-corner-all">
                                    <form action="{{url('app/messageto/'.$p->id)}}" method="post">
                                        <div style="padding:10px 20px;">
                                            <h3>Mensagens</h3>
                                            <label for="message" class="ui-hidden-accessible">Usuário:</label>
                                            <textarea name="message" id="message" value="" placeholder="" data-theme="a" cols="40" rows="20" ></textarea>
                                            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Enviar</button>
                                        </div>
                                    </form>
                                </div>
								
								<a href="{{url('app/follow/'.$p->id)}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Fazer Amizade</a>
	
								

                            </div>
                        </div>

                    @endforeach


				</div>

			</div>
            <br>

			
            </div>
            <br>

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