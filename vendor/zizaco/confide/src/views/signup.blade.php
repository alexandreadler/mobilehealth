
<form method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
	
		<div class="form-group">
            <label for="firstname">Nome</label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="firstname" id="firstname" value="{{{ Input::old('username') }}}">
        </div>
		
		<div class="form-group">
            <label for="lastname">Sobrenome</label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="lastname" id="lastname" value="{{{ Input::old('username') }}}">
        </div>
		
		
        <div class="form-group">
            <label for="username">Nome de Usuário</label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
        </div>
        <div class="form-group">
            <label for="email">E-mail<small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        
		<div class="form-group">
            <label for="password">Senha</label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input required="" class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>
	
		<div class="form-group">
            <label for="datebirth">Data de Nascimento</label>
            <input required="" class="form-control" onkeypress="mascara(this, '####-##-##')" maxlength="10"   type="text" name="datebirth" id="datebirth">
			<span style="font-size: 10px; color: gray;">AAAA-MM-DD</span>
		</div>
	
		<div class="form-group">
			<label for="gender">Sexo</label><br >
			<input type="radio" name="gender" value="1" checked /> Masculino
			<input type="radio" name="gender" value="0" /> Feminino
		</div>
		<br>
		
		
		<label for="disease">
			Doença:
		</label>
		
        <fieldset data-role="controlgroup" data-theme="b" data-type="horizontal" data-mini="true">
			<input type="radio" id="radio-choice-f" name="disease" value="diabetes" checked />
			<label for="radio-choice-f">Diabetes</label>
			<input type="radio" name="disease" id="radio-choice-e" value="ELA">
			<label for="radio-choice-e">ELA</label>
        </fieldset>
		
		<br>
		
		<label for="disease">
			Tempo com a doença: 
		</label>
		<br>
		
		<select name="tempodoenca">
			<option value="1">até 2 anos</option>
			<option value="2">de 2 a 5 anos</option>
			<option value="3">de 5 a 7 anos</option>
			<option value="4">de 7 a 10 anos</option>
			<option value="5">mais de 10 anos</option>
		</select>
		
		
		<br>
		<br>
		
		<label >
			Afinidade com a tecnologia: 
		</label>
		<br>
		
		<select name="afinidade">
			<option value="1">Baixa</option>
			<option value="2">Media</option>
			<option value="3">Alta</option>
		</select>
		
		
		<input type="hidden" name="supervisor" value="false"><br>
		
		<br>
		<br>
		
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">
                @if (is_array(Session::get('error')))
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if (Session::get('notice'))
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
		  <a href="{{url("/")}}" class="btn btn-success btn-sm" role="button"> Voltar</a>
        </div>

    </fieldset>
</form>




<script>


	 function mascara(t, mask){
		 var i = t.value.length;
		 var saida = mask.substring(1,0);
		 var texto = mask.substring(i)
		 if (texto.substring(0,1) != saida){
		 t.value += texto.substring(0,1);
		 }
	 }

</script>







