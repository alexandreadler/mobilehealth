@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Blood Pressure">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="newrecord" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a" data-transition="pop">Novo Registro</a>
            <a id="history" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Histórico</a>

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Registro de Pressão Arterial</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

					@if(count($records) > 0)
						<img src={{URL::to('/grafico?t=1&p='.$pid)}} alt="Glicose" height="600" width="100%" />
                        <br> <br>
                        <img src={{URL::to('/grafico?t=5&p='.$pid)}} alt="Glicose" height="600" width="100%" />

					@endif
				
					<br >
				
                    @foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Pressão Sistólica: &nbsp; <strong>{{$r['systolic']}} </strong>  <br>
                                Pressão Diastólica: <strong>{{$r['diastolic']}} </strong>
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

                    <form id="form" action="{{url('/phr/pressure')}}" method="post">

                        <div class="form-group">

                        <label for="pulse">Pressão Sistólica</label>
                        <input type="number" name="sistolic" id="sistolic" value="" required="required">

                        <label for="pulse">Pressão Diastólica</label>
                        <input type="number" name="diastolic" id="diastolic" value="" required="required">

                        </div>

                        <!--
                        <label for="irregularheartbeat">Batimentos cardíacos irregulares:</label>
                        <fieldset data-role="controlgroup" data-theme="b" data-type="horizontal" data-mini="true">
                            <input type="radio" name="irregularheartbeat" id="radio-choice-c" value="0" checked="checked">
                            <label for="radio-choice-c">Não</label>
                            <input type="radio" name="irregularheartbeat" id="radio-choice-d" value="1">
                            <label for="radio-choice-d">Sim</label>
                        </fieldset> -->

                         <div class="form-actions form-group">
                             <div class="ui-bar ui-bar-a" style="height: 44px;">

                                <button type="submit" id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home"><span class="glyphicon glyphicon-save"></span> Salvar</button>
                            </div>
                        </div>

                    </form>

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
       if($('#diastolic').val()=="" || $('#sistolic').val()==""){
        
        }
        else{

         
        $('#form').submit();
        }
    });

@stop

