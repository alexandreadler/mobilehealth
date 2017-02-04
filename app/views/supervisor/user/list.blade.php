@extends("layout.main")


@section("head")


	<link href="{{ asset("css/jquery.dataTables.css") }}" rel="stylesheet">
	<script src="{{ asset("js/jquery.dataTables.js") }}"></script>


@stop


@section("content")

<div class="page-header text-primary media-heading">
    <div class="btn-toolbar navbar-right">
        <div class="btn-group btn-group-md">
            <a href="{{URL::to('/users/create')}}" class="btn btn-default fa fa-user">+ Novo Usuário</a>
        </div>
    </div>
    <h3>Selecione um Usuário abaixo</h3>


</div>
<br>

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr class="text-primary">
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>Criado em</th>
                <th>Último Acesso</th>
                <th class=" hidden-print">Ação</th>
            </tr>
        </thead>

        <tfoot>
            <tr class="text-primary">
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>Criado em</th>
                <th>Último Acesso</th>
                <th class=" hidden-print">Ação</th>
            </tr>
        </tfoot>
 
        <tbody>

		@foreach ($users as $u)

            <tr>
                <td>{{$u->id}}</td>
                <td>{{$u->username}}</td>
                <td>{{$u->email }}</td>
                <td>{{$u->created_at }}</td>
                <td>{{$u->ultimo_acesso }}</td>
                <td class=" hidden-print">

	                <div class="btn-toolbar">
	                    <div class="btn-group">
	                        <a href="{{URL::route('membros.edit',$u->id)}}" class="btn fa fa-pencil btn-success" rel="tooltip" title="Editar Associado"></a>

							{{ Form::button('', 
											array('onclick' => 'showConfirmDeleteModal(
									                                                    "' . $u->username . '",
                                    									                "' . url('user/' . $u->id) . '"
                                                				)',
                                			'class' => 'btn fa fa-trash-o btn-warning',
                                			'rel'   => 'tooltip',
                                			'title' => 'Excluir Associado'
                            )) }}
	                    </div>
	                </div>

				</td>
            </tr>

		@endforeach

        </tbody>
    </table>


    {{-- Modal: Confirm delete --}}
    <div class="modal fade" id="modal-confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">Excluir Associado</h3>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Tem certeza que desejas excluir esse associado?</strong>
                    </p>
                    <p id="deleteName" class="text-danger"></p>
                </div>
                <div class="modal-footer">
                    {{ Form::open(array('id' => 'deleteForm', 'method' => 'delete')) }}
                        {{ Form::button("Cancelar", array(
                            'data-dismiss' => 'modal',
                            'class' => 'btn btn-default',
                        )) }}
                        {{ Form::submit("Excluir!", array(
                            'class' => 'btn btn-default btn-danger',
                        )) }}
                    {{ Form::close() }}
                </div>
            </div>{{-- /.modal-content --}}
        </div>{{-- /.modal-dialog --}}
    </div>{{-- /.modal --}}

@stop

@section("script")

	$(function() {

	    $('#example').on("order.dt", function(){

			$(".dataTables_length > label").addClass("form-inline");
			$(".dataTables_length label select").addClass("form-control");
	    
			$(".dataTables_filter > label").addClass("form-inline");
			$(".dataTables_filter label input").addClass("form-control");
	    
	    }).dataTable({
	    	"language" : {
	    		"url"  : "{{ asset('js/Portuguese-Brasil.json') }}"
	    	}
	    });

        $("[rel=tooltip]").tooltip({
            container: 'body'
        });

	} );


	function showConfirmDeleteModal(nome, url) {
	    $('#deleteForm').prop('action', url);
	    $('#deleteName').text(nome);

	    $('#modal-confirmDelete').modal({
	        show: true
	    });
	}

@stop