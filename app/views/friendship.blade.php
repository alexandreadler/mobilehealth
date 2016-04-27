@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="Friendship">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                     <h3>Seguindo</h3>
                </div>
                <div class="ui-body ui-body-a">

                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren">
                    </form>

                    @foreach($followers as $p)

                        <div data-role="collapsibleset" data-filter="true" data-children="> div, > div div ul li" data-inset="true" id="collapsiblesetForFilterChildren" data-input="#searchForCollapsibleSetChildren">

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
								
								<a href="#popupDefazamizade{{$p->id}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Desfazer Amizade</a>
							
							
								<div data-role="popup" id="popupDefazamizade{{$p->id}}" data-theme="a" class="ui-corner-all">
									<form action="{{url('app/desfazeramizade/'.$p->id)}}" method="post">
										
										<div style="padding:10px 20px;">
											<h3>Deseja desfazer está Amizade?</h3>

											<button type="submit"  class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Sim</button>-
										</div>
									</form>
								</div>
								
								
								
								
								
								
								
								

                            </div>
                        </div>

                    @endforeach


				</div>

			</div>
            <br>

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Siga novos pessoas</h3>
                </div>
                <div class="ui-body ui-body-a">


                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren2">
                    </form>


                    @foreach($pessoas as $p)

                        <div data-role="collapsibleset" data-filter="true" data-children="> div, > div div ul li" data-inset="true" id="collapsiblesetForFilterChildren" data-input="#searchForCollapsibleSetChildren2">

                            <div data-role="collapsible" data-collapsed-icon="carat-d" and data-expanded-icon="carat-u">

                                <h3>{{$p->name_first}} {{$p->name_last}}</h3>

                                Gender: @if ($p->gender == '1') Male @else Female @endif

                                <br>
                                <a href="{{url('app/follow/'.$p->id)}}" class="ui-btn ui-btn-inline ui-icon-star ui-btn-icon-top">Seguir</a>
                                <a href="#popupLogin" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Mensagem</a>


                            </div>
                        </div>

                    @endforeach

                </div>

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
