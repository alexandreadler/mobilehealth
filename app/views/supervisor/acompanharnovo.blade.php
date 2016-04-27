@extends("layout.main-mobile")

@section("content")


	<div data-role="page" data-title="Acompanhar Novo paciente">
	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                     <h3>Pacientes que posso acompanhar</h3>
                </div>
                <div class="ui-body ui-body-a">

                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren">
                    </form>

                    @foreach($relates as $p)

                        <div data-role="collapsibleset" data-filter="true" data-children="> div, > div div ul li" data-inset="true" id="collapsiblesetForFilterChildren" data-input="#searchForCollapsibleSetChildren">

                            <div data-role="collapsible" data-collapsed-icon="carat-d" and data-expanded-icon="carat-u">

                                <h3>{{$p->name_first}} {{$p->name_last}}</h3>

                                <b>Sexo: @if ($p->gender == '1') <span style="margin-top: 5px; color:rgb(0, 128,255);">Masculino</span> @else <span style="margin-top: 5px; color:rgb(255, 132,193);">Feminino</span> @endif</b>
								<br >
								
								<!-- ucfirst([string]) Deixa a primeira letra da String maiúscula -->
								<span style="margin-top: 5px;"><b>Doença: @if ($p->disease == "diabetes")<img src={{URL::to('imgs/circuloazul.png')}} alt="Símbolo Mundial da Díabetes" height="30" width="30" /> {{ucfirst($p->disease)}} @else <img src={{URL::to('imgs/Cornflowerblue.png')}} alt="Símbolo Mundial da Díabetes" height="30" width="30" /> {{ucfirst($p->disease)}}</b>@endif</span>

                                <br>
                                <a href="#popupLogin{{$p->person_id}}" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline ui-icon-mail ui-btn-icon-top">Acompanhar</a>
								
								<div data-role="popup" id="popupLogin{{$p->person_id}}" data-theme="a" class="ui-corner-all">
                                    <form action="{{url('/supervisor/addrelate/'.$p->person_id)}}" method="post">
                                        <div style="padding:10px 20px;">
                                            <h3>Mensagens</h3>
                                            <label for="message" class="ui-hidden-accessible">Usuário:</label>
                                            <textarea name="message" id="message" value="" placeholder="" data-theme="a" cols="40" rows="20" >Óla {{$p->name_first}}! A partir de agora irei acompanha-lho.</textarea>
                                            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-right ui-icon-arrow-r">Acompanhar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    @endforeach


				</div>

			</div>
            <br>

            <div class="ui-corner-all custom-corners">
                <div class="ui-bar ui-bar-a">
                    <h3>Siga novos pessoas</h3>
                </div>
                <div class="ui-body ui-body-a">


                    <form>
                        <input data-type="search" id="searchForCollapsibleSetChildren2">
                    </form>



                </div>

            </div>
            <br>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

@section("script")

$(function(){
$("#lista").listview({
autodividers: true,
autodividersSelector: function (li) {
var out = li.attr("doenca");
return out;
}
}).listview("refresh");
});

@stop
