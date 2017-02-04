@extends("layout.main-mobile")

@section("content")

	<div data-role="page" data-title="Profile">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <form id="form" action="{{url('/profile')}}" method="post" enctype="multipart/form-data">

                {{Form::hidden('pid',$pid)}}

                <div class="ui-corner-all custom-corners">
                    <div class="ui-bar ui-bar-a">
                        <h3><strong>Dados Pessoais</strong></h3>
                    </div>
                    <div class="ui-body ui-body-a">
                        
						<label for="name">Primeiro Nome:</label>
                        <input type="text" name="fname" id="fname" value="{{$person->name_first}}">

						<label for="name">Sobre nome:</label>
                        <input type="text" name="lname" id="lname" value="{{$person->name_last}}">

                        
                        <label for="date">Aniversário:</label>
                        <input type="date" name="birthdate" id="birthdate" value="{{Str::limit($person->date_birth,10,'')}}">

                        <label for="gender">Genero:</label>
                        <fieldset data-role="controlgroup" data-theme="b" data-type="horizontal" data-mini="true">
                            <input type="radio" name="gender" id="radio-choice-c" value="1" @if($person->gender == "1")checked="checked"@endif>
                            <label for="radio-choice-c">Masculino</label>
                            <input type="radio" name="gender" id="radio-choice-d" value="2" @if($person->gender == "2")checked="checked"@endif>
                            <label for="radio-choice-d">Feminino</label>
                        </fieldset>

                        <label for="disease">Doença:</label>
                        <fieldset data-role="controlgroup" data-theme="b" data-type="horizontal" data-mini="true">
                            <input type="radio" name="disease" id="radio-choice-e" value="diabetes" @if($person->disease == "diabetes")checked="checked"@endif>
                            <label for="radio-choice-e">Diabetes</label>
                            <input type="radio" name="disease" id="radio-choice-f" value="ELA" @if($person->disease == "ELA")checked="checked"@endif>
                            <label for="radio-choice-f">ELA</label>
                        </fieldset>
						
						<br >
						
						<label for="disease">
							Tempo com a doença: 
						</label>

						<select name="tempodoenca">
							<option value="1" @if($tempodoenca == "1")selected="selected"@endif>até 2 anos</option>
							<option value="2" @if($tempodoenca == "2")selected="selected"@endif>de 2 a 5 anos</option>
							<option value="3" @if($tempodoenca == "3")selected="selected"@endif>de 5 a 7 anos</option>
							<option value="4" @if($tempodoenca == "4")selected="selected"@endif>de 7 a 10 anos</option>
							<option value="5" @if($tempodoenca == "5")selected="selected"@endif>mais de 10 anos</option>
						</select>
						
						
						<br>
						<br>
						
						<label >
							Afinidade com a tecnologia: 
						</label>

						<select name="afinidade">
							<option value="1" @if($afinidade == "1")selected="selected"@endif>Baixa</option>
							<option value="2" @if($afinidade == "2")selected="selected"@endif>Media</option>
							<option value="3" @if($afinidade == "3")selected="selected"@endif>Alta</option>
						</select>
						
						
						<input type="hidden" name="supervisor" value="false"><br>

						<br >
						Imagem de perfil
						<br >
						<input type="file" id="imagem" name="imagem">

                    </div>
                    <div class="ui-bar ui-bar-a" style="height: 44px;">
                        <a id="save" data-rel="save" class="btn btn-default btn-sm ui-mini ui-btn-right ui-btn ui-btn-inline ui-alt-icon ui-nodisc-icon ui-icon-home" style="margin: 0;"><span class="glyphicon glyphicon-save"></span>Salvar</a>
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

