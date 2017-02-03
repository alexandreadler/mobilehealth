@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Weight">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="newrecord" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a" data-transition="pop">Novo Registro</a>
            <a id="history" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Histórico</a>

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Registro de peso</strong></h3>
                </div>
                <div class="ui-body ui-body-a">
					
					@if(count($records) > 0)
						<img src={{URL::to('/grafico?t=2&p='.$pid)}} alt="Peso" height="600" width="100%" />
					@endif
                
					<br >
				
					@foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Peso <strong>{{$r['weight']}}</strong> kg.
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Novo registro --}}
            <div id="newrecord_div" class="ui-corner-all custom-corners" style="display: none;">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Novo registro</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

                    <form id="form" action="{{url('/phr/weight')}}" method="post">

                        <label for="weight">Peso (kg):</label>
                        <input type="text" name="weight" id="weight" value="">

                    </form>

                </div>
                <div class="ui-bar ui-bar-a" style="height: 44px;">
                    <a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-save"></span> Salvar</a>
                </div>

            </div>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

@section("script")

    $("#newrecord").click(function(){
        $("#newrecord_div").show();
        $("#history_div").hide();
    });

    $("#history").click(function(){
        $("#history_div").show();
        $("#newrecord_div").hide();
    });


    $('#save').click(function(){
        $('#form').submit();
    });

@stop

