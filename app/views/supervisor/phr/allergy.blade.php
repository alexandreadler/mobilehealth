@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Allergy">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="history" href="{{url("/supervisor/perfil/".$pid)}}" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Voltar</a>

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Allergy Records</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

                    @foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{Str::limit($r['firstobserved'],10,'')}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Allergy Name: <strong>{{$r['name']}}</strong>. Type: <strong>{{$r['type']['description']}}</strong>. Reaction: <strong>{{$r['reaction']['description']}}</strong>.<br>
                                Observation:  <strong>{{$r['observation']}}</strong>.
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

                    <form id="form" action="{{url('/phr/allergy')}}" method="post">

                        <label for="name">Allergy Name:</label>
                        <input type="text" name="name" id="name" value="">

                        <label for="id_allergyreaction" class="select">Reaction:</label>
                        <select name="id_allergyreaction" id="select-choice-a">
                            @foreach($areactions as $key => $v)
                                <option value="{{$key}}">{{$v}}</option>
                            @endforeach
                        </select>

                        <label for="id_allergytype" class="select">Type:</label>
                        <select name="id_allergytype" id="select-choice-a">
                            @foreach($atypes as $key => $v)
                                <option value="{{$key}}">{{$v}}</option>
                            @endforeach
                        </select>

                        <label for="firstobserved">First Observed:</label>
                        <input type="date" name="firstobserved" id="firstobserved" value="">

                        <label for="observation">Observation:</label>
                        <textarea cols="40" rows="8" name="observation" id="observation"></textarea>

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

