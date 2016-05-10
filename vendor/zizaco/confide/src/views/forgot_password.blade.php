@extends("layout.main")


@section("content")

<!-- Rota original /users/forgot_password, mas o laravel não reconhece esse nome, então reduzi para /users/forgot-->
   
<div class="row panel-body">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
			
			@if(!isset($megERRO))
				
			@else
				{{$megERRO}}
			@endif
			
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock"></span> Login
				</div>
				
                <div>
			
					
                    {{ Form::open(['method' => 'POST','url' => 'users/forgot', 'class' => 'form-horizontal panel-body','role' => 'form','id' => 'form'] ) }}
						
						<input type="hidden" name="token" value="{{{Session::getToken()}}}">
                        
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">
                                E-mail: 
							</label>
                            <div class="col-sm-9">
                                <input id="email" name="email" type="text" class="form-control input-md" placeholder="Login" required="">
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">
                                Usuário
							</label>
                            <div class="col-sm-9">
                                <input id="username" name="username" type="text" class="form-control input-md" placeholder="Login" required="">
                            </div>
                        </div>
                        
						<div class="form-group">
							<label for="password">
								Nova Senha
							</label>
							<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
						</div>
						<div class="form-group">
							<label for="password_confirmation">
								Confirmar Nova Senha
							</label>
							<input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
						</div>
                        
						<div class="form-group last" style="padding: 0 15px;">

                            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                  <a id="submit" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-log-in"></span> Redefinir</a>
                            </div>

                        </div>

                    {{ Form::close() }}
					
					

                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>


@section("script")

    $(function(){

        $("#submit").click(function(){
            $("#form").submit();
        });

        $("#username").focus();

    });

@stop
















@stop


@section("style")


div *{
	
	text-align: center;
	
	
}

.input-group{
	text-align: center;
	
}

@stop