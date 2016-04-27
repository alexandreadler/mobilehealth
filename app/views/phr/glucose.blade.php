@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Blood Glucose">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="newrecord" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a" data-transition="pop">Novo Registro</a>
            <a id="history" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Histórico</a>

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Blood Glucose Records</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

				
					@if(count($records) > 0)
						<img src={{URL::to('/grafico?t=0&p='.$pid)}} alt="Glicose" height="600" width="100%" />
					@endif
					
					<br >
					
                    @foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Measure: <strong>{{$r['measure']}}</strong> at context <strong>{{$r['context']['description']}}</strong>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Novo registro --}}
            <div id="newrecord_div" class="ui-corner-all custom-corners" style="display: none;">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>New record</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

                    <form id="form" action="{{url('/phr/glucose')}}" method="post">

                        <label for="measure">Measurement (mg/dL):</label>
                        <input type="text" name="measure" id="measure" value="">

                        <label for="context" class="select">Context:</label>
                        <select name="context" id="select-choice-a">
                            @foreach($context_list as $key => $v)
                                <option value="{{$key}}">{{$v}}</option>
                            @endforeach
                        </select>

                    </form>

                </div>
                <div class="ui-bar ui-bar-a" style="height: 44px;">
                    <a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-save"></span> Save</a>
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

