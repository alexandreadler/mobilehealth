@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="My Health">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Registro Pessoal de Saúde</h3>
                </div>
                <div class="ui-body ui-body-a">
                    <a href="{{url('/supervisor/glucose/'.$pid)}}" class="ui-shadow ui-btn ui-corner-all">Glicose</a>
                    <br>
                    <a href="{{url('/supervisor/pressure/'.$pid)}}" class="ui-shadow ui-btn ui-corner-all">Pressão Sanguínea</a>
                    <br>
                    <a href="{{url('/supervisor/weight/'.$pid)}}" class="ui-shadow ui-btn ui-corner-all">Peso</a>
                    <br>
                    <a href="{{url('/supervisor/height/'.$pid)}}" class="ui-shadow ui-btn ui-corner-all">Altura</a>
                    <br>
                    <a href="{{url('/supervisor/allergy/'.$pid)}}" class="ui-shadow ui-btn ui-corner-all">Alergia</a>
                    <br>
                </div>
            </div>
            <br>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

