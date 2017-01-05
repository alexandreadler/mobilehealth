@extends("layout.main")


@section("content")

    <div class="row panel-body">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock"></span> Login
				</div>
                <div>

                    {{ Form::open(['method' => 'POST','url' => '/users/login', 'class' => 'form-horizontal panel-body','role' => 'form','id' => 'form'] ) }}

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">
                                User</label>
                            <div class="col-sm-9">
                                <input id="username" name="username" type="text" class="form-control input-md" placeholder="Login" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group last" style="padding: 0 15px;">

                            <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                  <a id="submit" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-log-in"></span>&nbsp; Log in</a>
                                  <a href="{{url("/users/create")}}" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-right"></span> Register</a>
                            </div>

                        </div>

                    {{ Form::close() }}
					
					
					 <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                  <!-- Rota original /users/forgot_password, mas o laravel não reconhece esse nome, então reduzi para /users/forgot-->
								  <a href="{{url("/users/forgot")}}" class="btn btn-info btn-sm" role="button"><span class="glyphicon glyphicon-arrow-right"></span> Recuperar senha</a>
                     </div>
                     <br >

                     <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                  <!-- Rota original /users/forgot_password, mas o laravel não reconhece esse nome, então reduzi para /users/forgot-->
                                  <a href="{{url("/users/reporterror")}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-eye-close"></span> Reportar Erro</a>
                     </div>

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

@stop