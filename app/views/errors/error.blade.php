@extends("layout.main")

@section("style")

.error-template {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }

@stop


@section("content")

    <div class="row">
        <div class="col-md-12">
            <div class="error-template">

                <h1 class="alert alert-danger"><strong><i class="fa fa-exclamation-circle"></i>ps!</strong> Erro interno ({{$code}})!</h1>
                <h4 class="alert alert-warning">{{$msg}}</h4>
                <div class="error-details">
                    Desculpe. Tente novamente mais tarde.
                </div>
                <div class="error-actions">
                    <a href="{{ URL::to('/') }}" class="btn btn-primary btn-lg"><span class="fa fa-home"></span>
                        Take Me Home </a><a href="mailto:mtullyoc@gmail.com" class="btn btn-default btn-lg"><span class="fa fa-envelope-o"></span> Contact Support </a>
                </div>
            </div>
        </div>
    </div>

@stop