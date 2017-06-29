@extends("layout.main-mobile")

@section("content")

    <div data-role="page" data-title="Hemoglobin ">

        <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="newrecord" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a" data-transition="pop">Novo Registro</a>
            <a id="history" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Histórico</a>


             

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a" >
                    <h3><strong>Registro de Hemoglobina Glicada</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

                    @if(count($records) > 0)
                       <img src={{URL::to('/grafico?t=6&p='.$pid)}} alt="Glicose" height="600" width="100%" /> 
                    @endif
                
                    <br >
                
                    @foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Hemoglobina Glicada: <strong> {{$r['hemoglobin']}} %. </strong><br>
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

                    <form id="form" action="" method="post" role="form" data-toggle="validator">

                         <div class="form-group">

                        <label for="hemoglobin">Hemoglobina Glicada(%):</label>
                        <input type="number" name="hemoglobin" id="hemoglobin" value="" placeholder="exemplo: 7%" required >

                        </div>

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
       if($('#hemoglobin').val()==""){
        
        }
        else{
            $('#form').submit();
        }
    });

@stop

