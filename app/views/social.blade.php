@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="Social">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Interações Sociais</h3>
                </div>
                <div class="ui-body ui-body-a">
                    <a href="{{url('/app/friendship')}}" class="ui-shadow ui-btn ui-corner-all">Amigos</a>
                    <br>
                    <a href="{{url('/app/inbox')}}" class="ui-shadow ui-btn ui-corner-all">Mensagens</a>
                    <br>
                </div>
            </div>
            <br>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

