@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="IMC">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <a id="newrecord" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-plus ui-btn-icon-left ui-btn-a" data-transition="pop">Novo Registro</a>
            <a id="history" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">Histórico</a>

             <a id="imc" href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-fa-list-alt ui-btn-icon-left ui-btn-a" data-transition="pop">IMC</a>



             
              

            {{-- Histórico --}}
            <div id="history_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>Registro da altura e peso</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

					@if(count($records) > 0)
						<img src={{URL::to('/grafico?t=3&p='.$pid)}} alt="Glicose" height="600" width="100%" />

                        <br>
                        <br>
                        <img src={{URL::to('/grafico?t=2&p='.$pid)}} alt="Peso" height="600" width="100%" />

					@endif
				
					<br >
				
                    @foreach($records as $r)

                       <div id="history_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                Altura: <strong> {{$r['height']}} cm. </strong><br>
                                Peso: <strong> &nbsp;  {{$r['weigth']}} kg. </strong> 
                            </div>
                        </div>

                    @endforeach
                </div>
                <br>
                
            </div>

             {{-- IMC --}}
            <div id="imc_div" class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3><strong>IMC</strong></h3>
                </div>
                <div class="ui-body ui-body-a">

                    @if(count($records) > 0)
                        <img src={{URL::to('/grafico?t=4&p='.$pid)}} alt="Imc" height="600" width="100%" />
                        <br>


                    @endif
                
                    <br >


                    
                
                    @foreach($records as $r)

                       <div id="imc_div" class="ui-corner-all custom-corners">
                            <div class="ui-bar ui-bar-a">
                                <h3><strong>{{$r['datetime']}}</strong></h3>
                            </div>
                            <div class="ui-body ui-body-a">
                                IMC: <strong> &nbsp; &nbsp; &nbsp; &nbsp;  {{$r['imc']}}</strong>
                                <br> Situação: <strong>{{$r['situacion']}}</strong>
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

                    <form id="form" action="" method="post">

                        
                         <div class="form-group">
                   
                            <label for="height">Altura (cm): </label>   
                            <input  type="number" name="height" id="height" value="" placeholder="exemplo: 180"  required="required">  

                            <label for="weight">Peso (kg):</label>   
                            <input type="number" name="weight" id="weight" value="" placeholder="exemplo:80" required="required">

                             <br>

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
        $("#imc_div").hide();

    });

    

    $("#history").click(function(){
        $("#history_div").show();
        $("#newrecord_div").hide();
        $("#imc_div").hide();

    });

      $("#imc").click(function(){
        $("#history_div").hide();
        $("#newrecord_div").hide();
        $("#imc_div").show();

    });


    $('#save').click(function(){

        if($('#height').val()=="" || $('#weight').val()==""){
        
        }
        else{

         
        $('#form').submit();
        }
        
        
    });

@stop

