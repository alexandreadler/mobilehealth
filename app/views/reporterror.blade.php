@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Profile">

		

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">
			
            <form id="form" action="{{url('/users/reporterror')}}" method="post" enctype="multipart/form-data">
            	@if(!isset($megERRO))
					
						@else
							{{$megERRO}}
						@endif
                <div class="ui-corner-all custom-corners">
                    <div class="ui-bar ui-bar-a">
                        
                        <h5><p>Por favor nos ajude a melhorer informando qualquer problema que acontecer</p></h5>
                    </div>
                    <div class="ui-body ui-body-a">
                        
						<label for="descricao">Descrição do erro</label>
                        <textarea name="descricao"></textarea>

		

						<br >
						Imagem do Erro
						<br >
						<input type="file" id="imagem" name="imagem">

                    </div>
                    <div class="ui-bar ui-bar-a" style="height: 44px;">
                        <a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-arrow-up"></span>Enviar</a>
                    </div>

                </div>

            </form>

		</div><!-- /content -->


	</div><!-- /page -->

	
	
	
@stop

@section("script")

    $('#save').click(function(){
        $('#form').submit();
    });

@stop

