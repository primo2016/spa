<div class="row">
    <div class="col-lg-12">
        <table id="table" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción</th>
                    <th>Created At</th>
                    <th>Avatar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tablecontents">
                @if($tasks->count() > 0)
                @foreach($tasks as $task)
                <tr class="row1" data-id="{{ $task->id }}">
                    <td>
                        <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </div>
                    </td>
                    <td>{{ $task->descripcion }}</td>
                    <td>{{ $task->created_at->format('d/m/Y') }}</td>
                    <td style="width: 10%">
                        <a href="#" class="thumbnail">
                            <img id="imglist" class="img-fluid img-thumbnail" src="{{ $task->urlimage }}">
                        </a>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-info btn-xs" type="button" onclick="edit({{ $task }});"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-xs" type="button" onclick="remove({{ $task }});"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    No se encontraron resultados
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>


@section('scriptslist')

<script type="text/javascript">
    function edit(task) {
        document.getElementById("descripcion").value = task.descripcion
        document.getElementById("task_id").value = task.id
    }

    function remove(task) {
        $.ajax({
            type: "DELETE",
            dataType: "json",
            url: "{{ url('task/delete') }}/"+task.id,
            data: {
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                location.reload();
                if (response.status == "success") {

                    console.log(response);
                } else {
                    console.log(response);
                }
            }
        });
    }

    $(function() {
        $("#table").DataTable();

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });




        function sendOrderToServer() {

            var order = [];
            $('tr.row1').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('sortabledatatable') }}",
                data: {
                    order: order,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });

        }


    });
</script>

@endsection
