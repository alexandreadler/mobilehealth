@extends("layout.main")


@section("content")


<div class="span3 well">
    <div class="">

        <h1>Signup</h1>
        <!-- Renderiza o form de cadastro do Confide -->
        {{ Confide::makeSignupForm()->render(); }}

    </div>
</div>

@stop