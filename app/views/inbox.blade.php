@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="Inbox">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Mensagens</h3>
                </div>
                <div class="ui-body ui-body-a">
                	@if(isset($c))
                    	@if(!empty($c))
		                    @for($c =0; $c <= $i;$c++)
								
		                        <div data-role="collapsible" data-iconpos="right" data-collapsed-icon="carat-d" and data-expanded-icon="carat-u">
		                            <h4>{{$m[$c][0]}}</h4>
								
									@for($d = 1; $d < count($m[$c]);$d++)
									    <p style="margin: 0px;"><span style="padding: 5px; background-color:rgb(161, 255, 106); -moz-border-radius: 8px; -webkit-border-radius: 8px;">{{$m[$c][$d]}}</span></p>
									@endfor
									
									<a href="#popupLogin{{$c}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Message</a>
									<div data-role="popup" id="popupLogin{{$c}}" data-theme="a" class="ui-corner-all">
										<form action="{{url('app/messageto2?id='.$ids[$c])}}" method="post">
											<div style="padding:10px 20px;">
												<h3>Mensagens</h3>
												<label for="message" class="ui-hidden-accessible">Username:</label>
												<textarea name="message" id="message" value="" placeholder="" data-theme="a" cols="40" rows="20" ></textarea>
												<button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Send</button>
											</div>
											
										</form>
									</div>
									
									<a href="#popupDefazamizade{{$c}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Desfazer amizade</a>

									<a href="#popupapagar{{$c}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Apagar conversa</a>
									
									
									<div data-role="popup" id="popupDefazamizade{{$c}}" data-theme="a" class="ui-corner-all">
										<form action="{{url('app/desfazeramizade/'.$ids[$c])}}" method="post">
											
											<div style="padding:10px 20px;">
												<h3>Deseja desfazer está Amizade?</h3>
												<input type="submit" value="Sim" />
												<!--<button type="submit"  class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Sim</button>-->
											</div>
										</form>
									</div>
									
									<div data-role="popup" id="popupapagar{{$c}}" data-theme="a" class="ui-corner-all">
										<form action="{{url('app/desfazeramizade/'.$ids[$c])}}" method="post">
											
											<div style="padding:10px 20px;">
												<h3>Deseja apagar está conversa?</h3>
												<input type="submit" value="Sim" />
												<!--<button type="submit"  class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Sim</button>-->
											</div>
										</form>
									</div>
									
									
		                        </div>
								
		                    @endfor
		                @else
		                  {{--<p>Nenhuma mensagem.</p>--}}
		                @endif
		            @else
		               {{--<p>Nenhuma mensagem.</p>--}}
		            @endif
                </div>
            </div>

		</div>

	</div>

@stop
