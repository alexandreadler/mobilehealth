@extends("layout.main-mobile")


@section("content")

    <div class="row panel-body">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
				
				@if(!isset($megERRO))
				
				@else
					{{$megERRO}}
				@endif
			
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-plus"></span> Novo Conteúdo
				</div>
                <div>

                    {{ Form::open(['method' => 'POST','url' => '/supervisor/cadastraconteudo', 'class' => 'form-horizontal panel-body','role' => 'form','id' => 'form'] ) }}

                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Autor: </label>
                            <div class="col-sm-9">
                                <input id="author" name="author" type="text" class="form-control input-md" required="">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">
                                Data de criação: </label>
                            <div class="col-sm-9">
                                <input id="dataCretion" onkeypress="mascara(this, '####-##-##')" name="dataCretion" type="text" maxlength="10"  required=""><br>
								<span style="font-size: 10px; color: gray;">AAAA-MM-DD</span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">
                                Titulo: </label>
                            <div class="col-sm-9">
                                <input id="title" name="title" type="text" class="form-control input-md" required="">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-3 control-label">
                                Descrição: </label>
                            <div class="col-sm-9">
                                <textArea id="description" name="description" type="text" class="form-control input-md" required="">
								</textArea>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label">
                                URL: </label>
                            <div class="col-sm-9">
                                <input id="url" name="url" type="text" class="form-control input-md" required="">
                            </div>
                        </div>
						
                        <div class="form-group last" style="padding: 0 15px;">

                            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                  <a style="color: white;" id="submit" class="btn btn-success btn-sm" role="button">Cadastrar</a>
                                  
                            </div>

                        </div>

                    {{ Form::close() }}
					
		

                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>

@stop

@section("style")


.panel-default {
    opacity: 0.9;
    margin-top:30px;
}
.form-group.last { margin-bottom:0px; }


@stop

@section("script")

    $(function(){

        $("#submit").click(function(){
            $("#form").submit();
        });

        $("#username").focus();

    });
	
	
	 function mascara(t, mask){
		 var i = t.value.length;
		 var saida = mask.substring(1,0);
		 var texto = mask.substring(i)
		 if (texto.substring(0,1) != saida){
		 t.value += texto.substring(0,1);
		 }
	 }

@stop