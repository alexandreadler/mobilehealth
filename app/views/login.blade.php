@extends("layout.login.main")

@section('body')

<style>
	
	#minilogo {
		display: block;
		background: #908;
		width: 300px;
		height: 100px;
		float: left;
		background: url('{{ asset("imgs/acesso_negado.jpg") }}');
	}
	
	.login {
		background: #fff;
		border: 1px solid #999;
		border-width: 1px 2px 2px 1px;
		display: block;
		position: relative; 
		height: 220px;
		width: 300px;
		margin: auto;
	}
	
	
	.login input {
		border: 1px solid #9ac;
		width: 140px;
	}
	
	.login label {
		font-size: 9pt;
		font-family: verdana;
		width: 105px;
		display: block;
		float: left;
		text-align: right;
		padding: 2px;
	}
	.login input.texto {
		background: #ddd;
		display: block;
		float: left;
		width: 150px;
	}
	.login .form_container {
		display: block;
		float: left;
		padding: 4px;
	}
</style>


{{-- --------------------------INICIO LOGIN---------------------------- --}}

<div class="login">
	
	<div id="minilogo"></div>
	
	<form action="interno/entrar" method="post" accept-charset="utf-8" >

		<span clear="all" style="float: left; display: block; width: 300px; height: 10px;"></span>

		<label for="de-ano" style="width: 120px; float: left; line-height: 20px; padding: 0 8px;">USUÁRIO:</label> 
		<input type="text" id="user" name="user" size="16" maxlength="16" class="ui-state-default ui-corner-all" style="text-align: center; padding: 2px;"/>
		
		<p></p>
		<label for="ate-ano" style="width: 120px; float: left; line-height: 20px; padding: 0 8px;">SENHA:</label> 
		<input type="password" id="pass" name="pass" size="16" maxlength="16" class="ui-state-default ui-corner-all" style="text-align: center; padding: 2px;"/>

		<br/><br/>

		<a id="entrar" href="#" style="width: 240px; margin-left: 10px; display: block; text-align: center;" class="fg-button ui-state-default fg-button-icon-right ui-corner-all" ><span class="ui-icon ui-icon-circle-arrow-e"></span>Entrar</a>
		
	</form>

</div>

{{-- --------------------------FIM LOGIN---------------------------- --}}

@stop